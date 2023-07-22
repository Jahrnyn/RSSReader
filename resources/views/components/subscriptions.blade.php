@if (auth()->check())
    @if (auth()->user()->subscriptions->isEmpty())
        <p>No RSS subscriptions yet.</p>
    @else
        <ul>
            @foreach ($subscriptions as $subscription)
                <li>
                    @if ($subscription->title)
                    <h3><a href="/user_subscription/{{ $subscription->id }}">{{ $subscription->title }}</a></h3>
                    @else
                        <h3>No title available</h3>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@else
    <p>Please log in to see your subscriptions.</p>
@endif