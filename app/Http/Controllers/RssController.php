<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RssSubscription;
use Illuminate\Support\Facades\Http;



class RssController extends Controller
{
    // create subscription
    public function createSubscription(Request $request){
        $request->validate([
            'url' => 'required',
        ]);

        $subscription = new RssSubscription();
        $subscription->user_id = auth()->id();
        $subscription->url = $request->url;
        $subscription->save();

        return redirect('/')->with('success', 'RSS Subscription added');
    }

    // Fetch XML data from URLs:
    public function fetchRssDataFromUrl($url){
        try {
            $response = Http::get($url);
            $xmlString = $response->body();
            $xml = simplexml_load_string($xmlString, null, LIBXML_NOCDATA);
            return $xml;
            
        } catch (\Exception $e) {
            return null;
        }
    }

    //  Parse XML data and extract info
    public function showSubscriptions() {
        $subscriptions = auth()->user()->subscriptions;
        foreach ($subscriptions as $subscription) {
            $subscription->xmlData = $this->fetchRssDataFromUrl($subscription->url);
        }

        return view('components.subscriptions', ['subscriptions' => $subscriptions]);
    }



}


