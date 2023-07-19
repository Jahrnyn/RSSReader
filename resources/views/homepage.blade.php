<x-layout>
    @section('styles')
        <link rel="stylesheet" href="css/homepage.css">
    @endsection

    <div class="grid-container">
        {{-- URL adding box--}}
        <div class="content-container" class="url-container">
            <div id="addrss-container">
                <h2>Add RSS feed</h2>
                <form action="/rsssubscription" method="POST" id="url_submit_form">
                    @csrf
                    <div class="form-group">
                        <label for="url">Paste your url below and click to Submit!</label>
                        <input type="text" id="url" name="url" placeholder="Place the url here" required>
                    </div>
                    <button class="button-link" type="submit">Submit</button>
                </form>
            </div>
            <div class="user-feeds-container">
                <h2>Your feeds:</h2>
                <p>Here wil be the user subcriptions</p>
            </div>
        </div>


        {{-- Actual RSS --}}
        <div class="content-container" id="rss">
            <p>Here will be the feed.</p>
        </div>
    </div>
</x-layout>