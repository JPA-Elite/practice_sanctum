<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class revenue extends Model
{
    protected $fillable = [
        "username",
        "password",
        "amount"
    ];


    use HasApiTokens, HasFactory;
}
