<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = new User([
            'name' => 'Nárcius Maximus',
            'email' => 'gulandras90@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Andras123!'),
            'role' => 1, // 1 = admin
            'remember_token' => Str::random(10),
        ]);

        $adminUser->save();
    }
}
