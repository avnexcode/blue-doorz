<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = "reports";
    protected $primaryKey = "id";
    protected $guarded = ["id"];
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        "transaction_id",
    ];

    public function transactions()
    {
        return $this->hasMany(User::class, 'user_id');
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
