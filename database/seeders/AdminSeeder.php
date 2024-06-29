<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'surname' => 'Admin',
            'other_names' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
