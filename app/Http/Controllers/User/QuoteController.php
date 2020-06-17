<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest as Request;
use App\Models\Quote;
use App\Mail\Quote as MailQuote;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $quote = Quote::create($request->all());
        $quote = Quote::find($quote->id);

        Mail::to(config('mail.from.address'))->send(new MailQuote($quote));

        return response()->json(['data' => ['message' => 'Quote already sent!']]);
    }
}
