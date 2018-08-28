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

    public function withdrawStore(MoneyValidationFormRequest $request)
    {
        $valorRetirada = floatval($request->input('valor'));

        $balance    = auth()->user()->balance()->firstOrCreate([]);
        $response   = $balance->withdraw($valorRetirada);

        if ($response['success'])
            return redirect()
                        ->route('admin.balance')
                        ->with('success', $response['message']);
        
        return redirect()
                    ->back()
                    ->with('error', $response['message']);
    }
    
    public function confirmUsertransfer()
    {
        return view('admin.balance.confirm-user-transfer');
    }

    public function confirmValueTransfer(Request $request, User $user)
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
        
        $balance = auth()->user()->balance;
        return view('admin.balance.confirm-value-transfer', compact('sender', 'balance'));

    }

    public function storeTransfer(MoneyValidationFormRequest $request, User $user){
        
        if(!$sender = $user->find($request->cdUsuarioDestino))
            return redirect()
                        ->back()
                        ->with('error', 'Usuário de destino não encontrado');

        $valorRetirada = floatval($request->input('valor'));

        $balance    = auth()->user()->balance()->firstOrCreate([]);
        $response   = $balance->transfer($valorRetirada, $sender);

        if ($response['success'])
            return redirect()
                        ->route('admin.balance')
                        ->with('success', $response['message']);
        
        return redirect()
                    //->back()
                    ->route('balance.transfer.confirmUser')
                    ->with('error', $response['message']);

    }
}
