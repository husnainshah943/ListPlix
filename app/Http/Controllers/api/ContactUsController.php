<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Repository\Interfaces\ContactUsInterface;

class ContactUsController extends Controller
{
    public $contact_us_repository;
    public function __construct(ContactUsInterface $contact_us_repository)
    {
        $this->contact_us_repository = $contact_us_repository;
    }

    public function contact_us(ContactUsRequest $request)
    {
        $response = $this->contact_us_repository->contact_us($request->all());
        if (!$response) {
            return response()->json(['error' => 'Unable to send email.'], 401);
        }else{
            return response()->json(['message' => 'Email sent successfully.'], 200);
        }
    }
}
