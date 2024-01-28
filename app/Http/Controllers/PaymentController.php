<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentLog;
use App\Models\Subject;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    
    

     public function initiatePayments($amount, $oder_key)
    {
     
        $apiEndpoint = Config::get('payhere.api_endpoint');
        $merchantId = Config::get('payhere.merchant_id');
        $merchantSecret = Config::get('payhere.merchant_secret');

        
        $app_url = env('APP_URL');
        $notifyUrl = $app_url .'/payment'; 

        $amount = $amount ;  
        $oder_id = $oder_key;
            
      $data = [
                'merchant_id' => $merchantId,
                'return_url' => $app_url .'/payment/notification',
                'cancel_url' => $app_url,
                'notify_url' => $notifyUrl,
                'order_id' => $oder_id,
                'items' => 'Class Fee',
                'currency' => 'LKR',
                'amount' => $amount,
                'first_name' => 'Guruniwasa',
                'last_name' => 'Institue',
                'email' => 'info@Guruniwasainstitute.lk',
                'phone' => '0771234567',
                'address' => 'Guruniwasa',
                'city' => 'Nugegoda',
                'country' => 'Sri Lanka',
                'hash' => strtoupper(md5($merchantId . $oder_id . number_format($amount, 2, '.', '') . 'LKR' . strtoupper(md5($merchantSecret))))// Replace with generated hash
            ];

        // Generate hash
        

        return view('payment.checkout', compact('data'));
        
    }

   
    public function retrievePaymentDetails(Request $request)
    {
        $orderId = $request->query('order_id');
        $app_id = Config::get('payhere.app_id');
        $app_secret = Config::get('payhere.app_secret');
        $apiEndpoint = Config::get('payhere.api_endpoint');

        $user_hash = base64_encode("$app_id:$app_secret");
        

        $client = new Client();
        $headers = [
            'Authorization' => 'Basic ' . $user_hash,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $options = [
            RequestOptions::FORM_PARAMS => [
                'grant_type' => 'client_credentials',
            ],
        ];

        $response = $client->post($apiEndpoint.'/merchant/v1/oauth/token', [
            'headers' => $headers,
            'form_params' => $options[RequestOptions::FORM_PARAMS],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        // Store the access_token in another variable
        $accessToken = $data['access_token'];

        $getPaymentDetails = $this->getPaymentDetails($apiEndpoint, $orderId, $accessToken);
        
        return $getPaymentDetails;
        // Now you can use $storedAccessToken for further processing
        
    }

    

    private function getPaymentDetails($apiEndpoint, $orderId, $accessToken)
    {

        $domain  = Config::get('payhere.domain');
        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken",
            'Content-Type' => 'application/json',
        ])->get("{$apiEndpoint}/merchant/v1/payment/search?order_id=$orderId");

        $jsonResponse = $response->json();
        $paymentLog = PaymentLog::where('order_key', $orderId)->first();
        // Check if status is 'RECEIVED' before proceeding
        if (isset($jsonResponse['data'][0]['status']) && $jsonResponse['data'][0]['status'] === 'RECEIVED') {
            // Redirect to the specified URL with the 'online_payed' parameter
            if ($paymentLog) {
                    $reid = $paymentLog->reid;
                    $paying_months = $paymentLog->pay_month;

                    $fee_count = unserialize($paymentLog->pay_list);
                     $redirectUrl = $domain."/profile/class_payments.php?online_payed";
                    foreach ($fee_count as $select_payment) {
                        $select_payment = explode(",", $select_payment); //teacher id, subject id, amount

                        $subject_query = DB::table('lmssubject')->select('fees_valid_period')->where('sid', $select_payment[1])->first();
                        $subject_valid_days = $subject_query->fees_valid_period;

                        if ($subject_valid_days == "EOM") {
                            $exp_date = date("Y-m-t", strtotime(date("Y-m-d")));
                        } elseif ($subject_valid_days == "150D") {
                            $exp_date = date('Y-m-d', strtotime('+150 day'));
                        } else {
                            $exp_date = date('Y-m-d', strtotime('+1 month'));
                        }

                        $year = explode('-', $paying_months)[0];
                        $month = explode('-', $paying_months)[1];
                        $this_month = date('m', strtotime('now'));
                        $exp_date = date("Y-m-t", strtotime($paying_months));

                        //-----------------------
                        $paying_month = $paying_months;

                        if (date("Y-m", strtotime($paying_month)) < date("Y-m")) {
                            echo "Invalid month selected";
                            exit;
                        } else {

                            if ($subject_valid_days == 1) {
                                if (date("Y-m-d") <= date("Y-m-t", strtotime(date($paying_month)))) {
                                    $Q = DB::select(DB::raw("SELECT DATE_ADD('" . date('Y-m-d') . "',INTERVAL + " . $subject_valid_days . " DAY) as dd "));
                                    $fina_date = $Q[0]->dd;
                                }
                            } elseif ($subject_valid_days == 30) {
                                if (date("Y-m-d") <= date("Y-m-t", strtotime(date($paying_month)))) {
                                    $fina_date = date("Y-m-t", strtotime(date($paying_month)));
                                } else {
                                    $Q = DB::select(DB::raw("SELECT DATE_ADD('" . date('Y-m-d') . "',INTERVAL + " . $subject_valid_days . " DAY) as dd "));
                                    $fina_date = $Q[0]->dd;
                                }
                            } elseif ($subject_valid_days == 40) {
                                if (date("Y-m-d") <= date("Y-m-t", strtotime(date($paying_month)))) {
                                    
                                    $Q = DB::select('SELECT DATE_ADD(?, INTERVAL + ? DAY) as dd',[date("Y-m-t", strtotime($paying_month)), ($subject_valid_days - 30)]);
                                    $fina_date = $Q[0]->dd;
                                }
                            } elseif ($subject_valid_days == 45) {
                                if (date("Y-m-d") <= date("Y-m-t", strtotime(date($paying_month)))) {
                                    $Q = DB::select(DB::raw("SELECT DATE_ADD('" . date("Y-m-t", strtotime(date($paying_month))) . "',INTERVAL + " . ($subject_valid_days - 30) . " DAY) as dd "));
                                    $fina_date = $Q[0]->dd;
                                }
                            } elseif ($subject_valid_days == 90) {
                                if (date("Y-m-d") <= date("Y-m-t", strtotime(date($paying_month)))) {
                                    $Q = DB::select(DB::raw("SELECT DATE_ADD('" . date("Y-m-t", strtotime(date($paying_month))) . "',INTERVAL + " . ($subject_valid_days - 30) . " DAY) as dd "));
                                    $fina_date = $Q[0]->dd;
                                }
                            }

                            $exp_date = $fina_date;
                        }

                        //-----------------------

                        if (!isset($error)) {
                            $course_fee = $select_payment[2];
                            if (count($fee_count) >= 6) {
                                $course_fee = (3 * $course_fee) / 4;
                            }
                            $course_fee = $course_fee;
                           
                            // Wrap database operations in a transaction
                                DB::transaction(function () use ($reid, $select_payment, $course_fee, $exp_date, $paying_months, $paymentLog) {
                                    // Eloquent for inserting into lmspayment
                                    DB::table('lmspayment')->insert([
                                        'userID' => $reid,
                                        'feeID' => $select_payment[0],
                                        'pay_sub_id' => $select_payment[1],
                                        'amount' => $course_fee,
                                        'accountnumber' => '0',
                                        'bank' => 'Pay Online',
                                        'branch' => 'Online Class',
                                        'paymentMethod' => 'Card',
                                        'created_at' => now(),
                                        'expiredate' => $exp_date,
                                        'session_id' => 0,
                                        'status' => 1,
                                        'order_status' => 1,
                                        'pay_month' => $paying_months . "-01",
                                    ]);

                                    $paymentLog->update(['status' => 1]);
                                });

                      
                            
                        } else {
                            header("location:class_payments.php?error='" . $error);
                            die();
                        }
                    }
               
                header("Location: $redirectUrl");
                exit;
                    // Redirect or do other necessary actions
                } else {
                    // Handle the case where the record with the specified order_key is not found
                    // Redirect or show an error message
                }
            

            
           
        } else {
            $redirectUrl = $domain."/profile/class_payments.php?online_fail";
            header("Location: $redirectUrl");
            exit;
        }
    }




    

    

}
