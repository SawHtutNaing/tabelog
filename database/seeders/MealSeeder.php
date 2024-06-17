<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Support\Facades\Http;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://www.themealdb.com/api/json/v1/1/search.php?s');
        $php_array = $response->json()['meals'];


        $meals = [];
        for ($i = 0; $i < count($php_array); $i++) {
            $meals[$i] = [
                'name' => $php_array[$i]['strMeal'],
                'category' => $php_array[$i]['strArea'],
                'price' => rand(1111, 9999),
                'thumbnail' => $php_array[$i]['strMealThumb'],
            ];
        }

        Meal::insert($meals);
    }
}
