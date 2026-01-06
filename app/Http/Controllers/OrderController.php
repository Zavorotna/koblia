<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $userData = $request->validated();
        $this->tgBot($userData);
        
        return to_route('site.index');
    }

    public function tgBot($userData)
    {
        $textContent = "Ім'я замовника: <b>" . $userData['name'] . "</b>\n" .
            "Телефон: <b>" . $userData['userPhone'] . "</b>\n" .
            "Коментар: <b>" . $userData['comment'] . "</b>\n";

        Http::post("https://api.telegram.org/bot" . env("TOKEN_TG") . "/sendMessage", 
            [
                'chat_id' => env("CHAT_ID"),
                'text' => strip_tags($textContent, '<b><i><u><s><code><pre>'),
                'parse_mode' => "HTML"
            ],
        );
    }
}
