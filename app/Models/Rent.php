<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $table = "rents";
    protected $primaryKey = "id";

    protected $fillable = [
        "user_id",
        "room_id",
        "started_time",
        "end_time",
        "status"
    ];
}
