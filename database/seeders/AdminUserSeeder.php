<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds an admin account from environment/config if all credentials are provided.
     * Does not overwrite existing credentials if the user already exists.
     */
    public function run(): void
    {
        $email = trim((string) (config('auth.admin_email') ?: env('ADMIN_EMAIL')));
        $name = trim((string) (config('auth.admin_name') ?: env('ADMIN_NAME')));
        $password = (string) (config('auth.admin_password') ?: env('ADMIN_PASSWORD'));

        if ($email === '' || $name === '' || $password === '') {
            $this->command?->warn('AdminUserSeeder skipped: ADMIN_EMAIL, ADMIN_NAME, and ADMIN_PASSWORD must all be defined in environment/config.');
            return;
        }

        $existingUser = User::where('email', $email)
            ->orWhereRaw('LOWER(email) = ?', [strtolower($email)])
            ->first();

        if ($existingUser) {
            $this->command?->info("Admin user [{$email}] already exists. Skipping to avoid overwriting password.");
            return;
        }

        User::create([
            'name'              => $name,
            'email'             => $email,
            'password'          => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->command?->info("Admin user [{$email}] created successfully.");
    }
}
