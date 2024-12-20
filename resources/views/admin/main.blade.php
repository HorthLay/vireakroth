<main>
    <h1>Analytics</h1>
    <!-- Analyses -->
    <div class="analyse">
        <div class="sales">
            <div class="status">
                <div class="info">
                    <h3>Total Sales</h3>
                    <h1>$65,024</h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p>+81%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="visits">
            <div class="status">
                <div class="info">
                    <h3>Site Visit</h3>
                    <h1>{{ number_format($currentVisits) }}</h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p>{{ $percentageChange < 0 ? '-' : '+' }}{{ abs($percentageChange) }}%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="searches">
            <div class="status">
                <div class="info">
                    <h3>Searches</h3>
                    <h1>14,147</h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p>+21%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Analyses -->

<!-- New Users Section -->
<div class="new-users">
    <h2>New Users</h2>
    <div class="user-list">
        @foreach ($users as $user)
            <div class="user">
                <img src="{{ $user->google_id ? $user->profile_photo : asset('pic/default.png') }}" 
                     alt="{{ $user->name }}">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->created_at->diffForHumans() }}</p>
            </div>
        @endforeach
        <div class="user">
            <a href="{{url('/user')}}">
            <img src="{{ asset('admin/images/plus.png') }}" alt="More Users">
            </a>
            <h2>More</h2>
            <p>New User</p>
        </div>
    </div>
</div>
<!-- End of New Users Section -->


    <!-- Recent Orders Table -->
    <div class="recent-orders">
        <h2>Recent Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Course Number</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <a href="#">Show All</a>
    </div>
    <!-- End of Recent Orders -->

</main>