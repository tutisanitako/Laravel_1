<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function showForm()
    {
        return view('greeting');
    }

    public function generateGreeting(Request $request)
    {
        $name = $request->user_name;
        $color = $request->favorite_color;
        $activity = $request->favorite_activity;

        $greeting = "Hello, $name! Nice to meet you. We know that your favorite color is $color and you like to $activity in your free time. A great choice!";

        return view('result', ['greeting' => $greeting]);
    }
}
