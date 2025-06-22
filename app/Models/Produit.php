<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = array('user_id', 'categories_id', 'libelle', 'stock');

    public static $rules = array('libelle'=>'required∣min:3',
                                 'user_id'=>'required∣bigInteger',
                                 'categories_id'=>'required∣Integer',
                                 'stock'=>'required∣min:1'
    );

    public function getNameUserAttribute(){

        $u = User::find($this->user_id);
        return $u->name;
    }

    public function getCategorieAttribute(){

        $c = Categorie::find($this->categories_id);
        return $c->nomCategorie;
    }


    public function entrees()
    {
        return $this->hasMany(Entree::class);
    }
    //use HasFactory;
}
