<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $table = "rooms";
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $guarded = ["id"];
    public $timestamps = true;
    public $incrementing = true;
    protected $hidden = [
        "password"
    ];
    protected $with = [
        "category",
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
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
    public function transactions() {
        return $this->hasMany(Transaction::class, 'room_id');
    }
    
    public function scopeFilter($query, array $filters)
    {
        $filters = array_map(fn($value) => is_string($value) ? strtolower($value) : $value, $filters);

        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query
                ->where('name', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%")
                ->orWhereHas('category', fn($query) => 
                    $query->where('name', 'like', "%$search%")
                )
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) => $query
                ->where('slug', $category)
        );
    }
}
