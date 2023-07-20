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
    public function fetchRssDataFromUrl($url){
        
        $feed = new SimplePie();
        $feed->set_feed_url($url);
        $feed->init();
        
        // Checking
        if (!$feed->error()) {
            // Extracting
            $title = $feed->get_title();
            $items = $feed->get_items();

            // Array to store extracted data:
            $parseData = [
                'title' => $title,
                'items' => [],
            ];
        }

        // Extract required data 
        foreach ($items as $item) {
            $parseData['items'][] = [
                'title' => $item->get_title(),
                'link'  => $item->get_link(), 
                // Relevant fields can be added here later
            ];   
        }
        
        return $parseData;
    }

}
