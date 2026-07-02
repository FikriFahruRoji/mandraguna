<?php

namespace Tests\Feature;

use App\Models\Slide;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageSliderTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_home_page_returns_slides(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Assert that slides are passed to the Inertia view
        $response->assertSee('slides');
    }

    public function test_admin_can_update_and_manage_slides(): void
    {
        $admin = User::where('email', 'admin@mandraguna.com')->first();

        // 1. Initially we have 2 seeded slides.
        $this->assertDatabaseCount('slides', 2);

        // 2. We submit setting update and keep only 1 slide, and modify its details.
        $payload = [
            'settings' => [
                'site_name' => 'Mandraguna Baru'
            ],
            'slides' => [
                [
                    'id' => 1,
                    'title' => 'Judul Slide 1 Modifikasi',
                    'subtitle' => 'Subjudul baru',
                    'cta_text' => 'Beli',
                    'cta_link' => '/buy',
                    'sort_order' => 0
                ]
            ]
        ];

        $response = $this->actingAs($admin)->post('/admin/settings', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Assert slide 1 is updated, slide 2 (ID 2) is deleted since it was not in the payload
        $this->assertDatabaseCount('slides', 1);
        $this->assertDatabaseHas('slides', [
            'id' => 1,
            'title' => 'Judul Slide 1 Modifikasi',
            'cta_link' => '/buy',
        ]);
        $this->assertDatabaseMissing('slides', ['id' => 2]);
    }

    public function test_admin_can_create_new_slide(): void
    {
        $admin = User::where('email', 'admin@mandraguna.com')->first();

        $payload = [
            'settings' => [],
            'slides' => [
                [
                    'id' => 1,
                    'title' => 'Slide 1',
                    'sort_order' => 0
                ],
                [
                    'id' => 2,
                    'title' => 'Slide 2',
                    'sort_order' => 1
                ],
                [
                    'id' => 'new_12345',
                    'title' => 'Slide Baru Ditambahkan',
                    'subtitle' => 'Deskripsi baru',
                    'cta_text' => 'Klik',
                    'cta_link' => '/klik',
                    'sort_order' => 2
                ]
            ]
        ];

        $response = $this->actingAs($admin)->post('/admin/settings', $payload);

        $response->assertRedirect();

        $this->assertDatabaseCount('slides', 3);
        $this->assertDatabaseHas('slides', [
            'title' => 'Slide Baru Ditambahkan',
            'cta_link' => '/klik',
        ]);
    }
}
