<x-layout>
    
    @section('styles')
        <link rel="stylesheet" href="css/registrationpage.css">
    @endsection
    
    <div class="grid-container">
        <div class="content-container" id="registration-container">
            <div id="registration-form-container">
                <h2>Registration</h2>
                    <form action="register" method="POST" id="registration-form">
        
                    @csrf 
        
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input value="{{old('username')}}" id="username" name="username" required>
                        @error('username')
                        <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input value="{{old('email')}}" type="email" id="email" name="email" required>
                        @error('email')
                        <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                        <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password:</label>
                        <input type="password" id="confirm-password" name="password_confirmation" required>
                        @error('password_confirmation')
                        <p>{{$message}}</p>
                        @enderror
                    </div>
                    <button class="button-link" type="submit">Register</button>
                </form>
            </div>
        </div>
    
        <div class="content-container" id="registration-criteria-container">
            <ul>
                <li>The username can be a maximum of 20, but a minimum of 4 characters. </li>
                <li>Username and email must be unique.</li>
                <li>The password must be at least 8 characters long and we recommend that it contain upper and lower case letters, numbers and special characters!</li>
                <li>The site operator will never ask for your password under any circumstances!</li>
            </ul>        
        </div>
    </div>

    <div></div>
</x-layout>