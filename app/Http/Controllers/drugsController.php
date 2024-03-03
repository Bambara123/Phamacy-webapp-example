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


        // add data to drugs table and update the prescription status 
        $incomingFields = $request->validate([
            'prescription_id' => 'required',
            'medicines' => 'required',
            'tot_price' => 'required',
        ]);

        $prescription = Prescriptions::find($incomingFields['prescription_id']);

        $user_id = $prescription->user_id;

        //  get the email of use_id.
        $email  = User::find($user_id)->email;

        if ($prescription) {
            // update the total price
            $prescription->total_price = $incomingFields['tot_price'];
            $prescription->status = 'Quotation Available';
            $prescription->save();
        }


        // add data to drugs table

        foreach ($incomingFields['medicines'] as $medicine) {
            $drug = new Drugs;
            $drug->prescription_id = $incomingFields['prescription_id'];
            $drug->drug_name = $medicine['name'];
            $drug->amount = $medicine['quantity'];
            $drug->total_price = $medicine['total_price'];
            $drug->save();
        }


        // send email to user
        Mail::to($email)->send(new HelloMail());

        return redirect('/');
    }
}
