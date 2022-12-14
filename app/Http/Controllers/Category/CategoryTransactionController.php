<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
//        $transaction = $category->prouducts()->with('transactions')->get()->pluck('transactions')->unique()->values();
        $transaction = $category->products()->whereHas('transactions')->with('transactions')->get()->pluck('transactions')->collapse();
        return $this->showAll($transaction);
    }
}
