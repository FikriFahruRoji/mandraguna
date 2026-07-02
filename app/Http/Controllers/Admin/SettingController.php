<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\Post;
use App\Models\FieldStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('sort_order')->get()->groupBy('group');

        return Inertia::render('Admin/Settings', [
            'settings' => $settings,
            'slides' => Slide::orderBy('sort_order')->get(),
            'products' => [],
            'posts' => Post::published()->orderBy('title')->get(['id', 'slug', 'title']),
            'fieldStories' => FieldStory::published()->orderBy('title')->get(['id', 'slug', 'title']),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings'                  => 'nullable|array',
            'settings.*'                => 'nullable|string|max:5000',
            'settings_en'               => 'nullable|array',
            'settings_en.*'             => 'nullable|string|max:5000',
            'settings_ja'               => 'nullable|array',
            'settings_ja.*'             => 'nullable|string|max:5000',
            'images.*'                  => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,ico|max:2048',
            'slides'                    => 'nullable|array',
            'slides.*.title'            => 'required|string|max:255',
            'slides.*.title_en'         => 'nullable|string|max:255',
            'slides.*.title_ja'         => 'nullable|string|max:255',
            'slides.*.subtitle'         => 'nullable|string|max:1000',
            'slides.*.subtitle_en'      => 'nullable|string|max:1000',
            'slides.*.subtitle_ja'      => 'nullable|string|max:1000',
            'slides.*.cta_text'         => 'nullable|string|max:100',
            'slides.*.cta_text_en'      => 'nullable|string|max:100',
            'slides.*.cta_text_ja'      => 'nullable|string|max:100',
            'slides.*.cta_link'         => ['nullable', 'string', 'max:500', 'regex:/^(https?:\/\/|\/)[^\s<>\"\']*$/'],
            'slides.*.sort_order'       => 'nullable|integer|min:0|max:9999',
            'slides.*.image'            => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
        ], [
            'slides.*.title.required'   => 'Judul slide tidak boleh kosong.',
            'slides.*.cta_link.regex'   => 'Link CTA harus berupa URL valid atau path relatif (contoh: /products atau https://...).',
        ]);

        $data   = $request->input('settings', []);
        $dataEn = $request->input('settings_en', []);
        $dataJa = $request->input('settings_ja', []);

        foreach ($data as $key => $value) {
            // Only update settings that already exist in DB (prevents arbitrary key injection)
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                // iframe_embed type must NOT be stripped — it contains valid HTML iframe tags
                // image type values are file paths — no stripping needed either
                $skipStrip = in_array($setting->type, ['image', 'iframe_embed']);
                $sanitizedValue   = $skipStrip ? (string) $value : strip_tags((string) $value);
                $sanitizedValueEn = isset($dataEn[$key])
                    ? ($skipStrip ? (string) $dataEn[$key] : strip_tags((string) $dataEn[$key]))
                    : null;
                $sanitizedValueJa = isset($dataJa[$key])
                    ? ($skipStrip ? (string) $dataJa[$key] : strip_tags((string) $dataJa[$key]))
                    : null;
                $setting->update([
                    'value'    => $sanitizedValue,
                    'value_en' => $sanitizedValueEn,
                    'value_ja' => $sanitizedValueJa,
                ]);
            }
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $path = $file->store('settings', 'public');
                $setting = Setting::where('key', $key)->first();
                if ($setting) {
                    // Delete old image if exists
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $setting->update(['value' => $path]);
                }
            }
        }

        // Handle slides updates
        $slidesData = $request->input('slides', []);
        $slideIds   = [];

        foreach ($slidesData as $index => $item) {
            $slideId = $item['id'] ?? null;

            $slideData = [
                'title'       => strip_tags($item['title'] ?? ''),
                'title_en'    => isset($item['title_en'])    ? strip_tags($item['title_en'])    : null,
                'title_ja'    => isset($item['title_ja'])    ? strip_tags($item['title_ja'])    : null,
                'subtitle'    => isset($item['subtitle'])    ? strip_tags($item['subtitle'])    : '',
                'subtitle_en' => isset($item['subtitle_en']) ? strip_tags($item['subtitle_en']) : null,
                'subtitle_ja' => isset($item['subtitle_ja']) ? strip_tags($item['subtitle_ja']) : null,
                'cta_text'    => isset($item['cta_text'])    ? strip_tags($item['cta_text'])    : '',
                'cta_text_en' => isset($item['cta_text_en']) ? strip_tags($item['cta_text_en']) : null,
                'cta_text_ja' => isset($item['cta_text_ja']) ? strip_tags($item['cta_text_ja']) : null,
                'cta_link'    => isset($item['cta_link'])    ? strip_tags($item['cta_link'])    : '',
                'sort_order'  => isset($item['sort_order'])  ? (int) $item['sort_order']        : $index,
            ];

            // If it's an existing slide
            if ($slideId && !str_starts_with((string) $slideId, 'new_')) {
                $slide = Slide::find((int) $slideId);
                if ($slide) {
                    $slide->update($slideData);
                    $slideIds[] = $slide->id;
                }
            } else {
                // It is a new slide
                $slide = Slide::create($slideData);
                $slideIds[] = $slide->id;
            }

            // Handle slide image file upload
            if ($request->hasFile("slides.$index.image")) {
                $path = $request->file("slides.$index.image")->store('slides', 'public');
                if ($slide->image_path) {
                    Storage::disk('public')->delete($slide->image_path);
                }
                $slide->update(['image_path' => $path]);
            }
        }

        // Delete slides that were removed in UI
        $slidesToDelete = Slide::whereNotIn('id', $slideIds)->get();
        foreach ($slidesToDelete as $slideDel) {
            if ($slideDel->image_path) {
                Storage::disk('public')->delete($slideDel->image_path);
            }
            $slideDel->delete();
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}

