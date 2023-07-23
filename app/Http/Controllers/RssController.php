<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\RssSubscription;
use Illuminate\Support\Facades\Log;



class RssController extends Controller
{
    // create subscription
    public function createSubscription(Request $request) {
        $request->validate([
            'url' => 'required',
        ]);

        $subscription = new RssSubscription();
        $subscription->user_id = auth()->id();
        $subscription->url = $request->url;
        $subscription->save();

        return redirect('/')->with('success', 'RSS Subscription added');
    }

    // Fetch XML data from URLs - with guzzle:
    public function fetchRssDataFromUrl($url) {
        $client = new Client([
            'verify' => 'c:\Program Files\php\cacert.pem']);
    
        try {
            $response = $client->get($url);
            $xmlString = $response->getBody()->getContents();
            $xmlData = simplexml_load_string($xmlString, null, LIBXML_NOCDATA);
        
            return $xmlData;
        } catch (\Exception $e) {
            Log::error("cURL error: " . $e->getMessage());
            Log::error("URL: " . $url);   
            return null;
        }
    }

    //  Parse XML data and extract info
    public function showSubscriptions(){
        $subscriptions = auth()->user()->subscriptions;
    
        foreach ($subscriptions as $subscription) { 
            // Fetch XML data from the urls
            $subscriptionData = $this->fetchRssDataAndExtractInfo($subscription->url);
    
            if ($subscriptionData) {
                // Extract relevant information from the XML data and store it in the object
                $subscription->title = $subscriptionData['title'];
            } else {
                // Handle the case when XML data cannot be fetched
                $subscription->title = 'Error fetching XML data for: ' . $subscription->url;
            }
        }
    
        return $subscriptions; // Return the collection with the objects properly populated
    }

    // Fetch XML data from the URL and extract relevant information
    private function fetchRssDataAndExtractInfo($url){
        $xmlData = $this->fetchRssDataFromUrl($url);

        if ($xmlData) {
            // Extract relevant information from the XML data and return it
            $title = $xmlData->channel ? $xmlData->channel->title : 'No title available';
            // Add more data extraction here as needed
            return [
                'title' => $title,
                // placeholder
            ];
        } else {
            // Handle the case when XML data cannot be fetched
            Log::error("Error fetching XML data for: " . $url);
            return null;
        }
    }


    public function showRssFeed($id)
    {
        $selectedSubscription = RssSubscription::findOrFail($id);

        // Fetch and extract data for the selected subscription
        $subscriptionData = $this->fetchRssDataAndExtractInfo($selectedSubscription->url);

        if ($subscriptionData) {
            // Pass the subscription data to the view
            return view('components.rss_feeds', ['subscriptionData' => $subscriptionData]);
        } else {
            // Handle the case when data cannot be fetched
            return redirect('/')->with('error', 'Error fetching RSS data');
        }
    }

}


