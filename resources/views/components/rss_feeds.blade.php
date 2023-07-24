@if ($rssData)
    <h3>Selected Subscription Title: {{ $rssData['title'] }}</h3>

    @foreach ($rssData['items'] as $item)
        <div class="item">
            <h4>{{ $item['itemTitle'][0] }}</h4>
            <p>{{ $item['itemDescription'][0] }}</p>
            <p>{{ $item['itemPubDate'][0] }}</p>
        </div>
    @endforeach
@else
    <h3>No data available. Please Chose a subscription</h3>
@endif