<x-layout>
    @section('styles')
        <link rel="stylesheet" href="css/homepage.css">
    @endsection

    <div class="grid-container">
        {{-- URL adding box--}}
        <div class="content-container" id="url-container">
            <p>here will be the url adding form.</p>
        </div>
        {{-- Actual RSS --}}
        <div class="content-container" id="rss">
            <p>Here will be the feed.</p>
        </div>
    </div>
</x-layout>