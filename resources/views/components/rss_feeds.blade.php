{{-- rss_feeds.blade.php --}}
{{-- rss_feeds.blade.php --}}
@if ($rssData)
    <h3>Selected Subscription Title: {{ $rssData['title'][0] }}</h3>

    @foreach ($rssData['items'] as $item)
        <h3>{{ is_array($item['itemTitle']) ? $item['itemTitle'][0] : $item['itemTitle'] }}</h3>

        @if (!is_array($item['itemDescription']))
            <p>{!! $item['itemDescription'] !!}</p>
        @else
            <p>{!! $item['itemDescription'][0] !!}</p> 
        @endif

        <p>{{ is_array($item['itemPubDate']) ? $item['itemPubDate'][0] : $item['itemPubDate'] }}</p>
    @endforeach

@else
    <h3>No data available. Please choose a subscription.</h3>
@endif

