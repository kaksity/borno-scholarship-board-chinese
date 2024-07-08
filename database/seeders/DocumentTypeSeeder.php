<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = [
            ['name' => 'Indigene Letter'],
            ['name' => 'National ID Card'],
            ['name' => 'Primary School Leaving Certificate'],
            ['name' => 'WAEC']
        ];

        DB::transaction(function() use($documentTypes) {
            foreach ($documentTypes as $documentType) {
                DocumentType::create($documentType);
            }
        });
    }
}
