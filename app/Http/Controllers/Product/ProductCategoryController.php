<?php

namespace App\Http\Controllers\Product;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $categories = $product->category;

        return $this->showAll($categories);
    }


    public function update(Request $request, Product $product, Category $category)
    {
        $product->category()->syncWithoutDetaching([$category->id]);

        return $this->showAll($product->category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Category $category)
    {
        if(!$product->category()->find($category->id)){
            return $this->errorResponse('The specified category is not a category of this product', 404);
        }

        $product->category()->detach($category->id);

        return $this->showAll($product->category);
    }
}
