<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function getInitialMenu() {

        try {

            $availableCategories = Category::with('subcategories')->get();

            return response($availableCategories, 200);

        } catch(Exception $e){
            return response($e->getMessage());
        }
        
    }
}
