<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sortie;
use App\Models\Entree;



class VisitorDashboardController extends Controller
{


    public function index()
    {
        return view('visitor', [
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'entryCount' => Entree::count(),
            'exitCount' => Sortie::count(),
            'recentActivities' => [], // optionnel
        ]);
    }

}
