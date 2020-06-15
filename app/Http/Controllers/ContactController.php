<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailTrap;
use Illuminate\Support\Facades\Mail;
use Validator;


class ContactController extends Controller
{
    public function sendMail(Request $request)
    {
        //

        $validation = Validator::make($request->userForm, [
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string']
        ]);

        if ($validation->fails()) {

            $message = $validation->messages()->toArray();
            return response()
                ->json(['error' => $message ], 422 );
        }

        $infos = $request->userForm;


        Mail::to("thomas.regnier3001@gmail.com")->send(new MailTrap($infos));

        return response()
            ->json([]);
    }
}