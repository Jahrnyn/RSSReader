@if (auth()->check())
    @if (auth()->user()->subscriptions->isEmpty())
        <p>No RSS subscriptions yet.</p>
    @else
        <ul class="subscription_list">
            @foreach ($subscriptions as $subscription)
            <li>
                <div class="subscription_links_container">
                    <a href="/user_subscription/{{ $subscription->id }}" class="add_subscription_button">{{ $subscription->title ?? 'No title available' }}</a>
                    <div class="del_subscription_button_container">
                        <a href="/delete_subscription/{{ $subscription->id }}" class="del_subscription_button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $subscription->id }}').submit();">&#x2716;</a>
                    </div>
                </div>
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
