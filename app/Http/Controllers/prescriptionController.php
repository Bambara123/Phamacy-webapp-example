<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Mail\HelloMail;
use Illuminate\Http\Request;
use App\Models\Prescriptions;
use Illuminate\Support\Facades\Mail;;

class prescriptionController extends Controller
{

    public function rejectQuotation($id)
    {
        try {
            $prescription = Prescriptions::findOrFail($id);
            $prescription->status = 'Rejected';
            $prescription->save();

            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reject quotation. Error: ' . $e->getMessage());
        }
    }

    public function acceptQuotation($id)
    {

        try {
            $prescription = Prescriptions::findOrFail($id);
            $prescription->status = 'Accepted';
            $prescription->save();

            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to accept quotation. Error: ' . $e->getMessage());
        }
    }


    public function createPrescription(Request $request)
    {
        $incomingFields = $request->validate([
            'note' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',

        ]);

        $incomingFields['note'] = strip_tags($incomingFields['note']);
        $incomingFields['address'] = strip_tags($incomingFields['address']);
        $incomingFields['user_id'] = auth()->id();

        $prescription = Prescriptions::create($incomingFields);

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/images/', $name);

                // Save image details to images_table

                $image = new Images();
                $image->prescription_id = $prescription->id;
                $image->name = $name;
                $image->save();
            }
        }

        return redirect()->back();
    }
}
