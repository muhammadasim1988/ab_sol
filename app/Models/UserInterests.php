<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterests extends Model
{
    use HasFactory;
    protected $table = "user_interest";

    protected $fillable = [
        'user_id',
        'interest_id',
    ];

}
