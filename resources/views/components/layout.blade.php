<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RSS Feed</title>
  <link rel="stylesheet" href="/main.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/toast.css">
  @yield('styles') {{-- placeholder to another stylesheets --}}
</head>

<body>
    <div class="page-container">

        {{-- Header --}}
        <div class="head">
            @include('components/header')
        </div>

        {{-- There goes the unice content linked to the rout --}}
        <main>
            <div class="main-content">
                {{$slot}}
            </div>
        </main>

        {{-- footer --}}
        <div>
            @include('components/footer')
        </div>
                
        {{-- Toast Notification for redirect --}}
        @include('components/toast')
        
    </div> 
    <script src="/main.js"></script>
</body>
</html>