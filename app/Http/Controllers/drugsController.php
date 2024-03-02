<?php

namespace App\Http\Controllers;

use PhpOption\None;
use App\Models\Drugs;
use Illuminate\Http\Request;

class drugsController extends Controller
{
    public function createDrugs(Request $request)
    {



        $incomingFields = $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'total_price' => 'required',
        ]);

        dd($request->all());



        $incomingFields['drug_name'] = strip_tags($incomingFields['name']);
        $incomingFields['quantity'] = strip_tags($incomingFields['quantity']);
        $incomingFields['total_price'] = strip_tags($incomingFields['total_price']);


        $drugs = Drugs::create($incomingFields);


        return response()->json(['message' => 'Submission successful'], 200);
    }
}
