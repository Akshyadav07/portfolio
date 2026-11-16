<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create 
                            {--email= : The email address of the admin} 
                            {--name= : The name of the admin} 
                            {--password= : The password for the admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update an admin user for the portfolio control panel';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->option('email') ?: $this->ask('Admin Email');
        $name = $this->option('name') ?: $this->ask('Admin Name', 'Admin');
        $password = $this->option('password') ?: $this->secret('Admin Password');

        $validator = Validator::make([
            'email'    => $email,
            'name'     => $name,
            'password' => $password,
        ], [
            'email'    => ['required', 'string', 'email', 'max:255'],
            'name'     => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return self::FAILURE;
        }

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            if ($this->confirm("User with email [{$email}] already exists. Update password and name?", true)) {
                $existingUser->update([
                    'name'     => $name,
                    'password' => Hash::make($password),
                ]);

                $this->info("Admin user [{$email}] updated successfully.");
                return self::SUCCESS;
            }

            $this->warn('Operation cancelled.');
            return self::SUCCESS;
        }

        User::create([
            'name'              => $name,
            'email'             => $email,
            'password'          => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info("Admin user [{$email}] created successfully.");
        return self::SUCCESS;
    }
}
