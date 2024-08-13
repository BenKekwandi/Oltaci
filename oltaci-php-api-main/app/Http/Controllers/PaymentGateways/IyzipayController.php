<?php

namespace App\Http\Controllers\PaymentGateways;

use App\Http\Requests\IyzipayPaymentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Iyzipay\Options;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Tour;
use App\Models\Payment;
use App\Http\Requests\IyzipayPayRequest;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;


class IyzipayController extends Controller
{

    private $options;

    public function __construct()
    {
        $this->options = new Options();
        $this->options->setApiKey(env('IYZIPAY_API_KEY'));
        $this->options->setSecretKey(env('IYZIPAY_SECRET_KEY'));
        $this->options->setBaseUrl(env('IYZIPAY_BASE_URL'));
    }
    public function pay(IyzipayPayRequest $req){

        $reservation = Reservation::find($req->input("reservation_id"));

        if(!$reservation){
            return response()->json([
                "error" => "Reservation Not found"
            ], 404);
        }

        $user = User::find($reservation->user_id);
        $tour = Tour::find($reservation->tour_id);

        $request = new \Iyzipay\Request\CreatePayWithIyzicoInitializeRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId(Uuid::uuid4()->toString());
        $request->setPrice($tour->price);
        $request->setPaidPrice($tour->price);
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setBasketId("B4674");
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $request->setCallbackUrl(env('CALLBACK_URL'));
        $request->setEnabledInstallments(array(2,3,6,9));
        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($user->id);
        $buyer->setName($user->name);
        $buyer->setSurname($user->lastname);
        $buyer->setGsmNumber($req->input('phone'));
        $buyer->setEmail($req->input('email'));
        $buyer->setIdentityNumber($req->input('identity_number'));
        $buyer->setLastLoginDate("2023-10-15 12:12:20");//
        $buyer->setRegistrationDate("2023-10-15 12:12:20");//
        $buyer->setRegistrationAddress($req->input('address'));
        $buyer->setIp($req->ip());
        $buyer->setCity("Istanbul");//
        $buyer->setCountry("Turkey");//
        $buyer->setZipCode("34000");//
        $request->setBuyer($buyer);
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName(env('SHIPPING_ADDRESS_CONTACT_NAME'));
        $shippingAddress->setCity(env('SHIPPING_ADDRESS_CITY'));
        $shippingAddress->setCountry(env('SHIPPING_ADDRESS_COUNTRY'));
        $shippingAddress->setAddress(env('SHIPPING_ADDRESS_ADDRESS'));
        $shippingAddress->setZipCode(env('SHIPPING_ADDRESS_ZIPCODE'));
        $request->setShippingAddress($shippingAddress);
        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName(env('BILLING_ADDRESS_CONTACT_NAME'));
        $billingAddress->setCity(env('BILLING_ADDRESS_CITY'));
        $billingAddress->setCountry(env('BILLING_ADDRESS_COUNTRY'));
        $billingAddress->setAddress(env('BILLING_ADDRESS_ADDRESS'));
        $billingAddress->setZipCode(env('BILLING_ADDRESS_ZIPCODE'));
        $request->setBillingAddress($billingAddress);

        $basketItems = [];

        $basketItem = new \Iyzipay\Model\BasketItem();
        $basketItem->setId($tour->id);
        $basketItem->setName("Boat Tour");
        $basketItem->setCategory1("Boat Tour");
        $basketItem->setCategory2("Boat Tour");
        $basketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        $basketItem->setPrice($tour->price);
        $basketItems[] = $basketItem;


        $request->setBasketItems($basketItems);

        $payWithIyzicoInitialize = \Iyzipay\Model\PayWithIyzicoInitialize::create($request, $this->options);

        \Log::info('Iyzipay Request: ', (array)$request);

        $response = (array)$payWithIyzicoInitialize;

        \Log::info('Iyzico Response: ', (array)$payWithIyzicoInitialize);

        if ($payWithIyzicoInitialize->getStatus() == 'success') {

            $payment = Payment::create([
                'reservation_id' => $reservation->id,
                'token' => $payWithIyzicoInitialize->getToken()
            ]);

            $reservation->update(['payment_id' => $payment->id]);

            return response()->json([
                "payment_url" => $payWithIyzicoInitialize->getPayWithIyzicoPageUrl(),
                "token" => $payWithIyzicoInitialize->getToken(),
                "token_expiration_time" => $payWithIyzicoInitialize->getTokenExpireTime(),
                "conversation_id" => $payWithIyzicoInitialize->getConversationId()
            ]);
        } else {

            \Log::error('Iyzico Error: ', [
                'status' => $payWithIyzicoInitialize->getStatus(),
                'errorMessage' => $payWithIyzicoInitialize->getErrorMessage(),
                'errorCode' => $payWithIyzicoInitialize->getErrorCode(),
                'rawResponse' => (array)$payWithIyzicoInitialize
            ]);

            return response()->json([
                'error' => $payWithIyzicoInitialize->getErrorMessage(),
                'code' => $payWithIyzicoInitialize->getErrorCode()
            ]);
    
        }
    }

    public function callback(Request $request)
    {
        $token = $request->input('token');

        $retrieveCheckoutFormRequest = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
        $retrieveCheckoutFormRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $retrieveCheckoutFormRequest->setToken($token);

        $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($retrieveCheckoutFormRequest, $this->options);

        if ($checkoutForm->getStatus() == 'success') {
        
            //
        } else {
            //
        }

        return response()->json(['status' => $checkoutForm->getStatus(), 'paymentId' => $checkoutForm->getPaymentId(), 'conversationId' => $checkoutForm->getConversationId()]);
    }

    public function check(Request $request)
    {
        $token = $request->input('token');

        $retrieveCheckoutFormRequest = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
        $retrieveCheckoutFormRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $retrieveCheckoutFormRequest->setToken($token);

        $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($retrieveCheckoutFormRequest, $this->options);

        if ($checkoutForm->getStatus() == 'success') {

            $paymentDetails = [
                'status' => $checkoutForm->getStatus(),
                'paymentId' => $checkoutForm->getPaymentId(),
                'conversationId' => $checkoutForm->getConversationId(),
                'price' => $checkoutForm->getPrice(),
                'paidPrice' => $checkoutForm->getPaidPrice(),
                'currency' => $checkoutForm->getCurrency(),
                'installment' => $checkoutForm->getInstallment(),
                'cardType' => $checkoutForm->getCardType(),
                'cardAssociation' => $checkoutForm->getCardAssociation(),
                'cardFamily' => $checkoutForm->getCardFamily(),
                'binNumber' => $checkoutForm->getBinNumber(),
                'lastFourDigits' => $checkoutForm->getLastFourDigits(),
                'authCode' => $checkoutForm->getAuthCode(),
                'phase' => $checkoutForm->getPhase(),
            ];
    
            return response()->json($paymentDetails);
            
        } else {
            return response()->json(['error' => $checkoutForm->getErrorMessage()]);
        }
    }


}
