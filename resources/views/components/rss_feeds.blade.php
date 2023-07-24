{{-- rss_feeds.blade.php --}}
@if ($rssData)
    <h3>Selected Subscription Title: {{ $rssData['title'][0] }}</h3>

    @php
        $counter = 0;
    @endphp
    
    @foreach ($rssData['items'] as $item)
        @php
            $itemTitle = is_array($item['itemTitle']) ? $item['itemTitle'][0] : $item['itemTitle'];
            $itemDescription = is_array($item['itemDescription']) ? $item['itemDescription'][0] : $item['itemDescription'];
            $itemPubDate = is_array($item['itemPubDate']) ? $item['itemPubDate'][0] : $item['itemPubDate'];
        @endphp

        <h3>{{ $itemTitle }}</h3>

        {{-- Handle 'itemDescription' --}}
        @if (is_array($itemDescription))
            <pre>{{ print_r($itemDescription, true) }}</pre>
        @else
            <p>{!! htmlspecialchars_decode($itemDescription) !!}</p>
        @endif

        <p>{{ $itemPubDate }}</p>

        {{-- displaying only 8 feeds in the view --}}
        @php
            $counter++;
            if ($counter === 8) {
                break;
            }
        @endphp
    @endforeach

@else
    <h3>No data available. Please choose a subscription.</h3>
@endif

