<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $guarded = ["id"];
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "name",
        "slug"
    ];
    
    public function rooms() {
        return $this->hasMany(Room::class, 'category_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $filters = array_map(fn($value) => is_string($value) ? strtolower($value) : $value, $filters);
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query
                ->where('name', 'like', "%$search%")
                ->orWhereHas('rooms', fn($query) => 
                    $query->where('name', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhere('room_number', 'like', "%$search%")
                )
        );
        
    }

}
