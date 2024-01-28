<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

use Lahirulhr\PayHere;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    
     public function initiatePayment()
                {
                    $merchantId = 'your_merchant_id';
                    $merchantSecret = 'your_merchant_secret';
                    $notifyUrl = 'http://www.visanduma.com/notify'; // Replace with your actual notify URL

                    $data = [
                        'merchant_id' => $merchantId,
                        'return_url' => 'http://www.visanduma.com/success',
                        'cancel_url' => 'http://www.visanduma.com/cancel',
                        'notify_url' => $notifyUrl,
                        'order_id' => '45552525005',
                        'items' => 'Smart band MI 4 - BLACK',
                        'currency' => 'LKR',
                        'amount' => 4960.00,
                    ];

                    // Generate a hash for data integrity (refer to PayHere documentation)
                    $hash = md5(implode('', $data) . $merchantSecret);

                    $requestData = array_merge($data, ['hash' => $hash]);

                    // Make a POST request to PayHere Checkout API
                    $response = Http::post('https://sandbox.payhere.lk/pay/checkout', $requestData);

                    // Check the response and handle accordingly
                    if ($response->successful()) {
                        // Successful API response, redirect the user to the PayHere payment page
                        return redirect($response['url']);
                    } else {
                        // Handle the error, maybe log it
                        return response()->json(['error' => $response->json()], 500);
                    }
                }
}
