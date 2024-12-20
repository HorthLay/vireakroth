<div class="nav">
    <button id="menu-btn">
        <span class="material-icons-sharp">menu</span>
    </button>
    <div class="dark-mode">
        <span class="material-icons-sharp active">light_mode</span>
        <span class="material-icons-sharp">dark_mode</span>
    </div>

    <div class="profile">
        <div class="info">
            <p>Hey, <b>{{ Auth::user()->name }}</b></p>
            <small class="text-muted">{{ Auth::user()->user_type }}</small>
        </div>
        <div class="profile-photo">
            <img src="{{ asset('pic/admin.png') }}">
        </div>
    </div>
</div>