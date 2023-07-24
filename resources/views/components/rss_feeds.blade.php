{{-- rss_feeds.blade.php --}}
@if ($rssData)
    <h2>Selected Subscription: {{ $rssData['title'][0] }}</h2>

    @php
        $counter = 0;
    @endphp
    
    @foreach ($rssData['items'] as $item)
        @php
            $itemTitle = is_array($item['itemTitle']) ? $item['itemTitle'][0] : $item['itemTitle'];
            $itemDescription = is_array($item['itemDescription']) ? $item['itemDescription'][0] : $item['itemDescription'];
            $itemPubDate = is_array($item['itemPubDate']) ? $item['itemPubDate'][0] : $item['itemPubDate'];
            $itemLink = is_array($item['itemLink']) ? $item['itemLink'][0] : $item['itemLink']; 
        @endphp

        {{-- Title --}}
        <h3>{{ $itemTitle }}</h3>

        {{-- Handle 'itemDescription' --}}
        @if (is_array($itemDescription))
            <pre>{{ print_r($itemDescription, true) }}</pre>
        @else
            <p>{!! htmlspecialchars_decode($itemDescription) !!}</p>
        @endif

        {{-- Dates --}}
        <p>{{ $itemPubDate }}</p>

        
        {{-- links --}}
        @if ($itemLink)
            <p>Link: <a href="{{ $itemLink }}" target="_blank">{{ $itemLink }}</a></p>
        @endif

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

