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
            <x-rss_feeds />
        </div>
    </div>
</x-layout>