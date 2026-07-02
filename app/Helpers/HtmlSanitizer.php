<?php

namespace App\Helpers;

use DOMDocument;
use DOMElement;

class HtmlSanitizer
{
    /**
     * Sanitize HTML fragments to prevent XSS payloads.
     * Uses native DOMDocument to filter allowed tags and attributes.
     */
    public static function sanitize(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // Disable libxml errors to handle HTML fragments gracefully
        $internalErrors = libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        // Load HTML with UTF-8 encoding and wrap in a root tag
        // Use LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD to prevent wrapping in doctype/html/body tags
        $dom->loadHTML('<?xml encoding="utf-8" ?><div>' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $allowedTags = ['div', 'p', 'br', 'strong', 'em', 'u', 'ol', 'ul', 'li', 'a', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'pre', 'code', 'blockquote', 'img'];
        
        $cleanNode = function ($node) use (&$cleanNode, $allowedTags) {
            if ($node instanceof DOMElement) {
                $tagName = strtolower($node->nodeName);
                
                // Tags that must be removed entirely with all children
                $removeEntirely = ['script', 'style', 'iframe', 'object', 'embed', 'form', 'svg'];
                if (in_array($tagName, $removeEntirely)) {
                    $node->parentNode->removeChild($node);
                    return;
                }

                // If tag is not in allowed list, remove the tag but keep its text/children
                if (!in_array($tagName, $allowedTags)) {
                    // Remove node but keep children
                    while ($node->hasChildNodes()) {
                        $node->parentNode->insertBefore($node->firstChild, $node);
                    }
                    $node->parentNode->removeChild($node);
                    return;
                }

                // Sanitize attributes
                $attrsToRemove = [];
                foreach ($node->attributes as $attr) {
                    $name = strtolower($attr->nodeName);
                    $val = strtolower(trim($attr->nodeValue));

                    // Strip any attribute starting with 'on' (event handlers)
                    if (str_starts_with($name, 'on')) {
                        $attrsToRemove[] = $attr->nodeName;
                        continue;
                    }

                    // Strip javascript: or data: protocols in links/sources (allow safe base64 images)
                    if (($name === 'href' || $name === 'src') && (str_starts_with($val, 'javascript:') || (str_starts_with($val, 'data:') && !str_starts_with($val, 'data:image/')))) {
                        $attrsToRemove[] = $attr->nodeName;
                        continue;
                    }

                    // Only allow safe attributes: href, target, rel, src, alt, class, style
                    // (Quill editor sometimes relies on class/style for alignments/fonts, but we must make sure style is safe)
                    $allowedAttrs = ['href', 'target', 'rel', 'src', 'alt', 'class', 'style'];
                    if (!in_array($name, $allowedAttrs)) {
                        $attrsToRemove[] = $attr->nodeName;
                    }
                }

                foreach ($attrsToRemove as $attrName) {
                    $node->removeAttribute($attrName);
                }
            }

            // Recurse child nodes safely
            if ($node->hasChildNodes()) {
                $children = [];
                foreach ($node->childNodes as $child) {
                    $children[] = $child;
                }
                foreach ($children as $child) {
                    $cleanNode($child);
                }
            }
        };

        // Run cleanup on root div
        $root = $dom->documentElement;
        if ($root) {
            $cleanNode($root);
            // Save inner HTML of the wrapper div
            $innerHtml = '';
            foreach ($root->childNodes as $child) {
                $innerHtml .= $dom->saveHTML($child);
            }
            
            libxml_use_internal_errors($internalErrors);
            return $innerHtml;
        }

        libxml_use_internal_errors($internalErrors);
        return '';
    }
}
