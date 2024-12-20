<!DOCTYPE html>
<html lang="en">
    <head>
    <base href="public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/style.css')}}">
    <title>Responsive Dashboard Design #1 | AsmrProg</title>
    <style>
        /* The Modal (Hidden by default) */
.reminder-modal {
    display: none;
    position: fixed;
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Black with transparency */
    justify-content: center;
    align-items: center;
    padding: 10px;
}

/* Modal Content */
.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    max-width: 100%;
    position: relative;
}

/* Close button */
.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px;
    cursor: pointer;
}

/* Form inputs */
.form-group {
    margin-bottom: 15px;
}

input[type="text"], input[type="datetime-local"], button {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

    </style>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
       @include('admin.sidebar')
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
       @include('admin.main')
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>{{Auth::user()->name}}</b></p>
                        <small class="text-muted">{{Auth::user()->user_type}}</small>
                    </div>
                    <div class="profile-photo">
                        <img src="{{asset('pic/admin.png')}}">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img style="margin-left:20%;" src="admin/images/logo.png">
                    <h2>VireakRoth <br> PhoneShop</h2>
                    <p>address: Phum 2 Songkat 3 SihanoukVille Province</p>
                </div>
            </div>

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
            
                <!-- Add New Reminder Section -->
                <!-- Add Reminder Button -->
<div class="notification add-reminder" onclick="openReminderForm()">
    <div>
        <span class="material-icons-sharp">add</span>
        <h3>Add Reminder</h3>
    </div>
</div>

<!-- The Pop-up Modal (Initially hidden) -->
<div id="reminderModal" class="reminder-modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeReminderForm()">&times;</span>
        <h3>Create Reminder</h3>
        <form action="{{ route('reminders.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" required>
            </div>
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" required>
            </div>
            <div class="form-group">
                <button type="submit">Save Reminder</button>
            </div>
        </form>
    </div>
</div>

            

            </div>

        </div>


    </div>
    <script>
        // Function to toggle the reminder form visibility
        function openReminderForm() {
            const form = document.getElementById('reminderForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    
        // Get all sidebar links
        const sidebarLinks = document.querySelectorAll('.sidebar a');
    
        // Add click event listener to each sidebar link
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove 'active' class from all links
                sidebarLinks.forEach(link => link.classList.remove('active'));
    
                // Add 'active' class to the clicked link
                this.classList.add('active');
            });
        });
    
        // Toggle sidebar visibility when close button is clicked
        document.getElementById('close-btn').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });

          // Function to open the modal
    function openReminderForm() {
        const modal = document.getElementById('reminderModal');
        modal.style.display = 'flex';
    }

    // Function to close the modal
    function closeReminderForm() {
        const modal = document.getElementById('reminderModal');
        modal.style.display = 'none';
    }

    // If the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        const modal = document.getElementById('reminderModal');
        if (event.target === modal) {
            closeReminderForm();
        }
    }
    </script>
    
    <script src="{{asset('admin/orders.js')}}"></script>
    <script src="{{asset("admin/index.js")}}"></script>
</body>

</html>