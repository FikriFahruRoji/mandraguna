<?php

namespace App\Helpers;

class CaptchaHelper
{
    /**
     * Generate a random alphanumeric string for the captcha.
     */
    public static function generateCode(int $length = 5): string
    {
        $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'; // exclude easily confused chars: 0, 1, O, I
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }

    /**
     * Generate an SVG captcha image as a base64 encoded string.
     */
    public static function generateSvg(string $code): string
    {
        $width = 150;
        $height = 50;
        
        $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='{$width}' height='{$height}' viewBox='0 0 {$width} {$height}' style='background-color: #f3f4f6; border-radius: 6px;'>";
        
        // Add random grid lines for noise
        for ($i = 0; $i < 5; $i++) {
            $x1 = rand(0, $width);
            $y1 = rand(0, $height);
            $x2 = rand(0, $width);
            $y2 = rand(0, $height);
            $color = sprintf('#%06X', rand(0, 0xFFFFFF));
            $svg .= "<line x1='{$x1}' y1='{$y1}' x2='{$x2}' y2='{$y2}' stroke='{$color}' stroke-width='1.5' opacity='0.4' />";
        }

        // Add some noise circles
        for ($i = 0; $i < 15; $i++) {
            $cx = rand(0, $width);
            $cy = rand(0, $height);
            $r = rand(1, 3);
            $color = sprintf('#%06X', rand(0, 0xFFFFFF));
            $svg .= "<circle cx='{$cx}' cy='{$cy}' r='{$r}' fill='{$color}' opacity='0.3' />";
        }
        
        // Render each character with random rotation, color, and vertical offset
        $len = strlen($code);
        $charWidth = $width / ($len + 1);
        
        // Choose beautiful, readable colors (darker so they contrast with the light gray background)
        $colors = ['#1e3a8a', '#111827', '#065f46', '#7c2d12', '#4c1d95', '#581c87', '#0369a1', '#15803d'];
        
        for ($i = 0; $i < $len; $i++) {
            $char = $code[$i];
            $x = ($i + 0.5) * $charWidth + rand(-3, 3);
            $y = $height / 2 + rand(4, 10);
            $color = $colors[rand(0, count($colors) - 1)];
            $angle = rand(-25, 25);
            $fontSize = rand(24, 30);
            
            // Draw character
            $svg .= "<text x='{$x}' y='{$y}' fill='{$color}' font-size='{$fontSize}' font-family='Arial, Helvetica, sans-serif' font-weight='bold' transform='rotate({$angle} {$x} {$y})' text-anchor='middle'>{$char}</text>";
        }
        
        // Add more intersecting curves
        $x1 = 0;
        $y1 = rand(10, $height - 10);
        $cx1 = rand(30, 60);
        $cy1 = rand(0, $height);
        $cx2 = rand(90, 120);
        $cy2 = rand(0, $height);
        $x2 = $width;
        $y2 = rand(10, $height - 10);
        $color = sprintf('#%06X', rand(0, 0xFFFFFF));
        $svg .= "<path d='M {$x1} {$y1} C {$cx1} {$cy1}, {$cx2} {$cy2}, {$x2} {$y2}' stroke='{$color}' stroke-width='2' fill='none' opacity='0.5' />";
        
        $svg .= "</svg>";
        
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
