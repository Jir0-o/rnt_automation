<style>
    .small-text {
        font-size: 12px; /* Adjust size as needed */
    }
</style>


<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item search-box d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="app-search form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..." aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- //add a notification bell icon -->
            <li class="nav-item navbar-dropdown dropdown-notifications dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" id="bell_click"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-bell bx-tada"></i>
                    <span class="badge bg-danger rounded-pill notificationCount"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <span>Notifications</span>
                            <a href="javascript:void(0)">Mark all as read</a>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <div id="load_notify_data" style="max-height: 500px; overflow-y: auto;">
                        <!-- Load notification data here -->
                    </div>
                    <!-- <li>
                        <a class="dropdown-item text-center" href="javascript:void(0)">
                            <small class="fw-medium">View all notifications</small>
                        </a>
                    </li> -->
                </ul>
            </li>
            <!-- //end of notification bell icon -->

            <!-- Place this tag where you want the button to render. -->
            <li class="lh-1 me-3">
                <!-- User Name Section -->
                <div class="d-flex align-items-center mb-1">
                    <i class="bx bx-user me-2"></i>
                    <b id="user-name"></b>
                </div>

                <!-- Department Section -->
                <div class="d-flex align-items-center mb-1">
                    <i class="bx bx-building me-2"></i>
                    <b class="text-muted small-text" id="user-department"></b>
                </div>

                <!-- Designation Section -->
                <div class="d-flex align-items-center">
                    <i class="bx bx-briefcase me-2"></i>
                    <b class="text-muted small-text" id="user-designation"></b>
                </div>
            </li>


            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online overflow-hidden">
                        <img src="" alt="User Avatar" class="w-35px rounded-circle" id="user-image">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{route('profile')}}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online overflow-hidden">
                                        <img src="" alt="User Avatar" class="w-35px rounded-circle"
                                            id="dropdown-user-image">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block" id="user-name">
                                    </span>
                                    <small class="text-muted" id="user-role"></small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('profile')}}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    @can('Can Access Setting')
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                            <p class="align-middle"><i class="bx bx-power-off me-2"></i> Log Out</p>

                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.js"
    integrity="sha512-ZHzbWDQKpcZxIT9l5KhcnwQTidZFzwK/c7gpUUsFvGjEsxPusdUCyFxjjpc7e/Wj7vLhfMujNx7COwOmzbn+2w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<script>
