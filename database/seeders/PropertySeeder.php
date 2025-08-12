<?php

namespace Database\Seeders;

use Database\Factories\PropertyFactory;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++)
        {
            Property::factory()->create([
                'preview_image_src' => '/images/property'.$i.'.jpg',
            ]);
        }
    }
}
