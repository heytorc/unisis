<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function index()
    {
        //dd -> vardump
        //dd();
        
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;  

        return view("admin.balance.index", compact('amount'));
    }
}
