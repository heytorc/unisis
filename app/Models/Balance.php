<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

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
        
        //Se conseguir inserir o saque e o histórico commita as alterações, se não, dá um rollback
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

    public function transfer(float $value, User $sender) : Array
    {
        if($this->amount < $value)
            return [
                'success' => false,
                'message' => 'Saldo insuficiente!'
            ]; 

        
        DB::beginTransaction();

        /**********************************************************************
        * Atualiza o próprio saldo
        * *********************************************************************/

        $totalBefore    = $this->amount ? $this->amount : 0;
        $this->amount   -= $value;  
        $transfer       = $this->save();

        //auth -> objeto com os dados da sessão
        //user -> objeto com os dados do usuário logado
        //historics -> metodo existente no model User.php onde relacionamos as tabelas
        $historic = auth()->user()->historics()->create([
            'type'                  => "T",
            'amount'                => $value,
            'total_before'          => $totalBefore,
            'total_after'           => $this->amount,
            'date'                  => date('Ymd'),
            'user_id_transaction'   => $sender->id
        ]);

        /**********************************************************************
        * Atualiza o saldo do recebedor
        * *********************************************************************/
        
        $senderBalance          = $sender->balance()->firstOrCreate([]); 
        $totalBeforeSender      = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount  += $value;
        $transferSender         = $senderBalance->save();

        //sender -> objeto com os dados do usuário passado como paramentro
        //historics -> metodo existente no model User.php onde relacionamos as tabelas
        $historicSender = $sender->historics()->create([
            'type'                  => "I",
            'amount'                => $value,
            'total_before'          => $totalBeforeSender,
            'total_after'           => $senderBalance->amount,
            'date'                  => date('Ymd'),
            'user_id_transaction'   => auth()->user()->id
        ]);
        
        //Se conseguir inserir o saque e o histórico commita as alterações, se não, dá um rollback
        if ($transfer && $historic && $transferSender && $historicSender){

            DB::commit();

            return [
                'success' => true,
                'message' => 'Transferência Realizada!'
            ];

        }
        
        DB::rollbak();
            
        return [
            'success' => false,
            'message' => 'Falha ao transferir o saldo!'
        ];
    }
}
