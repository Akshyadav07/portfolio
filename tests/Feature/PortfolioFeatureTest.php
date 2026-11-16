<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PortfolioFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Developer');
    }

    public function test_project_details_page_loads_with_valid_slug()
    {
        $project = Project::create([
            'title' => 'Sample Cloud Platform',
            'slug' => 'sample-cloud-platform',
            'description' => 'A test description for the sample project.',
            'is_visible' => true,
        ]);

        $response = $this->get('/projects/' . $project->slug);
        $response->assertStatus(200);
        $response->assertSee('Sample Cloud Platform');
    }

    public function test_contact_form_submission_stores_message()
    {
        $payload = [
            'name' => 'Alice Tester',
            'email' => 'alice@example.com',
            'subject' => 'Project Inquiry',
            'message' => 'Hello, I would like to discuss building a scalable Laravel backend.',
        ];

        $response = $this->post('/contact', $payload);
        $response->assertStatus(302);

        $this->assertDatabaseHas('messages', [
            'name' => 'Alice Tester',
            'email' => 'alice@example.com',
        ]);
    }

    public function test_admin_dashboard_redirects_unauthenticated_users()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_access_dashboard()
    {
        $adminEmail = config('auth.admin_email') ?? env('ADMIN_EMAIL') ?? 'admin@example.com';

        $admin = User::create([
            'name'     => 'Root Admin',
            'email'    => $adminEmail,
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($admin)
            ->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }
}
