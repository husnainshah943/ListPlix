<?php
namespace App\Repository;

use App\Repository\Interfaces\ContactUsInterface;
use Illuminate\Support\Facades\Mail;

class ContactUsRepository implements ContactUsInterface
{

    public function contact_us($attributes)
    {
        $send_mail_details['to'] = 'djshah943@gmail.com';
        $send_mail_details['name'] = $attributes['name'];
        $send_mail_details['email'] = $attributes['email'];
        $send_mail_details['subject'] = $attributes['subject'];
        $send_mail_details['body'] =  $attributes['body'];

        Mail::send('contactus', ['send_mail_details' => $send_mail_details], function ($messages) use ($send_mail_details) {
            $messages->to($send_mail_details['to']);
            $messages->subject($send_mail_details['subject']);
        });

        return true;
    }

}
