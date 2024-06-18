<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function register_card(Request $request)
    {
        $user = Auth::user();

        $pay_jp_secret = env('PAYJP_SECRET_KEY');
        \Payjp\Payjp::setApiKey($pay_jp_secret);

        $card = [];
        $count = 0;

        if ($user->token != "") {
            dd(\Payjp\Customer::retrieve($user->token)->cards->all(array("limit" => 1))->data);
            $result = \Payjp\Customer::retrieve($user->token)->cards->all(array("limit" => 1))->data[0];
            $count = \Payjp\Customer::retrieve($user->token)->cards->all()->count;

            $card = [
                'brand' => $result["brand"],
                'exp_month' => $result["exp_month"],
                'exp_year' => $result["exp_year"],
                'last4' => $result["last4"]
            ];
        }

        return view('users.register_card', compact('card', 'count'));
    }

    public function token(Request $request)
    {
        $pay_jp_secret = env('PAYJP_SECRET_KEY');
        \Payjp\Payjp::setApiKey($pay_jp_secret);

        $user = Auth::user();
        $customer = $user->token;

        if ($customer != "") {
            $cu = \Payjp\Customer::retrieve($customer);

            $delete_card = $cu->cards->retrieve($cu->cards->data[0]["id"]);
            $delete_card->delete();
            $cu->cards->create(array(
                "card" => request('payjp-token')
            ));
        } else {
            $cu = \Payjp\Customer::create(array(
                "card" => request('payjp-token')
            ));
            $user->token = $cu->id;
            $user->update();
        }

        return redirect()->route('home');
    }


    public function getPremium()
    {
        $pay_jp_secret = env('PAYJP_SECRET_KEY');
        \Payjp\Payjp::setApiKey($pay_jp_secret);

        $user = Auth::user();

        $res = \Payjp\Charge::create(
            [
                "customer" => $user->token,
                "amount" =>  300,
                "currency" => 'jpy'
            ]
        );
        if ($res) {
            $user = Auth::user();
            $user->user_type = 'premium';
            $user->save();
            return redirect()->route('home');
        }
    }
}
