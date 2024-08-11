<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Categorys extends Model
{
    use HasFactory, HasApiTokens;
    protected $guarded = [];
    //protected $table = 'categorys';
    //protected $fillabe = ['name','is_publish'];
}
