<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = array('nomCategorie');
    public static $rules = array('nomCategorie'=>'required∣min:3');

    //use HasFactory;
}
