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

            $availableCategories = Category::all()->with('subcategories');

            // $categoriesWithSubs = $availableCategories->map(function ($category) {
            //     if($category->has_subcategory){
            //         return [
            //             ...$category,
            //             'subcategory' => SubCategory::where(['category_id' => $category->id])
            //         ];
            //     } else {
            //         return $category;
            //     }
            // });

            return response($availableCategories, 200);

        } catch(Exception $e){
            return response($e->getMessage());
        }
        
    }
}
