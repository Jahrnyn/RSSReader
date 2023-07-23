<div>
    @if (isset($subscriptions) && !$subscriptions->isEmpty())
        <ul>
            @foreach ($subscriptions as $subscription)
                <li>
                    <a href="{{ route('show_rss_feed', ['url' => $subscription->url]) }}">{{ $subscription->title }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No data available</p>
    @endif
</div>