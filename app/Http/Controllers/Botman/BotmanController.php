<?php

namespace App\Http\Controllers\Botman;

use App\Http\Controllers\Controller;
use App\Models\SettingsCont;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use Botman\Botman\Drivers\DriverManager;
use Botman\Drivers\Telegram\TelegramDriver;
use App\Http\Controllers\Botman\SignalConversation;

class BotmanController extends Controller
{
    public function teleSetup()
    {
        $settings = SettingsCont::find(1);
        $config = [
            "telegram" => [
                "token" => $settings->telegram_bot_api
            ]
        ];

        DriverManager::loadDriver(TelegramDriver::class);

        // Create an instance
        $botman = BotManFactory::create($config, new LaravelCache());
        // Give the bot something to listen for.
        $botman->hears('Hi', function (BotMan $bot) {
            $bot->startConversation(new SignalConversation);
        })->skipsConversation();

        $botman->fallback(function ($bot) {
            $bot->reply('Sorry, I did not understand this command. Enter Hi to start a coversation');
        });

        // Start listening
        $botman->listen();
    }
}