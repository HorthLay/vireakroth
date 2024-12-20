<div class="reminders">
    <div class="header">
        <h2>Reminders</h2>
        <span class="material-icons-sharp">notifications_none</span>
    </div>
    @foreach($reminders as $reminder)
    <div class="notification">
        <div class="icon">
            <span class="material-icons-sharp">volume_up</span>
        </div>
        <div class="content">
            <div class="info">
                <h3>{{ $reminder->title }}</h3>
                <small class="text_muted">
                    {{ \Carbon\Carbon::parse($reminder->start_time)->format('h:i A') }} - 
                    {{ \Carbon\Carbon::parse($reminder->end_time)->format('h:i A') }}
                </small>
            </div>
            <span class="material-icons-sharp">more_vert</span>
        </div>
    </div>
    @endforeach
</div>