$(document).ready(function() {
   // Fetch notification counts on page load
   fetchNotificationCounts();

// Fetch notification counts periodically
setInterval(fetchNotificationCounts, 30000); // Fetch every 30 seconds

// Event delegation for handling clicks on dynamically loaded notifications
$('#load_notify_data').on('click', '.notification_click', function(event) {
    event.preventDefault(); // Prevent the default behavior (e.g., link navigation)

    const notificationId = $(this).data('id'); // Get the notification ID
    const link = $(this).attr('href'); // Get the notification link

    console.log('Notification clicked, ID:', notificationId); // Log for debugging

    // Perform an action, e.g. mark the notification as read
    $.ajax({
        url: "{{ route('notification.show', ':id') }}".replace(':id', notificationId),
        method: 'GET',
        success: function(response) {
            fetchNotificationCounts(); // Refresh notifications after marking as read

            // Redirect to the notification link
            window.location.href = link;
        },
        error: function(error) {
            console.error('Error fetching notification:', error);
        }
    });
});

function fetchNotificationCounts() {
    $.ajax({
        url: "{{ route('notification.index') }}",
        method: 'GET',
        success: function(response) {
            const notificationData = response.data || []; // Ensure notificationData is always an array
            const notificationCount = notificationData.length;
            const notificationActiveData = response.active || []; // Ensure notificationActiveData is always an array
            const notificationActiveCount = notificationActiveData.length;

            if (notificationActiveCount > 0) {
                $('.notificationCount').show();
                $('.notificationCount').text(notificationActiveCount);
            } else {
                $('.notificationCount').hide();
            }

            $('#load_notify_data').html(''); // Clear the notification area

            if (notificationCount == 0) {
                $('#load_notify_data').append(`
                <li>
                    <a class="dropdown-item" href="javascript:void(0)">
                        <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0">No new notifications</p>
                            </div>
                        </div>
                    </a>
                </li>
            `);
            } else {
                // Show only the first 5 notifications
                const visibleNotifications = notificationData;
                visibleNotifications.forEach(function(notification) {
                    const profilePhoto = notification.from_user_notification
                        .profile_photo_path;
                    const link = notification.link ? notification.link :
                        'javascript:void(0)'; // Use provided link or default to no action
                    
                    // chnage the background color of the notification if it is read when status is 0
                    if (notification.is_active == 0) {
                        $('#load_notify_data').append(`
                        <li>
                            <a class="dropdown-item notification_click" href="${link}" data-id="${notification.id}" style="background-color: #85cadb;">
                                <div class="d-flex gap-3">
                                    <div class="avatar avatar-online overflow-hidden">
                                        <img class="img-fluid rounded-circle" src="/global_assets/user_images/${profilePhoto}" alt="User Avatar" class="w-35px rounded-circle">
                                    </div>
                                    <div class="">
                                        <p class="mb-0 text-wrap">${notification.title}</p>
                                        <p class="text-dark small text-wrap">${notification.text}</p>
                                        <p class="text-muted small mt-1">${formatDate(notification.created_at)}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider m-0"></div>
                        </li>
                    `);
                    } else {
                        $('#load_notify_data').append(`
                        <li>
                            <a class="dropdown-item notification_click" href="${link}" data-id="${notification.id}">
                                <div class="d-flex gap-3">
                                    <div class="avatar avatar-online overflow-hidden">
                                        <img class="img-fluid rounded-circle" src="/global_assets/user_images/${profilePhoto}" alt="User Avatar" class="w-35px rounded-circle">
                                    </div>
                                    <div class="">
                                        <p class="mb-0">${notification.title}</p>
                                        <p class="text-muted small text-wrap">${notification.text}</p>
                                        <p class="text-muted small mt-1">${formatDate(notification.created_at)}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                    `);
                    }
                });

                // If notification count exceeds 5, make the container scrollable
                if (notificationCount > 5) {
                    $('#load_notify_data').css({
                        'max-height': '300px', // Set max height for the scroll area
                        'overflow-y': 'auto' // Enable vertical scrolling
                    });
                } else {
                    $('#load_notify_data').css({
                        'max-height': '', // Remove max-height if less than 5
                        'overflow-y': '' // Remove scrolling
                    });
                }
            }
        },
        error: function(error) {
            console.error('Error fetching notification counts:', error);
        }
    });
}

    function formatDate(createdAt) {
        // Parse the created_at timestamp
        const date = new Date(createdAt);

        // Format options for date
        const options = { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric', 
            hour: 'numeric', 
            minute: 'numeric', 
            hour12: true 
        };

        // Format the date to "11 November 2024, 10:30 AM"
        return date.toLocaleDateString('en-US', options);
    }

    function getUser() {
        $.ajax({
            url: "{{ route('profile.show') }}",
            type: "GET",
            success: function(response) {
                console.log(response);
                $('#user-name').text(response.data.name);
                $('#user-department').text(response.data.department.name);
                $('#user-designation').text(response.data.designation.designation);
                // Check if the user has a profile photo
                if (response.data.profile_photo_path) {
                    // If profile photo exists, set the image source
                    $('#user-image').attr('src', '/public/global_assets/user_images/' + response.data
                        .profile_photo_path);
                    $('#dropdown-user-image').attr('src', '/public/global_assets/user_images/' + response
                        .data.profile_photo_path);
                } else {
                    // If no profile photo exists, set a default image source
                    $('#user-image').attr('src', '/public/global_assets/user_images/default.png');
                    $('#dropdown-user-image').attr('src', '/public/global_assets/user_images/default.png');
                }
                // Check if the user has a role
                if (response.data.userhas_role) {
                    // If user has a role, set the role name
                    $('#user-role').text(response.data.userhas_role[0].role.name);
                } else {
                    // If user has no role, set a default role name
                    $('#user-role').text('No Role');
                }
            }
        });
    }
    getUser();
});
</script>