<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Categorie;
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

  public function categorie()
{
    return $this->belongsTo(Categorie::class, 'categorie_id');
}

    // Relation avec l'utilisateur (optionnel)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //use HasFactory;
}
