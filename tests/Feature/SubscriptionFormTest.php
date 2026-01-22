<?php

use App\Livewire\SubscriptionForm;
use App\Models\Subscriber;
use Livewire\Livewire;

it('can subscribe with valid email', function () {
    Livewire::test(SubscriptionForm::class)
        ->set('email', 'test@example.com')
        ->call('subscribe')
        ->assertSet('isSubscribed', true);

    expect(Subscriber::where('email', 'test@example.com')->exists())->toBeTrue();
});

it('cannot subscribe with invalid email', function () {
    Livewire::test(SubscriptionForm::class)
        ->set('email', 'invalid-email')
        ->call('subscribe')
        ->assertHasErrors(['email']);

    expect(Subscriber::where('email', 'invalid-email')->exists())->toBeFalse();
});

it('cannot subscribe if honeypot is filled', function () {
    Livewire::test(SubscriptionForm::class)
        ->set('email', 'bot@example.com')
        ->set('full_name', 'I am a bot')
        ->call('subscribe')
        ->assertSet('isSubscribed', false);

    expect(Subscriber::where('email', 'bot@example.com')->exists())->toBeFalse();
});
