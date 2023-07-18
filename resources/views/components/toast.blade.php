@if (session()->has('success'))
<div class="toast-container">
    <div class="toast">
        <span class="toast-icon">&#x2714;</span>
        <span class="toast-message">{{session('success')}}</span>
        <button class="toast-close">&times;</button>
    </div>
</div>
@endif
@if (session()->has('failure'))
<div class="toast-container">
    <div class="toast">
        <span class="toast-icon">&#x2639;</span>
        <span class="toast-message">{{session('failure')}}</span>
        <button class="toast-close">&times;</button>
    </div>
</div>
@endif