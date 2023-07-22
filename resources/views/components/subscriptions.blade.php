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