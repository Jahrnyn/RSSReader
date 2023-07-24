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
            $subscriptionData = $this->fetchRssDataAndExtractInfo($subscription->url);
    
            if ($subscriptionData) {
                $subscription->title = $subscriptionData['title']; // Extract relevant information from the XML 
            } else {
                $subscription->title = 'Error fetching XML data for: ' . $subscription->url; // Handle the case when XML data cannot be fetched
            }
        }
        return $subscriptions; 
    }

    // Fetch XML data from the url and extract relevant information
    private function fetchRssDataAndExtractInfo($url){
        $xmlData = $this->fetchRssDataFromUrl($url);

        if ($xmlData) {
            // Title
            $title = $xmlData->channel ? $xmlData->channel->title : 'No title available';

            // Extract info from the xml
            $items = $xmlData->channel->item;
            $results = [];

            foreach ($items as $item) {
                $itemTitle = $item->title;
                $itemDescription = $item->description;
                $itemPubDate = $item->pubDate;
                $itemLink = $item->link;
            
                // Store the extracted data
                $results[] = [
                    'itemTitle' => $itemTitle,
                    'itemDescription' => $itemDescription,
                    'itemPubDate' => $itemPubDate,
                    'itemLink' => $itemLink,
                ];
            }

            return [
                'title' => $title,
                'items' => $results,
            ];
        } else {
            Log::error("Error fetching XML data for: " . $url); // Handle the case when XML data cannot be fetched
            return null;
        }
    }


    public function showRssFeed($id) {
        // Geting the url from id
        $subscription = RssSubscription::find($id);
        if (!$subscription) {
            return redirect('/')->with('error', 'Subscription not found.');
        }
    
        $url = $subscription->url;

        $rssController = new RssController();
        $rssData = $rssController->fetchRssDataAndExtractInfo($url);
    
        // Convert SimpleXMLElement to an array
        $rssDataArray = json_decode(json_encode($rssData), true);

        // Save RSS data into the session
        session(['rssData' => $rssDataArray]);
        return redirect('/');
    }

    public function destroySubscription(RssSubscription $subscription) {
        if (auth()->user()->id !== $subscription->user_id) {
            abort(403); // Unauthorized
        }
        $subscription->delete();

        return redirect('/')->with('success', 'Subscription deleted successfully.');
    }

    
}


