<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {

    }

    public function callback(Request $request)
    {
  // Current Providers
        if ($request->has('provider')) {
            $providerNames = [$request->query('provider')];
        }else{
            $providerNames= ["DataProviderX", "DataProviderY"]; // Current Providers
        }
        if ($request->has('gui')) {
            $view = "home";
        }else{
            $view = "json";
        }
        $providerSchema = [ // Current Providers Schema
            "DataProviderX"=>["id"=>"parentIdentification","amount"=>"parentAmount","currency"=>"Currency","email"=>"parentEmail","status"=>"statusCode","date"=>"registerationDate"],
            "DataProviderY"=>["id"=>"id","amount"=>"balance","currency"=>"currency","email"=>"email","status"=>"status","date"=>"created_at"]
        ];
        $providerStatus = [ // Current Providers Status Codes
            "DataProviderX"=>["1"=>"authorised","2"=>"decline","3"=>"refunded"],
            "DataProviderY"=>["100"=>"authorised","200"=>"decline","300"=>"refunded"]
        ];
        $transactions = []; // All Transactions Container
        foreach($providerNames as $providerName){
        $path = storage_path() . "/json/${providerName}.json";
        $json = json_decode(file_get_contents($path), true); 
        $provider = ["Provider"=>$providerName]; // Transaction Provider Name
        $transactionsCount = count($json['transactions']); // Precalculate

        for($i=0;$i<$transactionsCount;$i++){ // Add Provider Name to Transactions Array
        $transaction= array_merge($json['transactions'][$i], $provider);
        array_push($transactions, $transaction);
                                            }
                                                }

        if ($request->has('statusCode')) { // filter by transactiom status
            $transactions = array_filter($transactions, function($transaction) use ($request,$providerStatus,$providerSchema){
                if($transaction[$providerSchema[$transaction['Provider']]['status']] == array_search ($request->query('statusCode'), $providerStatus[$transaction['Provider']])){
                    return $transaction;
                }
            });
        }
        if ($request->has(['balanceMin','balanceMax'])) { // filter by amount range
            $transactions = array_filter($transactions, function($transaction) use ($request,$providerStatus,$providerSchema){
                if($transaction[$providerSchema[$transaction['Provider']]['amount']] >= $request->query('balanceMin') && $transaction[$providerSchema[$transaction['Provider']]['amount']] <= $request->query('balanceMax')){
                    return $transaction;
                }
            });
        }
        if ($request->has('currency')) { // filter by currency
            $transactions = array_filter($transactions, function($transaction) use ($request,$providerStatus,$providerSchema){
                if($transaction[$providerSchema[$transaction['Provider']]['currency']] == $request->query('currency')){
                    return $transaction;
                }
            });
        }
        return view($view, compact("transactions","providerSchema","providerStatus"));
    }
}

