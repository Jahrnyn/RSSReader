<?php

namespace App\Http\Controllers;

use SimplePie\SimplePie;
use Illuminate\Http\Request;
use App\Models\RssSubscription;
use Illuminate\Validation\Rule;



class RssController extends Controller
{
    // create subscription
    public function createSubscription(Request $request){
        $request->validate([
            'url' => ['required', Rule::unique('rss_subscriptions', 'url')]
        ]);

        $subscription = new RssSubscription();
        $subscription->user_id = auth()->id();
        $subscription->url = $request->url;
        $subscription->save();

        return redirect('/')->with('success', 'RSS Subscription added');
    }

}
