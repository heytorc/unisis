<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MoneyValidationFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\User;

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

    public function confirmTransfer(Request $request, User $user)
    {   
        $sender = $user->getSender($request->nmUsuarioDestino);
        
        if (!$sender)
            return redirect()
                    ->back()
                    ->with('error', 'Usuário não encontrado!');
        
        if($sender->id == auth()->user()->id)
            return redirect()
                    ->back()
                    ->with('error', 'Você não pode transferir para você mesmo!');
        
        return view('admin.balance.confirm-transfer', compact('sender'));

    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function transferStore(MoneyValidationFormRequest $request)
    {
        dd($request->all());
    }
}
