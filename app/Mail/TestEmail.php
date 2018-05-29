<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {

        $address = 'team@sonicflow.com';
        $subject = 'Sonic Flow: Recover Password';
        $name = 'SonicFlow Team';

        return $this->view('emails.test')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with([ 'message' => $data['message'] ]);
    }

    public function send_stuff(){

        $data = ['message' => 'This is a test!'];

        Mail::to('lbaw1723@gmail.com')->send(new TestEmail($data));
    }
}
