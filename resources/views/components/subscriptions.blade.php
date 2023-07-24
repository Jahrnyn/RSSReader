@if (auth()->check())
    @if (auth()->user()->subscriptions->isEmpty())
        <p>No RSS subscriptions yet.</p>
    @else
        <ul>
            @foreach ($subscriptions as $subscription)
                <li>
                    <h3>
                        <a href="/user_subscription/{{ $subscription->id }}" class="subscription-link">{{ $subscription->title ?? 'No title available' }}</a>
                        <a href="/delete_subscription/{{ $subscription->id }}" class="delete-link" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $subscription->id }}').submit();">X</a>
                    </h3>
                    <form id="delete-form-{{ $subscription->id }}" action="/delete_subscription/{{ $subscription->id }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@else
    <p>Please log in to see your subscriptions.</p>
@endif
