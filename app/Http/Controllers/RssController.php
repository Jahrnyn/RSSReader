<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RssController extends Controller
{
    // create subscription
    public function createSubscription(Request $request){
        $incomingField = $request->validate([
            'url' => ['required', Rule::unique('rss_subscriptions', 'url')]
        ]);


        return redirect('/')->with('success', 'RSS Subscription added');
    }
}
