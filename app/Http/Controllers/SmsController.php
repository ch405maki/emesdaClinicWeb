<?php

namespace App\Http\Controllers;

use App\Services\TwilioService;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function sendSms(Request $request)
    {
        // Hardcoded values for testing
        $to = '+639971734770';  // Your hardcoded phone number
        $message = 'Hello, this is a test message!';  // Your hardcoded message

        // try {
        //     $this->twilioService->sendSms($to, $message);
        //     return response()->json(['success' => 'SMS sent successfully to ' . $to]);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'SMS failed to send: ' . $e->getMessage()], 500);
        // }
    }
}

