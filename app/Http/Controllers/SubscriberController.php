<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function verify(Request $request, Subscriber $subscriber)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        $subscriber->update([
            'confirmed' => true,
            'active' => true,
        ]);

        return view('subscriber.verified');
    }

    public function unsubscribe(Request $request, Subscriber $subscriber)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        $subscriber->update([
            'active' => false,
        ]);

        return view('subscriber.unsubscribed');
    }
}
