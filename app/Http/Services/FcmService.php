<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class FcmService
{
    protected $client;
    protected $serverKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->serverKey = env('FCM_SERVER_KEY');
    }

    public function sendNotification($token, $title, $body)
    {
        $response = $this->client->post('https://fcm.googleapis.com/fcm/send', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->serverKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'to' => $token,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
            ],
        ]);

        return $response->getBody()->getContents();
    }
}
