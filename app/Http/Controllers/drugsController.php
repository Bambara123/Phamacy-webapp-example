<?php

namespace App\Http\Controllers;

use App\Models\Drugs;
use App\Mail\HelloMail;
use Illuminate\Http\Request;
use App\Models\Prescriptions;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class drugsController extends Controller
{
    public function createDrugs(Request $request)
    {

        $incomingFields = $request->validate([
            'prescription_id' => 'required',
            'medicines' => 'required',
            'tot_price' => 'required',
        ]);

        $prescription = Prescriptions::find($incomingFields['prescription_id']);

        $user_id = $prescription->user_id;

        $email  = User::find($user_id)->email;



        if ($prescription) {
            // update the total price
            $prescription->total_price = $incomingFields['tot_price'];
            $prescription->status = 'Quotation Available';
            $prescription->save();
        }


        foreach ($incomingFields['medicines'] as $medicine) {
            $drug = new Drugs;
            $drug->prescription_id = $incomingFields['prescription_id'];
            $drug->drug_name = $medicine['name']; // assuming 'name' is a field in your Drugs model
            $drug->amount = $medicine['quantity']; // assuming 'quantity' is a field in your Drugs model
            $drug->total_price = $medicine['total_price']; // assuming 'total_price' is a field in your Drugs model
            $drug->save();
        }

        Mail::to($email)->send(new HelloMail());

        return redirect('/');
    }
}
