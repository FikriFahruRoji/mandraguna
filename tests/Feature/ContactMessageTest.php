<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_contact_page_renders_successfully(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

    public function test_user_can_submit_contact_message(): void
    {
        $payload = [
            'name' => 'Fikri Fahruroji',
            'email' => 'fikri@example.com',
            'phone' => '08123456789',
            'subject' => 'Tanya Kemitraan',
            'message' => 'Halo Mandraguna, saya ingin bertanya tentang kemitraan pemrosesan limbah.',
        ];

        $response = $this->post('/contact', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Fikri Fahruroji',
            'email' => 'fikri@example.com',
            'subject' => 'Tanya Kemitraan',
        ]);
    }

    public function test_contact_message_requires_name_email_and_message(): void
    {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'not-an-email',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
        $this->assertDatabaseCount('contact_messages', 0);
    }
}
