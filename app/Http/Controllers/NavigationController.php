<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NavigationController extends Controller
{
    public function getMainStatus() {

        try {

            $response = Cache::remember('main-status', 1000000, function () {
                return json_encode([
                    'settings' => Setting::all(),
                    'menu' => Category::with('subcategories')->get(),
                    'products' => ''
                ]);
            });

            return response($response, 200);

        } catch(Exception $e){
            return response($e->getMessage());
        }
        
    }
}
