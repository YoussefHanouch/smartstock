<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    use HasFactory;

    protected $fillable = array('produits_id', 'user_id', 'dateSortie', 'quantite', 'prix');
    public static $rule = array('produits_id'=>'required∣Integer',
                                'user_id'=>'required∣bigInteger',
                                'dateSortie'=>'date∣min:3',
                                'quantite'=>'required∣min:1',
                                'prix'=>'required∣min:2'
    );

    public function getNameUserAttribute(){

        $u = User::find($this->user_id);
        return $u->name;
    }

    public function getNomProduitAttribute(){

        $p = Produit::find($this->produits_id);
        return $p->libelle;
    }
}
