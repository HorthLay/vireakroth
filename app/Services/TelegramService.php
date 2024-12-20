<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected $apiToken;
    protected $chatId;

    public function __construct()
    {
        // Get the bot token and chat ID from environment variables
        $this->apiToken = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID');
    }

    public function sendMessage($message)
    {
        // Define the Telegram API URL for sending a message
        $url = "https://api.telegram.org/bot{$this->apiToken}/sendMessage";

        // Send the message using the Http client with SSL verification disabled
        $response = Http::withOptions([
            'verify' => false, // Disable SSL certificate verification
        ])->post($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);

        // Optional: Handle the response (e.g., logging or error handling)
        if ($response->successful()) {
            return true;
        } else {
            // Log the error or throw an exception
            return false;
        }
    }
}
