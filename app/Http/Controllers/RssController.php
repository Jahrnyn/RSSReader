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

    // Data fetching
    public function fetchRssData(){
        $rssUrls = RssSubscription::pluck('url');
        $rssData = [];

        foreach ($rssUrls as $url) {
            $feed = new SimplePie();
            $feed->set_feed_url($url);
            $feed->enable_cache(false);
            $feed->init();
            $rssData[] = $feed->get_items();
        }

        return view('rss-data', compact('rssData'));
    }

}
