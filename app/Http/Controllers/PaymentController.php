<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Providers\OrderPlacedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class PaymentController extends Controller
{

    public function showPayment()
    {
        \Stripe\Stripe::setApiKey('sk_test_51IXnY6JqcnBPjORHLEQ02ZermXDBTct9jD3XI4bT1DrVw6npSRtndMj6CnK9BhL98P8nXLCMAIYtiUl7IhwmZzdm00dJgltXq2');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => Session::get('totalCost') * 100,
            'currency' => 'ron',
        ]);

        return view('/shop/client/payment', ['totalCost' => Session::get('totalCost'), 'intent' => $intent, 'user_email' => Auth::user()['email']]);
    }

    public function checkout()
    {
        $endpoint_secret = 'whsec_ETQ2sAa02HzNzpUV0kTT7f1VkgrTCKt9';

        $payload = @file_get_contents('php://input');
        $payload_decoded = json_decode($payload);
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        //\Log::info('PAYLOAD ' . json_encode($payload));

        if (count($payload_decoded->data->object->charges->data) > 0) {
            $user_email = $payload_decoded->data->object->charges->data[0]->billing_details->email;
            try {
                $event = \Stripe\Webhook::constructEvent(
                    $payload, $sig_header, $endpoint_secret
                );
            } catch (\UnexpectedValueException $e) {
                http_response_code(400);
                exit();
            }

            if ($event->type == "payment_intent.succeeded") {
                $intent = $event->data->object;
                printf("Succeeded: %s", $intent->id);

                $invoice = $this->generatePdfInvoice($user_email);

                //\Log::info($invoice);
                $eventData = ['invoice' => $invoice, 'user_email' => $user_email];
                OrderPlacedEvent::dispatch($eventData);

                http_response_code(200);
                exit();
            } elseif ($event->type == "payment_intent.payment_failed") {
                $intent = $event->data->object;
                $error_message = $intent->last_payment_error ? $intent->last_payment_error->message : '';
                printf("Failed: %s, %s", $intent->id, $error_message);
                http_response_code(400);
                exit();
            }
        }
    }

    public function showSuccess()
    {
       $this->storeOrder();
        return view('/shop/client/message', ['message' => 'Payment succeeded']);
    }

    protected function storeOrder()
    {
        $order = Order::create([
            'orderDate' => date("Y/m/d"),
            'totalCost' => Session::get('totalCost'),
            'user_id' => Auth::user()->id,
        ]);
        $quantities = Session::get('quantities');

        foreach (Session::get('cart') as $index => $value) {
            OrderItem::create([
                'cost' => $value->price * $quantities[$index]['amount'],
                'units' => $quantities[$index]['amount'],
                'order_id' => $order->id,
                'product_id' => $value->id
            ]);
        }

        Session::forget('cart');
        Session::forget('quantities');
        Session::forget('totalCost');
    }

    public function showError()
    {
        return view('/shop/client/message', ['message' => 'Payment failed']);
    }

    protected function generatePdfInvoice($email)
    {
        $user = User::all()->where('email', '=', $email)->first();
        $pdf = ClientOrderController::generatePDF('user_id', $user['id']);

        return $pdf->output();
    }
}
