<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Message;
use App\Mail\NewContact;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'sender_email' => 'required|email|max:255',
                'text' => 'required|min:2'

            ],
            [
                'sender_email.required' => 'L\'email è un campo obbligatorio.',
                'sender_email.email' => 'Questo campo deve essere un\' email.',
                'sender_email.max' => 'L\' email non può avare più di :max caratteri',
                'text.required' => 'Il messaggio è un campo obbligatorio',
                'text.min' => 'Il messaggio deve avere almeno :min caratteri'
            ]
        );

        if ($validator->fails()) {
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        // $sended_at = Carbon::now()->format('Y-m-d H:i:s');
        // $sended_at->setTimezone('UTC');

        $timestamp = Carbon::now();
        $sended_at = Carbon::now('GMT+1');
        $data['sended_at'] = $sended_at;
        $new_lead = new Message();
        $new_lead->fill($data);
        $new_lead->save();

        // Mail::to('info@boolfolio.com')->send(new NewContact($new_lead));


        $success = true;
        return response()->json(compact('success'));
    }
}
