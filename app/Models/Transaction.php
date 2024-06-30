<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $primaryKey = "id";
    protected $guarded = ["id"];
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        "user_id",
        "room_id",
        "started_time",
        "end_time",
        "total_price",
        "payment_method",
        "status",
        "phone",
        "total_day",
        "nik"
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $filters = array_map(fn ($value) => is_string($value) ? strtolower($value) : $value, $filters);

        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query
                ->where('price', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%")
                ->orWhere('payment_method', 'like', "%$search%")
                ->orWhereHas(
                    'customer',
                    fn ($query) =>
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                )
                ->orWhereHas(
                    'room',
                    fn ($query) =>
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%")
                )
        );
    }
}
