<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Balance extends Model
{
    //Incluir variável abaixo para definir o nome da tabela do banco se a mesma tiver nome diferente da Migration/Model
    //private $table = "balance";
    public $timestamps = false;

    public function deposit(float $value) : Array
    {   
        DB::beginTransaction();

        $totalBefore    = $this->amount ? $this->amount : 0;
        $this->amount   += $value;    
        $deposited      = $this->save();

        //auth -> objeto com os dados da sessão
        //user -> objeto com os dados do usuário logado
        //historics -> metodo existente no model User.php onde relacionamos as tabelas
        $historic = auth()->user()->historics()->create([
            'type'          => "I",
            'amount'        => $value,
            'total_before'  => $totalBefore,
            'total_after'   => $this->amount,
            'date'          => date('Ymd')
        ]);
        
        //Se consguir inserir o deposito e o histórico commita as alterações, se não, dá um rollback
        if ($deposited && $historic){

            DB::commit();

            return [
                'success' => true,
                'message' => 'Seu saldo foi recarregado!'
            ];

        }else{

            DB::rollbak();
            
            return [
                'success' => false,
                'message' => 'Falha ao recarregar saldo!'
            ];
        }
    }

    public function withdraw(float $value) : Array
    {   

        if($this->amount < $value)
            return [
                'success' => false,
                'message' => 'Saldo insuficiente!'
            ]; 

        
        DB::beginTransaction();

        $totalBefore    = $this->amount ? $this->amount : 0;
        $this->amount   -= $value;    
        $withdraw       = $this->save();

        //auth -> objeto com os dados da sessão
        //user -> objeto com os dados do usuário logado
        //historics -> metodo existente no model User.php onde relacionamos as tabelas
        $historic = auth()->user()->historics()->create([
            'type'          => "O",
            'amount'        => $value,
            'total_before'  => $totalBefore,
            'total_after'   => $this->amount,
            'date'          => date('Ymd')
        ]);
        
        //Se consguir inserir o deposito e o histórico commita as alterações, se não, dá um rollback
        if ($withdraw && $historic){

            DB::commit();

            return [
                'success' => true,
                'message' => 'O saque foi realizado!'
            ];

        }else{

            DB::rollbak();
            
            return [
                'success' => false,
                'message' => 'Falha ao sacar o saldo!'
            ];
        }
    }
}
