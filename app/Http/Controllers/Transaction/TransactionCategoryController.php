<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $category = $transaction->product()->with('category')->get()->pluck('category')->unique('id')->values();
//        $category = $transaction->prouduct->categories;
//        $category = $transaction->prouducts()->with('categories')->get();

        return $this->showAll($category);
    }
}
