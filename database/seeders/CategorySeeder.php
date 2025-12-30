<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Adventure', 'Cultural', 'Historical', 'Nature', 'Relaxation', 'Wildlife'];

        foreach ($names as $name) {
            \App\Models\Category::create(['name' => $name]);
        }

        $this->call([
            CategorySeeder::class
        ]);
        
    }
}
