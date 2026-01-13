<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class SubscriptionForm extends Component
{
    public $email = '';
    public $isSubscribed = false;

    protected $rules = [
        'email' => 'required|email|unique:subscribers,email',
    ];

    protected $messages = [
        'email.unique' => 'The email has already been subscribed.',
    ];

    public function subscribe()
    {
        $this->validate();

        $subscriber = Subscriber::create([
            'email' => $this->email,
            'active' => false,
            'confirmed' => false,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'subscriber.verify',
            now()->addHours(24),
            ['subscriber' => $subscriber->id]
        );

        // Send verification email
        Mail::send('emails.subscription-verification', ['url' => $verificationUrl], function ($message) use ($subscriber) {
            $message->to($subscriber->email);
            $message->subject('Confirm your subscription');
        });

        $this->isSubscribed = true;
        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.subscription-form');
    }
}
