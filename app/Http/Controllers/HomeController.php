<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    function index(Request $request)
    {
        $category  = null;

        $query = Meal::query();
        if ($request->query('category')) {
            $category = $request->query('category');
            $query->where('category', $category);
        }

        $meal = $query->get();


        return view('home', ['meal' => $meal]);
    }
}
