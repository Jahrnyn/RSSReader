




@if (auth()->check())
    @if (auth()->user()->subscriptions->isEmpty())
        <p>No RSS subscriptions yet.</p>
    
        @else
        <ul>
            @foreach ($subscriptions as $subscription)
            @if ($subscription->xmlData && $subscription->xmlData->channel)
                    <li>
                        <h3>{{ $subscription->xmlData->channel ? $subscription->xmlData->channel->title : 'No title available' }}</h3>
                        
                    </li>
                @else
                    <li>
                        <h3>Error fetching XML data for: {{ $subscription->url }}</h3>
                    </li>
                @endif
            @endforeach
        </ul>
        @endif
    @else
        <p>Please log in to see your subscriptions.</p>
    @endif