<?php

namespace NbaNews\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends BaseContoller
{

    public function index()
    {
        return view('pages.contact',$this->data);
    }

    public function send(Request $request){

        $request->validate([
            'name' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,11}(\s)*([A-ZČĆŠĐŽ][a-zčćšđž]{2,19})$/',
            'mail' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:3'
        ]);

        $mailData = array(

            'name' => $request->name,
            'mail' => $request->mail,
            'subject' => $request->subject,
            'text' => $request->message
        );

        try {

            Mail::send('email.contact',$mailData,function ($message) use ($mailData){

                $message->from($mailData['mail']);
                $message->to('drobnjak-85b1a2@inbox.mailtrap.io');
                $message->subject($mailData['subject']);

            });

            return redirect()->back()->with('email_success',"You successfully sent mail");
        } catch(\Exception $e) {

            \Log::info('Sending email failed error'.$e->getMessage());
            return redirect()->back()->with('email_error',"Application is not working, please come back later");
        }


    }

}
