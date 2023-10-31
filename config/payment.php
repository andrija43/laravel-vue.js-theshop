<?php

return [
    'payfast' => [
        'PAYFAST_MERCHANT_ID' => env("PAYFAST_MERCHANT_ID"),
        'PAYFAST_MERCHANT_KEY' => env("PAYFAST_MERCHANT_KEY")
    ],
    'authorizenet' => [
        'AUTHORIZE_NET_MERCHANT_LOGIN_ID' => env("AUTHORIZE_NET_MERCHANT_LOGIN_ID"),
        'AUTHORIZE_NET_MERCHANT_TRANSACTION_KEY' => env("AUTHORIZE_NET_MERCHANT_TRANSACTION_KEY")
    ],
    'mercadopago' => [
        'MERCADOPAGO_KEY' => env("MERCADOPAGO_KEY"),
        'MERCADOPAGO_ACCESS' => env("MERCADOPAGO_ACCESS"),
        'MERCADOPAGO_CURRENCY' => env("MERCADOPAGO_CURRENCY")
    ]
];
