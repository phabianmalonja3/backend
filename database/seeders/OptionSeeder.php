<?php

namespace Database\Seeders;

use App\Models\PackageOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = ["wifi","Hotel","Tranport","Guided Tour","Breakfast"];

        foreach ($options as $option) {

            PackageOption::create([
                "options"=>$option
            ]);
        }
    }
}
