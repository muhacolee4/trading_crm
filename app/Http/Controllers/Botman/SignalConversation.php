<?php

namespace App\Http\Controllers\Botman;

use App\Notifications\PostForexSignal;
use App\Notifications\UpdateForexSignalResult;
use App\Traits\PingServer;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Support\Facades\Notification;

class SignalConversation extends Conversation
{
    use PingServer;
    public $toDo;
    public $tradeDirection;
    public $pair;
    public $price;
    public $tp1;
    public $tp2;
    public $sl;
    public $shouldPub;
    public $ref;
    public $result;

    public function askWhatToDo()
    {
        $question = Question::create('Hello Welcome, what would you like to do.')
            ->fallback('Sorry, i do not understand that, please try again.')
            ->callbackId('choosetodo')
            ->addButtons([
                Button::create('Post Signal')->value('post_signal'),
                Button::create('Update Result')->value('update_result'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue(); // will be either 'post_signal' or 'update_result'
                $selectedText = $answer->getText(); // will be either 'Post Signal' or 'Update Result'
                if ($selectedValue == 'post_signal' || $selectedText == 'Post Signal') {
                    $this->askTradeDir();
                } else {
                    $this->askTradeRef();
                }
            }
        });
    }

    public function askResult()
    {
        $this->ask('Enter the result for this signal', function (Answer $answer) {
            // Save result
            $value = $this->result = $answer->getText();
            if ($value == '') {
                return $this->repeat('Please enter signal result');
            } else {
                $this->postResult();
            }
        });
    }

    public function updateResult()
    {
        $response = $this->fetctApi('/update-result', [
            'ref' => $this->ref,
            'result' => $this->result
        ], 'POST');

        $info = json_decode($response);

        if ($info->error) {
            $this->say($info->message);
        } else {
            //$this->say($info->data->message);
            Notification::send($info->data->chat_id, new UpdateForexSignalResult($info->data->message));
        }
    }

    public function postResult()
    {
        $question = Question::create('Post Result to channel?')
            ->fallback('Sorry, i do not understand that, please try again.')
            ->callbackId('postresult')
            ->addButtons([
                Button::create('Post Result')->value('post_result'),
                Button::create('pause')->value('pause'),
            ]);
        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue(); // will be either 'post_signal' or 'update_result'
                $selectedText = $answer->getText(); // will be either 'Post Signal' or 'Update Result'
                if ($selectedValue == 'post_result' || $selectedText == 'Post Result') {
                    $this->updateResult();
                    $this->say('Result posted succesfully, Enter pause to end conversation');
                } else {
                    $this->say('Something went wrong, please try again');
                    $this->askWhatToDo();
                }
            }
        });
    }

    public function askTradeRef()
    {
        $this->ask('Alright lets go - Enter signal reference ID', function (Answer $answer) {
            // Save result
            $value = $this->ref = $answer->getText();

            if ($value == '') {
                return $this->repeat('Please enter signal reference ID');
            } else {
                $response = $this->fetctApi("/signal", [
                    'ref' => $value,
                ]);
                $info = json_decode($response);

                if ($info->error) {
                    $this->say($info->message);
                }

                $signal = $info->data->signal;

                if ($signal) {
                    $this->say($signal);
                    $this->askResult();
                } else {
                    $this->say('No Signal found with this reference ID, try again with another value.');
                    $this->askWhatToDo();
                }
            }
        });
    }


    public function askTradeDir()
    {
        $this->ask('Alright lets go- Enter Trade direction: Buy/Sell', function (Answer $answer) {
            // Save result
            $value = $this->tradeDirection = $answer->getText();
            if ($value == '') {
                return $this->repeat('Please enter trade direction');
            } else {
                $this->askPair();
            }
        });
    }


    public function askPair()
    {
        $this->ask('Greate- Now enter currency pair: eg EUR/USD', function (Answer $answer) {
            // Save result
            $value = $this->pair = $answer->getText();
            if ($value == '') {
                return $this->repeat('Please enter currency pair');
            } else {
                $this->askPrice();
            }
        });
    }
    public function askPrice()
    {
        $this->ask('You\'re getting close- Enter the Price', function (Answer $answer) {
            // Save result
            $value = $this->price = $answer->getText();
            if ($value == '') {
                return $this->repeat('Please enter signal price');
            } else {
                $this->askTp1();
            }
        });
    }

    public function askTp1()
    {
        $this->ask('Enter the first Take Profit', function (Answer $answer) {
            // Save result
            $value = $this->tp1 = $answer->getText();
            if ($value == '') {
                return $this->repeat('Please enter the first take profit');
            } else {
                $this->askTp2();
            }
        });
    }

    public function askTp2()
    {
        $this->ask('Enter the second Take Profit', function (Answer $answer) {
            // Save result
            $value = $this->tp2 = $answer->getText();
            if ($value == '') {
                return ('Please enter trade direction');
            } else {
                $this->askStopLoss();
            }
        });
    }

    public function askStopLoss()
    {
        $this->ask('One more thing - what is your stop loss?', function (Answer $answer) {
            // Save result
            $value = $this->sl = $answer->getText();
            if ($value == '') {
                return $this->repeat('Please enter trade direction');
            } else {
                $this->say('Great - that is all we need.');
                $this->addSignal();
            }
        });
    }

    public function addSignal()
    {
        $this->ask('Should i save and publish to channel?: Yes or No', function (Answer $answer) {
            // Save result
            $reply = $answer->getText();
            $this->shouldPub = strtolower($reply);

            if ($this->shouldPub == 'yes') {
                $response = $this->fetctApi('/post-signals', [
                    'direction' => $this->tradeDirection,
                    'pair' => $this->pair,
                    'price' => $this->price,
                    'tp1' => $this->tp1,
                    'tp2' => $this->tp2,
                    'sl1' => $this->sl,
                ], 'POST');

                $value = json_decode($response);

                if ($response->successful()) {
                    $this->publishSignals($value->data->signal->id);
                    $question = Question::create('Signal posted successfully, click pause if you which to end this conversation')
                        ->fallback('Sorry, i do not understand that, please try again.')
                        ->callbackId('discard')
                        ->addButtons([
                            Button::create('pause')->value('pause'),
                            Button::create('Post another signal')->value('another'),
                        ]);
                }

                if ($response->failed() or $value->error) {
                    return $this->repeat('Should i try again to save and publish to channel?: Yes or No');
                }
            } else {
                $question = Question::create('Click pause to end conversation')
                    ->fallback('Sorry, i do not understand that, please try again.')
                    ->callbackId('discard')
                    ->addButtons([
                        Button::create('pause')->value('pause'),
                    ]);
            }

            $this->ask($question, function (Answer $answer) {
                // Detect if button was clicked:
                if ($answer->isInteractiveMessageReply()) {
                    $selectedValue = $answer->getValue(); // will be either 'post_signal' or 'update_result'
                    $selectedText = $answer->getText(); // will be either 'Post Signal' or 'Update Result'
                    if ($selectedValue == 'another' or $selectedText == 'Post another signal') {
                        $this->askTradeDir();
                    }
                }
            });
        });
    }

    public function skipsConversation(IncomingMessage $message)
    {
        if ($message->getText() == 'pause') {
            return true;
        }
        return false;
    }

    public function publishSignals($signl)
    {
        $response = $this->fetctApi("/publish-signals/$signl");
        $info = json_decode($response);

        if ($info->error or $response->failed()) {
            $this->say('Something went wrong, please try again');
        }
        //send to telegram
        Notification::send($info->data->chat_id, new PostForexSignal($info->data->message));
    }


    public function run()
    {
        $this->askWhatToDo();
    }
}