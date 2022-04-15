<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class InquiriesController extends Controller
{
    public function store( Request $request )
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|max:50',
        //     'email' => 'required|email|max:50',
        //     'phone' => 'required',
        //     'message' => 'required|max:500'
        // ]);

dd(  $request->validate([
    '*' => 'required',
]));
        $errorMessages = $validator->errors()->all();

        if ($validator->fails()) {
            return response(['success' => false,
                'errors' => $errorMessages
            ],400);

        }

        $contact = new Inq();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $contact->save();

        Mail::send(new ContactForm($contact));

        return ['success' => 'Thank you for your email!'];

    }
}
