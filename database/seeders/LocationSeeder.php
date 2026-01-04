<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $locations = [
            [
                'id' => Str::uuid(),
                'name' => 'Serengeti National Park',
                'slug' => Str::slug('Serengeti National Park'),
                'description' => 'Famous for the Great Migration and rich wildlife.',
                'region' => 'Mara / Manyara',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ngorongoro Crater',
                'slug' => Str::slug('Ngorongoro Crater'),
                'description' => 'A unique volcanic caldera full of wildlife.',
                'region' => 'Arusha',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Mount Kilimanjaro',
                'slug' => Str::slug('Mount Kilimanjaro'),
                'description' => 'Africa’s highest mountain and iconic trekking destination.',
                'region' => 'Kilimanjaro',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Zanzibar (Unguja)',
                'slug' => Str::slug('Zanzibar Unguja'),
                'description' => 'Tropical island with beaches, culture, and history.',
                'region' => 'Zanzibar',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Stone Town',
                'slug' => Str::slug('Stone Town'),
                'description' => 'Historic heart of Zanzibar with Swahili heritage.',
                'region' => 'Zanzibar',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ruaha National Park',
                'slug' => Str::slug('Ruaha National Park'),
                'description' => 'Largest national park in Tanzania with rugged landscapes.',
                'region' => 'Iringa',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Mikumi National Park',
                'slug' => Str::slug('Mikumi National Park'),
                'description' => 'Accessible park known for open plains and wildlife.',
                'region' => 'Morogoro',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Nyerere National Park (Selous)',
                'slug' => Str::slug('Nyerere National Park'),
                'description' => 'One of Africa’s largest protected wildlife areas.',
                'region' => 'Morogoro',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Tarangire National Park',
                'slug' => Str::slug('Tarangire National Park'),
                'description' => 'Known for elephants and giant baobab trees.',
                'region' => 'Manyara',
                'country' => 'Tanzania',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Lake Manyara National Park',
                'slug' => Str::slug('Lake Manyara National Park'),
                'description' => 'Famous for tree-climbing lions and birdlife.',
                'region' => 'Manyara',
                'country' => 'Tanzania',
            ],
        ];

        DB::table('locations')->insert($locations);
    }
}
