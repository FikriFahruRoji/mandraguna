<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldStory;
use App\Helpers\HtmlSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class FieldStoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/FieldStories/Index', [
            'fieldStories' => FieldStory::latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/FieldStories/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'title_en'     => 'nullable|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'excerpt_en'   => 'nullable|string|max:500',
            'content'      => 'required|string',
            'content_en'   => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['content'] = HtmlSanitizer::sanitize($validated['content']);
        if (isset($validated['content_en'])) {
            $validated['content_en'] = HtmlSanitizer::sanitize($validated['content_en']);
        }

        // Sanitize plain-text fields
        $validated['title']   = strip_tags($validated['title']);
        if (isset($validated['title_en']))   $validated['title_en']   = strip_tags($validated['title_en']);
        if (isset($validated['excerpt']))    $validated['excerpt']    = strip_tags($validated['excerpt']);
        if (isset($validated['excerpt_en'])) $validated['excerpt_en'] = strip_tags($validated['excerpt_en']);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('field_stories', 'public');
        }

        // published_at is set server-side only — never accept from user input
        if ($validated['is_published'] ?? false) {
            $validated['published_at'] = now();
        }

        unset($validated['image']);
        FieldStory::create($validated);

        return redirect()->route('admin.field-stories.index')->with('success', 'Kabar Lapangan berhasil ditambahkan.');
    }

    public function edit(FieldStory $fieldStory)
    {
        return Inertia::render('Admin/FieldStories/Form', [
            'fieldStory' => $fieldStory,
        ]);
    }

    public function update(Request $request, FieldStory $fieldStory)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'title_en'     => 'nullable|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'excerpt_en'   => 'nullable|string|max:500',
            'content'      => 'required|string',
            'content_en'   => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['content'] = HtmlSanitizer::sanitize($validated['content']);
        if (isset($validated['content_en'])) {
            $validated['content_en'] = HtmlSanitizer::sanitize($validated['content_en']);
        }

        // Sanitize plain-text fields
        $validated['title']   = strip_tags($validated['title']);
        if (isset($validated['title_en']))   $validated['title_en']   = strip_tags($validated['title_en']);
        if (isset($validated['excerpt']))    $validated['excerpt']    = strip_tags($validated['excerpt']);
        if (isset($validated['excerpt_en'])) $validated['excerpt_en'] = strip_tags($validated['excerpt_en']);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            if ($fieldStory->image_path) {
                Storage::disk('public')->delete($fieldStory->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('field_stories', 'public');
        }

        // published_at is set server-side only — never accept from user input
        if (($validated['is_published'] ?? false) && !$fieldStory->published_at) {
            $validated['published_at'] = now();
        }

        unset($validated['image']);
        $fieldStory->update($validated);

        return redirect()->route('admin.field-stories.index')->with('success', 'Kabar Lapangan berhasil diperbarui.');
    }

    public function destroy(FieldStory $fieldStory)
    {
        if ($fieldStory->image_path) {
            Storage::disk('public')->delete($fieldStory->image_path);
        }
        $fieldStory->delete();

        return redirect()->route('admin.field-stories.index')->with('success', 'Kabar Lapangan berhasil dihapus.');
    }
}
