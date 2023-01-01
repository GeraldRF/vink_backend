<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Exception;
use Illuminate\Support\Facades\Cache;

class NavigationController extends Controller
{
    public function getMainStatus() {

        try {

            $response = Cache::remember('main-status', 1000000, function () {

                $settings = Setting::all();
                
                $categories = Category::with('subcategories')->with(['products' => function ($query) {
                    $query->latest()->take(8);
                }])->get();

                $featuredProducts = Product::where(['featured' => 1])->get();

                return json_encode([
                    'settings' => $settings,
                    'categories' => $categories,
                    'featured' => $featuredProducts
                ]);
            });

            return response($response, 200);

        } catch(Exception $e){
            return response($e->getMessage());
        }
        
    }
}
