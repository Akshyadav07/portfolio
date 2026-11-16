<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        config(['auth.admin_email' => 'admin@example.com']);

        $this->admin = User::create([
            'name'              => 'Admin User',
            'email'             => 'admin@example.com',
            'password'          => Hash::make('Secret1234!'),
            'email_verified_at' => now(),
        ]);
    }

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Admin Panel');
        $response->assertSee('Email Address');
        $response->assertSee('Password');
        $response->assertDontSee('Continue with Google');
    }

    public function test_correct_email_and_password_allow_admin_login(): void
    {
        $response = $this->post('/admin/login', [
            'email'    => 'admin@example.com',
            'password' => 'Secret1234!',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($this->admin);
        $this->assertTrue(session('admin_logged_in'));
        $this->assertEquals('Admin User', session('admin_name'));
        $this->assertEquals('admin@example.com', session('admin_email'));
    }

    public function test_incorrect_password_is_rejected(): void
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email'    => 'admin@example.com',
            'password' => 'WrongPassword',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
        $this->assertFalse(session()->has('admin_logged_in'));
    }

    public function test_unknown_email_is_rejected(): void
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email'    => 'unknown@example.com',
            'password' => 'Secret1234!',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
        $this->assertFalse(session()->has('admin_logged_in'));
    }

    public function test_login_validation_requires_email_and_password(): void
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email'    => '',
            'password' => '',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors(['email', 'password']);
        $this->assertGuest();
    }

    public function test_unauthenticated_users_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/admin/login');
        $response->assertSessionHas('error');
    }

    public function test_normal_registered_users_cannot_access_admin_dashboard(): void
    {
        $normalUser = User::create([
            'name'     => 'Regular User',
            'email'    => 'user@example.com',
            'password' => Hash::make('Secret1234!'),
        ]);

        $response = $this->actingAs($normalUser)->get('/admin/dashboard');

        $response->assertRedirect('/admin/login');
        $response->assertSessionHas('error');
    }

    public function test_normal_registered_user_cannot_log_in_to_admin(): void
    {
        User::create([
            'name'     => 'Regular User',
            'email'    => 'user@example.com',
            'password' => Hash::make('Secret1234!'),
        ]);

        $response = $this->from('/admin/login')->post('/admin/login', [
            'email'    => 'user@example.com',
            'password' => 'Secret1234!',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
        $this->assertFalse(session()->has('admin_logged_in'));
    }

    public function test_authenticated_user_accessing_login_page_redirected_to_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/login');

        $response->assertRedirect('/admin/dashboard');
    }

    public function test_logout_destroys_the_authenticated_session(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post('/admin/logout');

        $response->assertRedirect('/admin/login');
        $response->assertSessionHas('success');
        $this->assertGuest();
        $this->assertFalse(session()->has('admin_logged_in'));
    }

    public function test_rate_limiting_blocks_after_too_many_attempts(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/admin/login', [
                'email'    => 'admin@example.com',
                'password' => 'WrongPassword',
            ]);
        }

        $response = $this->post('/admin/login', [
            'email'    => 'admin@example.com',
            'password' => 'WrongPassword',
        ]);

        $response->assertSessionHasErrors('email');
        $errors = session('errors')->get('email');
        $this->assertStringContainsString('Too many login attempts', $errors[0]);
    }

    public function test_admin_create_artisan_command(): void
    {
        $this->artisan('admin:create', [
            '--email'    => 'newadmin@example.com',
            '--name'     => 'New Admin',
            '--password' => 'StrongPassword123!',
        ])->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'email' => 'newadmin@example.com',
            'name'  => 'New Admin',
        ]);

        $user = User::where('email', 'newadmin@example.com')->first();
        $this->assertTrue(Hash::check('StrongPassword123!', $user->password));
    }

    public function test_admin_user_seeder_skips_when_credentials_missing(): void
    {
        // When password or name is missing, seeder should skip
        config([
            'auth.admin_email'    => 'admin@example.com',
            'auth.admin_name'     => null,
            'auth.admin_password' => null,
        ]);
        putenv('ADMIN_NAME=');
        putenv('ADMIN_PASSWORD=');

        $initialUserCount = User::count();

        $this->seed(\Database\Seeders\AdminUserSeeder::class);

        $this->assertEquals($initialUserCount, User::count());
    }

    public function test_admin_user_seeder_creates_admin_when_all_credentials_provided(): void
    {
        config([
            'auth.admin_email'    => 'seededadmin@example.com',
            'auth.admin_name'     => 'Seeded Admin',
            'auth.admin_password' => 'SeededSecurePass456!',
        ]);

        $this->seed(\Database\Seeders\AdminUserSeeder::class);

        $this->assertDatabaseHas('users', [
            'email' => 'seededadmin@example.com',
            'name'  => 'Seeded Admin',
        ]);

        $user = User::where('email', 'seededadmin@example.com')->first();
        $this->assertTrue(Hash::check('SeededSecurePass456!', $user->password));
    }

    public function test_admin_user_seeder_does_not_overwrite_existing_user_password(): void
    {
        // $this->admin already exists with 'Secret1234!' password
        config([
            'auth.admin_email'    => 'admin@example.com',
            'auth.admin_name'     => 'Different Name',
            'auth.admin_password' => 'NewDifferentPassword999!',
        ]);

        $this->seed(\Database\Seeders\AdminUserSeeder::class);

        $admin = User::where('email', 'admin@example.com')->first();
        // Password must remain the original and NOT be overwritten
        $this->assertTrue(Hash::check('Secret1234!', $admin->password));
        $this->assertFalse(Hash::check('NewDifferentPassword999!', $admin->password));
        $this->assertEquals('Admin User', $admin->name);
    }
}
