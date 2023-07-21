<x-layout>
    @section('styles')
        <link rel="stylesheet" href="css/homepage.css">
    @endsection

    <div class="grid-container">
        <div class="content-container" class="url-container">
            {{-- URL adding box--}}
            <div id="addrss-container">
                <h2>Add RSS feed</h2>
                <form action="/rsssubscription" method="POST" id="url_submit_form">
                    @csrf
                    <div class="form-group">
                        <label for="url">Paste your url below and click to Submit!</label>
                        <input type="text" id="url" name="url" placeholder="Place the url here" required>
                            @error('url')
                                <p>{{ $message }}</p>
                            @enderror
                    </div>
                    <button class="button-link" type="submit">Subscribe</button>
                </form>
            </div>
            {{-- Subscriptions  --}}
            <div class="subscription-container">
                <h2>Your Subscriptions:</h2>
                @if (auth()->check())
                    @if (auth()->user()->subscriptions->isEmpty())
                        <p>No RSS subscriptions yet.</p>
                    @else
                    <ul>
                        @foreach (auth()->user()->subscriptions as $subscription)
                        <li> {{ $subscription->url }}  </li>
                        @endforeach
                    </ul>
                    @endif
                @else
                    <p>Please log in to see your subscriptions.</p>
                @endif
            </div>
        </div> 

        {{-- Actual RSS --}}
        <div class="content-container" id="rss">
            <p>Here will be the feed.</p>
        </div>
    </div>
</x-layout>