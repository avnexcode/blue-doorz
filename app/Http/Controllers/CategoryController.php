<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::filter(request()->only('search'))->paginate(10);
        return view('pages.dashboard.category.index', [
            'title' => 'Dashboard Category',
            'categories' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.category.create', [
            'title' => "Create New Category"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData = array_map(fn ($value) => is_string($value) ? strtolower($value) : $value, $validatedData);

        $validatedData["slug"] = $this->generateSlug($validatedData["name"]);
        Category::create($validatedData);

        Alert::success('Berhasil', 'Menambahkan Data Kategori Baru');

        return redirect(route("categories.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view("pages.dashboard.category.detail", [
            "title" => "Detail " . str_replace(' ', ' ', ucwords(str_replace('_', ' ', $category->name))),
            "category" => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("pages.dashboard.category.edit", [
            "title" => "Category Update",
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        $validatedData = array_map(fn ($value) => is_string($value) ? strtolower($value) : $value, $validatedData);

        $category->update($validatedData);
        Alert::success('Berhasil', 'Memperbarui Data Kategori');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // $rooms = Room::where('category_id', $category->id)->get();
        // foreach ($rooms as $room) {
        //     $room->delete();
        // }

        $rooms = Room::where('category_id', $category->id)->get();
        foreach ($rooms as $room) {
            $room->category_id = null;
            $room->save();
        }

        $category->delete();
        Alert::success('Berhasil', 'Menghapus data kategori');
        return redirect(route('categories.index'));
    }

    protected function generateSlug(string $name): string
    {
        return strtolower(str_replace(' ', '-', $name));
    }
}
