<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\FieldStory;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Slide;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Home', [
            'settings'  => Setting::getGroup('general'),
            'products'  => [],
            'posts'     => Post::published()->latest('published_at')->take(3)->get(),
            'fieldStories' => FieldStory::published()->latest('published_at')->take(3)->get(),
            'sustainability' => Setting::getGroup('sustainability'),
            'contact'   => Setting::getGroup('contact'),
            'slides'    => Slide::orderBy('sort_order')->get(),
            'homepage_about'     => Setting::getGroup('homepage_about'),
            'homepage_transform' => Setting::getGroup('homepage_transform'),
            'homepage_tech'      => Setting::getGroup('homepage_tech'),
            'homepage_product'   => Setting::getGroup('homepage_product'),
            'homepage_cta'       => Setting::getGroup('homepage_cta'),
        ]);
    }

    public function about()
    {
        return Inertia::render('About', [
            'settings' => Setting::getGroup('general'),
            'sustainability' => Setting::getGroup('sustainability'),
            'about_page' => Setting::getGroup('about_page'),
        ]);
    }

    public function products()
    {
        return Inertia::render('Products', [
            'products' => [],
            'product_page' => Setting::getGroup('product_page'),
        ]);
    }



    public function sustainability()
    {
        return Inertia::render('Sustainability', [
            'sustainability' => Setting::getGroup('sustainability'),
            'settings' => Setting::getGroup('general'),
        ]);
    }

    public function news()
    {
        return Inertia::render('News', [
            'posts' => Post::published()->latest('published_at')->get(),
            'fieldStories' => FieldStory::published()->latest('published_at')->get(),
        ]);
    }

    public function newsDetail(Post $post)
    {
        if (!$post->is_published) {
            abort(404);
        }

        $post->increment('views');

        return Inertia::render('NewsDetail', [
            'post' => $post,
            'relatedPosts' => Post::published()
                ->where('id', '!=', $post->id)
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }

    public function fieldStoryDetail(FieldStory $fieldStory)
    {
        if (!$fieldStory->is_published) {
            abort(404);
        }

        $fieldStory->increment('views');

        return Inertia::render('FieldStoryDetail', [
            'fieldStory' => $fieldStory,
            'relatedStories' => FieldStory::published()
                ->where('id', '!=', $fieldStory->id)
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }

    public function contact()
    {
        $code = \App\Helpers\CaptchaHelper::generateCode();
        session(['contact_captcha' => strtolower($code)]);

        return Inertia::render('Contact', [
            'contact' => Setting::getGroup('contact'),
            'captcha_image' => \App\Helpers\CaptchaHelper::generateSvg($code),
        ]);
    }

    public function refreshCaptcha()
    {
        $code = \App\Helpers\CaptchaHelper::generateCode();
        session(['contact_captcha' => strtolower($code)]);

        return response()->json([
            'captcha_image' => \App\Helpers\CaptchaHelper::generateSvg($code),
        ]);
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100', 'regex:/^[\pL\s\'\-\.]+$/u'],
            'email'   => ['required', 'email:rfc,dns', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:20', 'regex:/^[\d\s\+\-\(\)]+$/'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            'captcha' => ['required', 'string'],
        ], [
            'name.regex'    => 'Nama hanya boleh berisi huruf, spasi, dan tanda hubung.',
            'phone.regex'   => 'Nomor telepon hanya boleh berisi angka, spasi, dan tanda +, -, ().',
            'message.min'   => 'Pesan minimal 10 karakter.',
            'captcha.required' => 'Kolom captcha wajib diisi.',
        ]);

        if (strtolower($request->input('captcha')) !== session('contact_captcha')) {
            $newCode = \App\Helpers\CaptchaHelper::generateCode();
            session(['contact_captcha' => strtolower($newCode)]);

            return redirect()->back()
                ->withInput($request->except('captcha'))
                ->withErrors(['captcha' => 'Captcha yang Anda masukkan salah.']);
        }

        // Sanitize plain-text fields to prevent stored XSS
        $name    = strip_tags($validated['name']);
        $subject = isset($validated['subject']) ? strip_tags($validated['subject']) : null;
        $message = strip_tags($validated['message']);
        $phone   = isset($validated['phone']) ? strip_tags($validated['phone']) : null;

        ContactMessage::create([
            'name' => $name,
            'email' => $validated['email'],
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
