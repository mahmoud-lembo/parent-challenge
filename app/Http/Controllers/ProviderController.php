<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {

    }

    public function filter($request, $transactions, $providerSchema, $providerStatus)
    {
    // Filter by transaction status
    if ($request->has('statusCode')) { 
        $transactions = array_filter($transactions, function($transaction) use ($request,$providerStatus,$providerSchema){
            if($transaction[$providerSchema[$transaction['Provider']]['status']] == array_search (strtolower($request->query('statusCode')), $providerStatus[$transaction['Provider']])){
                return $transaction;
            }
        });
                                    }
    // Filter by amount range
    if ($request->has(['balanceMin']) || $request->has(['balanceMax'])) {
        // Adding Possibility to use one Amount instead of a Range
        $balanceMin = $request->has('balanceMin') ? $request->query('balanceMin') : PHP_INT_MIN;
        $balanceMax = $request->has('balanceMax') ? $request->query('balanceMax') : PHP_INT_MAX;
        $transactions = array_filter($transactions, function($transaction) use ($request,$providerStatus,$providerSchema, $balanceMin, $balanceMax){
            if($transaction[$providerSchema[$transaction['Provider']]['amount']] >= $balanceMin && $transaction[$providerSchema[$transaction['Provider']]['amount']] <= $balanceMax){
                return $transaction;
            }
        });
                                                    }
    // Filter by currency
    if ($request->has('currency')) {
        $transactions = array_filter($transactions, function($transaction) use ($request,$providerStatus,$providerSchema){
            if(strtoupper($transaction[$providerSchema[$transaction['Provider']]['currency']]) == strtoupper($request->query('currency'))){
                return $transaction;
            }
        });
                                    }
    return $transactions;
    }

    public function callback(Request $request)
    {
    // All Transactions Array    
        $transactions = [];
    // Current Providers (Filter by Provider)
        $providerNames = ($request->has('provider')) ? [$request->query('provider')] : ["DataProviderX", "DataProviderY"];
    // Current Providers Schema    
        $providerSchema = [ 
            "DataProviderX"=>["id"=>"parentIdentification","amount"=>"parentAmount","currency"=>"Currency","email"=>"parentEmail","status"=>"statusCode","date"=>"registerationDate"],
            "DataProviderY"=>["id"=>"id","amount"=>"balance","currency"=>"currency","email"=>"email","status"=>"status","date"=>"created_at"]
        ];
    // Current Providers Status Codes
        $providerStatus = [
            "DataProviderX"=>["1"=>"authorised","2"=>"decline","3"=>"refunded"],
            "DataProviderY"=>["100"=>"authorised","200"=>"decline","300"=>"refunded"]
        ];
    // Loop Providers
        foreach($providerNames as $providerName)    {
        $path = storage_path() . "/json/${providerName}.json";
        $json = json_decode(file_get_contents($path), true);
        $transactionsCount = count($json['transactions']); // Precalculate for faster for loop

    // Add Provider Name to Each Transaction Array
        for($i=0;$i<$transactionsCount;$i++)    {
        $transaction= array_merge($json['transactions'][$i], ["Provider"=>$providerName]);
        array_push($transactions, $transaction);}
                                                    }
    // Filter by transactios
        $transactions = $this->filter($request, $transactions, $providerSchema, $providerStatus);

        $view = $request->has('gui') ? "home" : "json";
        return view($view, compact("transactions","providerSchema","providerStatus", "request"));
    }
}

