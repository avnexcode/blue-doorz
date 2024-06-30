<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RoomResource;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::with('category')->filter(request()->only('search', 'category'))->get();
        $categories = Category::filter(request()->only('search'))->get();

        return view('pages.home.index', [
            "title" => "Home Page",
            'rooms' => RoomResource::collection($rooms),
            'categories' => CategoryResource::collection($categories)
        ]);
    }
}
