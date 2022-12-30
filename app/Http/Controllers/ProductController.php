<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProducts()
    {
        
        $products = Product::all();

        return response($products, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct(Request $request)
    {
        try {

            $request->validate([
                'name' => ['required', 'max:120'],
                'price' => ['max:120'],
                'description' => ['max:255'],
            ]);
            
            $slug = str_replace(' ', '_', strtolower(trim($request->get('name'))));

            $imageURL = $request->file('image')->store('images/products');

            throw_if(isEmpty($imageURL), new Exception('Error al subir imagen, path devuelto: '.$imageURL, 400));

            $product = Product::create([
                'name' => $request->get('name'),
                'slug' => $slug,
                'price' => $request->get('price', 0),
                'image' => $imageURL,
                'description' => $request->get('description'),
                'creation_date' => $request->get('creation_date')
            ]);

            throw_if(!$product, new Exception('Creation error', 400));

            return response($product, 200);

        }catch(Exception $e){

            if($e->getCode() === 400){
                return response($e->getMessage(), $e->getCode());   
            }

            return response($e->getMessage());

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
