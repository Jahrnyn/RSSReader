<x-layout>
    @section('styles')
        <link rel="stylesheet" href="css/homepage.css">
    @endsection

    <div class="grid-container">
        <div class="content-container" class="url-container">
            {{-- URL adding box--}}
            <div id="addrss-container">
                <h2>Add RSS feed</h2>
                <x-subscription_submit_form />
            </div>
            {{-- Subscriptions --}}
            <div class="subscription-container">
                <h2>Your Subscriptions:</h2>
                <x-subscriptions :subscriptions="$subscriptions" />
            </div>
        </div> 

        {{-- RSS Feed Container --}}
        <div class="content-container" id="rss">
                @if (session()->has('rssData'))
                <x-rss_feeds :rssData="session('rssData')" />
            @else
                <h3>No RSS data available. Please choose a subscription.</h3>
            @endif
        </div>
    </div>
</x-layout>