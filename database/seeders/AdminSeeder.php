<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'surname' => 'Isa',
                'other_names' => 'Bala',
                'email' => 'es.scholarship@bornostate.gov.ng',
                'password' => Hash::make('123456789'),
            ],
            [
                'surname' => 'Abubakar',
                'other_names' => 'Harun',
                'email' => 'harun@bornostate.gov.ng',
                'password' => Hash::make('123456789'),
            ]
            ];

        DB::transaction(function() use($admins) {
            foreach($admins as $admin) {
                Admin::create($admin);
            }
        });
    }
}
