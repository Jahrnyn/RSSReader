<x-layout>
    @section('styles')
        <link rel="stylesheet" href="css/welcomepage.css">
    @endsection

    <div class="grid-container">
        {{-- welcome text --}}
        <div class="content-container" id="welcome-container">
            @include('components/welcomeText')
        </div>
        {{-- Slideshow --}}
        <div class="content-container" id="demonstration">
            <p>Here will be a picture of how the page looks when logged in with feeds.</p>
        </div>
    </div>
</x-layout>
