<div class="header-container">
    <header class="header">
        <div class="logo">
            <a href="/" >
                <img src="rss-logo-icon-transp.png" alt="Home">
                <h1>RSS Reader</h1>
            </a> 
        </div>
    @auth
            {{-- Logged in Header --}}
            <div class="user-profile">
                <div id="username">
                    <h3>Welcome {{auth()->user()->name}}</h3>
                </div>
                <div class="button-container">
                    <form action="/logout" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">Sign Out</button>
                    </form>
                </div>
            </div>
        </header>
        </div>   

    @else
        {{-- Logged out Header --}}
        <div class="login-form">
            <form action="/login" method="POST">
            @csrf
                <input type="text" name="loginusername" placeholder="Username">
                <input type="password" name="loginpassword" placeholder="Password">
                <button class="button-link" type="submit">Login</button>
            </form>
            <div class="register-link">
                <form action="/register">
                <button class="button-link" type="submit">Register</button>
                </form>
            </div>
        </div>
    </header>
    </div>
    @endauth