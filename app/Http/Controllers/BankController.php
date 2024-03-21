<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{BankLog,User};
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
   public function home()
   {
    
      if(BankLog::where('user_id',auth()->user()->id)->exists())
      {
        $account=BankLog::where('user_id',auth()->user()->id)->latest()->first();
        $balance=$account->balance;
        
      }
      else{
        $balance=0;
      }
        
        return view('bank.home',['balance'=>$balance]);
   }

   public function deposit()
   {
        return view('bank.deposit');
   }

   public function deposit_submit(Request $request)
   {
    
        if(isset($request->amount)  && $request->amount !=NULL && $request->amount > 0)
        {
            $user_id=auth()->user()->id;
            if(BankLog::where('user_id',$user_id)->exists())
             {
                $account=BankLog::where('user_id',$user_id)->latest()->first();
                $balance=$account->balance+$request->amount;
             }
             else{
                $balance=$request->amount;
                
             }
             $details='Deposit';
             $insert=BankLog::insert(['user_id'=>$user_id,'amount'=>$request->amount,
                                     'type'=>'credit','details'=>$details,'balance'=>$balance]);
             
            if($insert)
            {  
               
                    return response()->json(['status'=>true,'message'=>'SUCCESS']);
            }
            else{
                return response()->json(['status'=>false,'message'=>'Error while inserting']);

            }
        }
        else{
            return response()->json(['status'=>false,'message'=>'Missing required parameters']);
        }
   }

   public function withdraw()
   {
        return view('bank.withdraw');
   }

   public function withdraw_submit(Request $request)
   {
        if(isset($request->amount)  && $request->amount !=NULL && $request->amount > 0)
        {
            $user_id=auth()->user()->id;
            if(BankLog::where('user_id',$user_id)->exists())
            {
                $account=BankLog::where('user_id',$user_id)->latest()->first();
                if($account->balance >=$request->amount)
                {
                    $balance=$account->balance-$request->amount;
                    $details="Withdraw";
                    $insert=BankLog::insert(['user_id'=>$user_id,'amount'=>$request->amount,
                                     'type'=>'debit','details'=>$details,'balance'=>$balance]);
                    if($insert)
                    {  
                    
                            return response()->json(['status'=>true,'message'=>'SUCCESS']);
                    }
                    else{
                        return response()->json(['status'=>false,'message'=>'Error while inserting']);
        
                    }
                }
                else{
                    return response()->json(['status'=>false,'message'=>'Insufficient Balance']);

                }
            }
            else{
                return response()->json(['status'=>false,'message'=>'No deposits found']);

                
            }
            
        }
        else{
            return response()->json(['status'=>false,'message'=>'Missing required parameters']);
        }
    
    
   }

   public function transfer()
   {
        return view('bank.transfer');
   }

   public function transfer_submit(Request $request)
   {

            $validator=Validator::make($request->all(),
                        ['email'=>'required|exists:users,email',
                         'amount'=>'required|gt:0'],
                         ['email.required'=>'please enter email',
                          'email.exists'=>'invalid email',
                            ]);
            if($validator->fails())
            {
                return response()->json(['status'=>false,'validationErrors'=>$validator->errors()->toArray()]);
            }
            $from=auth()->user()->id;
            $to=User::where('email',$request->email)->select('id')->value('id');

            if($request->email == auth()->user()->email)
            {
                return response()->json(['status'=>false,'message'=>'Self transfer not supported']);

            }

            if(BankLog::where('user_id',$from)->exists())
            {
                $F_account=BankLog::where('user_id',$from)->latest()->first();
                $T_account=BankLog::where('user_id',$to)->latest()->first();
                if($F_account->balance >=$request->amount)
                {
                    $F_balance=$F_account->balance-$request->amount;
                    $T_balance=$T_account->balance+$request->amount;
                    $detailsFrom="Transfer to ".$request->email;
                    $detailsTo="Transfer from ".auth()->user()->email;
                    
                    $insert = BankLog::insert([
                        [
                            'user_id' => $from,
                            'amount' => $request->amount,
                            'type' => 'debit',
                            'details' => $detailsFrom,
                            'balance' => $F_balance
                        ],
                        [
                            'user_id' => $to,
                            'amount' => $request->amount,
                            'type' => 'credit',
                            'details' => $detailsTo,
                            'balance' => $T_balance
                        ]
                    ]);
                    if($insert)
                    {  
                    
                            return response()->json(['status'=>true,'message'=>'SUCCESS']);
                    }
                    else{
                        return response()->json(['status'=>false,'message'=>'Error while inserting']);
        
                    }
                }
                else{
                    return response()->json(['status'=>false,'message'=>'Insufficient Balance']);

                }
            }
            else{
                return response()->json(['status'=>false,'message'=>'No deposits found']);

                
            }
            
        
   }

   public function statement()
   {
       
            $statement=BankLog::where('user_id',auth()->user()->id)->get();
            return view('bank.statement',['statements'=>$statement]);
       
   }

}
