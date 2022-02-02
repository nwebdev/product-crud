<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::latest()->paginate(10);
        return Inertia::render('Product/Index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productRequest = $request->all();
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = Storage::disk('localimage')->put('image', $request->file('image'));
            $productRequest['image'] = $image_path;
        }
        Product::create(
           $productRequest
        );

        return Redirect::route('products.index');
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
        return Inertia::render('Product/Edit', [
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'upc' => $product->upc,
                'status' => $product->status,
                'image' => $product->image,
            ]
        ]);
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
        $productRequest = $request->all();
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = Storage::disk('localimage')->put('image', $request->file('image'));
            $productRequest['image'] = $image_path;
        }
        $product->update($productRequest);
    
        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return Redirect::route('product.index');
    }


    /**
     * Remove the multiple resources.
     *
     * @param  $ids
     * @return false
     */
    public function delete_products($id)
    {

       $single_product_id = explode(',' , $id);

       foreach($single_product_id as $id) {
            Product::findOrFail($id)->delete();
       }

    }
}
