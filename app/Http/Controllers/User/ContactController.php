<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquiryRequest as Request;
use App\Models\Inquiry;
use App\Mail\Inquiry as MailInquiry;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $inquiry = Inquiry::create($request->all());
        $inquiry = Inquiry::find($inquiry->id);

        Mail::to(config('mail.from.address'))->send(new MailInquiry($inquiry));

        return response()->json(['data' => ['message' => 'Inquiry already sent!']]);
    }
}
