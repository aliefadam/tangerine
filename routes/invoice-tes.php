<?php

use Illuminate\Support\Facades\Route;

Route::get("/tes-email", function () {
    return view('mail.send-invoice-mail-to-user', [
        "data" => [
            "invoice" => "123123123ASDASD",
            "transaction_date" => format_date(now()),
            "label" => "Pilates Classes Director - Company Class - Drop In",
            "total" => 100000,
        ]
    ]);
});
Route::get("/tes-email-proof", function () {
    return view('mail.send-proof-payment', [
        "data" => [
            "invoice" => "123123123ASDASD",
            "transaction_date" => format_date(now()),
            "label" => "Pilates Classes Director - Company Class - Drop In",
            "total" => 100000,
            "proof_of_payment" => "PROOF_IMAGE_202502280318172.jpg",
        ]
    ]);
});
Route::get("/tes-email-confirm", function () {
    return view('mail.send-payment-confirm', [
        "data" => [
            "invoice" => "123123123ASDASD",
            "transaction_date" => format_date(now()),
            "label" => "Pilates Classes Director - Company Class - Drop In",
            "total" => 100000,
            "proof_of_payment" => "PROOF_IMAGE_202502280318172.jpg",
        ]
    ]);
});
