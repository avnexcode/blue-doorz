<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = "rooms";
    protected $primaryKey = "id";
    // protected $timestamps = true;
    // protected $cast = [
    //     "price" => "string",
    //     "status" => "string"
    // ];
    protected $hidden = [
        "password"
    ];
    protected $guarded = [
        "id"
    ];

    protected $fillable = [
        "category_id",
        "name",
        "room_number",
        "slug",
        "image",
        "description",
        "price",
        "status"
    ];

    public function scoopFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query
                ->where('name', 'like', "%$search")
                ->where('category', 'like', "%$search")
                ->where('price', 'like', "%$search")
                ->where('status', 'like', "%$search")
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) => $query
                ->where('slug', $category)
        );
    }
}
