<form action="/rsssubscription" method="POST" id="url_submit_form">
    @csrf
    <div class="form-group">
        <label for="url">Paste your url below and click to Submit!</label>
        <input type="text" id="url" name="url" placeholder="Place the url here" required>
            @error('url')
                <p>{{ $message }}</p>
            @enderror
    </div>
    <button class="button-link" type="submit">Subscribe</button>
</form>
