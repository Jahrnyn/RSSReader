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
            <p>Ide kerül majd egy kép arról, hogyan néz ki az oldal bejelentkezve feedekkel.</p>
        </div>
    </div>
</x-layout>
