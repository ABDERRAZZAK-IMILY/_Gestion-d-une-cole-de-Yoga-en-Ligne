<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WooWebhookController extends Controller
{
    public function handle(Request $request)
    {
       

        $payload = $request->all();

        Log::info('WooCommerce webhook payload received:', $payload);

        Log::info('WooCommerce webhook headers:', [
            'X-WC-Webhook-Topic' => $request->header('X-WC-Webhook-Topic'),
            'X-WC-Webhook-Signature' => $request->header('X-WC-Webhook-Signature'),
        ]);

        return response()->json(['message' => 'Webhook received successfully']);
    }
}
