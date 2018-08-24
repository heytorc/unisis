<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MoneyValidationFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Balance;

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

    public function deposit()
    {
        return view("admin.balance.deposit");
    }

    public function depositStore(MoneyValidationFormRequest $request)
    {   
        $valorRecarga = floatval($request->input('valor'));

        $balance    = auth()->user()->balance()->firstOrCreate([]);
        $response   = $balance->deposit($valorRecarga);

        if ($response['success'])
            return redirect()
                        ->route('admin.balance')
                        ->with('success', $response['message']);
        
        return redirect()
                    ->back()
                    ->with('error', $response['message']);
    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(MoneyValidationFormRequest $request)
    {   

        $valorRecarga = floatval($request->input('valor'));

        $balance    = auth()->user()->balance()->firstOrCreate([]);
        $response   = $balance->withdraw($valorRecarga);

        if ($response['success'])
            return redirect()
                        ->route('admin.balance')
                        ->with('success', $response['message']);
        
        return redirect()
                    ->back()
                    ->with('error', $response['message']);
    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }
}
