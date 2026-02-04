<header class="topbar">
    <div class="with-vertical"><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Header -->
        <!-- ---------------------------------- -->
        <nav class="navbar navbar-expand-lg p-0">
            <ul class="navbar-nav">
                <li class="nav-item nav-icon-hover ms-n3">
                    <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                        <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                    </a>
                </li>
            </ul>

            <div class="d-block d-lg-none">
                <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/dark-logo.svg"
                    class="dark-logo" width="180" alt="malbaligaleria" />
                <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/light-logo.svg"
                    class="light-logo" width="180" alt="malbaligaleria" />
            </div>
            <a class="navbar-toggler p-0 border-0 nav-icon-hover" href="javascript:void(0)" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="p-2">
                    <i class="ti ti-dots fs-7"></i>
                </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between">
                    <ul class="navbar-nav flex-row mx-auto ms-lg-auto align-items-center justify-content-center">
                        <li class="nav-item nav-icon-hover dropdown">
                            <a href="javascript:void(0)"
                                class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                aria-controls="offcanvasWithBothOptions">
                                <iconify-icon icon="solar:sort-line-duotone" class="fs-7"></iconify-icon>
                            </a>
                        </li>
                        <li class="nav-item nav-icon-hover">
                            <a class="nav-link moon dark-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
                            </a>
                            <a class="nav-link sun light-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
                            </a>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- start message Dropdown -->
                        <!-- ------------------------------- -->
                        {{-- <li class="nav-item nav-icon-hover dropdown">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop2"
                                aria-expanded="false">
                                <iconify-icon icon="solar:inbox-line-line-duotone" class="fs-6"></iconify-icon>
                                <span class="badge text-bg-primary fs-1 notification">3</span>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                    <h5 class="mb-0 fs-5 fw-semibold">Inbox</h5>
                                    <span class="badge text-bg-warning rounded-4 px-3 py-1 lh-sm">3
                                        new</span>
                                </div>
                                <div class="message-body" data-simplebar>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-6.jpg"
                                                alt="user" class="rounded-circle" width="45" height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-danger border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Michell Flintoff</h6>
                                                <span class="fs-2 d-block">just now</span>
                                            </div>
                                            <span class="d-block w-100 text-truncate">You: Yesterdy was
                                                great...</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-2.jpg"
                                                alt="user" class="rounded-circle" width="45" height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-primary border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Bianca Anderson</h6>
                                                <span class="fs-2 d-block">5 mins ago</span>
                                            </div>

                                            <span class="d-block w-100 text-truncate">Nice looking dress
                                                you...</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-3.jpg"
                                                alt="user" class="rounded-circle" width="45" height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-success border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Andrew Johnson</h6>
                                                <span class="fs-2 d-block">10 mins ago</span>
                                            </div>
                                            <span class="d-block w-100 text-truncate">Sent a photo</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-4.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-warning border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Marry Strokes</h6>
                                                <span class="fs-2 d-block">days ago</span>
                                            </div>
                                            <span class="d-block w-100 text-truncate">
                                                If I don’t like something, I’ll stay away from it.
                                            </span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-5.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-success border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Josh Anderson</h6>
                                                <span class="fs-2 d-block">year ago</span>
                                            </div>
                                            <span class="d-block w-100 text-truncate">$230 deducted from
                                                account</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="py-6 px-7 mb-1">
                                    <button class="btn btn-outline-primary w-100">See All
                                        Messages</button>
                                </div>
                            </div>
                        </li> --}}
                        <!-- ------------------------------- -->
                        <!-- end message Dropdown -->
                        <!-- ------------------------------- -->

                        <!-- ------------------------------- -->
                        <!-- start notification Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item nav-icon-hover dropdown">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop2"
                                aria-expanded="false">
                                <iconify-icon icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
                                <div class="notification text-bg-danger rounded-circle fs-1" id="notification-badge"
                                    style="display: none;">0</div>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                    <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                    <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm"
                                        id="notification-count-text">0 new</span>
                                </div>
                                <div class="message-body" data-simplebar id="notification-list">
                                    <!-- Notifications will be loaded here -->
                                    <div class="py-6 px-7 text-center text-muted" id="notification-loading">
                                        Loading...
                                    </div>
                                    <div class="py-6 px-7 text-center text-muted" id="notification-empty"
                                        style="display: none;">
                                        No new notifications
                                    </div>
                                </div>
                                <div class="py-6 px-7 mb-1">
                                    <button class="btn btn-outline-primary w-100"
                                        onclick="window.location.href='{{ route('notifications.index') }}'">See All
                                        Notifications</button>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- end notification Dropdown -->
                        <!-- ------------------------------- -->

                        @push('scripts')
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    fetchNotifications();

                                    // Refresh every 60 seconds
                                    setInterval(fetchNotifications, 60000);
                                });

                                function fetchNotifications() {
                                    fetch('{{ route('notifications.latest') }}')
                                        .then(response => response.json())
                                        .then(data => {
                                            updateNotificationBadge(data.unread_count);
                                            updateNotificationList(data.notifications);
                                        })
                                        .catch(error => console.error('Error fetching notifications:', error));
                                }

                                function updateNotificationBadge(count) {
                                    const badge = document.getElementById('notification-badge');
                                    const countText = document.getElementById('notification-count-text');

                                    if (count > 0) {
                                        badge.textContent = count;
                                        badge.style.display = 'block';
                                        countText.textContent = count + ' new';
                                    } else {
                                        badge.style.display = 'none';
                                        countText.textContent = '0 new';
                                    }
                                }

                                function updateNotificationList(notifications) {
                                    const list = document.getElementById('notification-list');
                                    const loading = document.getElementById('notification-loading');
                                    const empty = document.getElementById('notification-empty');

                                    // Remove existing notifications but keep loading/empty placeholders
                                    Array.from(list.children).forEach(child => {
                                        if (!child.id || (child.id !== 'notification-loading' && child.id !== 'notification-empty')) {
                                            list.removeChild(child);
                                        }
                                    });

                                    loading.style.display = 'none';

                                    if (notifications.length === 0) {
                                        empty.style.display = 'block';
                                        return;
                                    }

                                    empty.style.display = 'none';

                                    notifications.forEach(notification => {
                                        const item = document.createElement('a');
                                        item.href = 'javascript:void(0)';
                                        item.className = 'py-6 px-7 d-flex align-items-center dropdown-item gap-3';
                                        item.onclick = function() {
                                            markAsRead(notification.id, notification.link)
                                        };

                                        let icon = 'solar:bell-bing-line-duotone';
                                        let colorClass = 'bg-primary-subtle text-primary';

                                        if (notification.type === 'promo_expiring') {
                                            icon = 'solar:calendar-date-line-duotone';
                                            colorClass = 'bg-warning-subtle text-warning';
                                        } else if (notification.type === 'event_upcoming') {
                                            icon = 'solar:calendar-line-duotone';
                                            colorClass = 'bg-success-subtle text-success';
                                        }

                                        // Format time using a simple relative time function or library if available
                                        // Here using a simple placeholder or raw date
                                        const date = new Date(notification.created_at).toLocaleString();

                                        item.innerHTML = `
                <span class="flex-shrink-0 ${colorClass} rounded-circle round d-flex align-items-center justify-content-center fs-6">
                    <iconify-icon icon="${icon}"></iconify-icon>
                </span>
                <div class="w-75 d-inline-block v-middle">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="mb-1 fw-semibold">${notification.title}</h6>
                        <span class="d-block fs-2 text-muted">${getTimeAgo(new Date(notification.created_at))}</span>
                    </div>
                    <span class="d-block text-truncate text-truncate">${notification.message}</span>
                </div>
            `;

                                        list.insertBefore(item, loading); // Insert before loading (which is hidden)
                                    });
                                }

                                function markAsRead(id, link) {
                                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                    fetch(`/notifications/${id}/read`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': token
                                        }
                                    }).then(() => {
                                        if (link) {
                                            window.location.href = link;
                                        } else {
                                            fetchNotifications(); // Refresh list
                                        }
                                    });
                                }

                                function getTimeAgo(date) {
                                    const seconds = Math.floor((new Date() - date) / 1000);

                                    let interval = seconds / 31536000;
                                    if (interval > 1) return Math.floor(interval) + " years ago";
                                    interval = seconds / 2592000;
                                    if (interval > 1) return Math.floor(interval) + " months ago";
                                    interval = seconds / 86400;
                                    if (interval > 1) return Math.floor(interval) + " days ago";
                                    interval = seconds / 3600;
                                    if (interval > 1) return Math.floor(interval) + " hours ago";
                                    interval = seconds / 60;
                                    if (interval > 1) return Math.floor(interval) + " minutes ago";
                                    return Math.floor(seconds) + " seconds ago";
                                }
                            </script>
                        @endpush

                        <!-- ------------------------------- -->
                        <!-- start profile Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
                                <div class="d-flex align-items-center gap-2 lh-base">
                                    <img src="{{ Auth::user()->avatar ?? 'https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-1.jpg' }}"
                                        class="rounded-circle" width="35" height="35" alt="malbaligaleria" />
                                </div>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop1">
                                <div class="profile-dropdown position-relative" data-simplebar>
                                    <div class="py-3 px-7 pb-0">
                                        <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                    </div>
                                    <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                        <img src="{{ Auth::user()->avatar ?? 'https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-1.jpg' }}"
                                            class="rounded-circle" width="80" height="80" alt="malbaligaleria" />
                                        <div class="ms-3">
                                            <h5 class="mb-0 fs-4">{{ Auth::user()->name }}</h5>
                                            <span
                                                class="mb-1 d-block">{{ Auth::user()->getRoleNames()->first() }}</span>
                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="message-body">
                                        {{-- <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/page-user-profile.html"
                                            class="py-8 px-7 mt-8 d-flex align-items-center">
                                            <span
                                                class="d-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded round">
                                                <iconify-icon icon="solar:wallet-2-line-duotone"
                                                    class="fs-7"></iconify-icon>
                                            </span>
                                            <div class="w-75 v-middle ps-3">
                                                <h5 class="mb-1 fs-3 fw-medium">My Profile</h5>
                                                <span class="fs-2 d-block text-body-secondary">Account
                                                    Settings</span>
                                            </div>
                                        </a>
                                        <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-email.html"
                                            class="py-8 px-7 d-flex align-items-center">
                                            <span
                                                class="d-flex align-items-center justify-content-center bg-success-subtle text-success rounded round">
                                                <iconify-icon icon="solar:inbox-line-duotone"
                                                    class="fs-7"></iconify-icon>
                                            </span>
                                            <div class="w-75 v-middle ps-3">
                                                <h5 class="mb-1 fs-3 fw-medium">My Inbox</h5>
                                                <span class="fs-2 d-block text-body-secondary">Messages &
                                                    Emails</span>
                                            </div>
                                        </a>
                                        <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-notes.html"
                                            class="py-8 px-7 d-flex align-items-center">
                                            <span
                                                class="d-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded round">
                                                <iconify-icon icon="solar:checklist-minimalistic-line-duotone"
                                                    class="fs-7"></iconify-icon>
                                            </span>
                                            <div class="w-75 v-middle ps-3">
                                                <h5 class="mb-1 fs-3 fw-medium">My Task</h5>
                                                <span class="fs-2 d-block text-body-secondary">To-do and
                                                    Daily Tasks</span>
                                            </div>
                                        </a> --}}
                                    </div>
                                    <div class="d-grid py-4 px-7 pt-8">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                                            class="btn btn-primary">Log Out</a>

                                        <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- end profile Dropdown -->
                        <!-- ------------------------------- -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- ---------------------------------- -->
        <!-- End Vertical Layout Header -->
        <!-- ---------------------------------- -->

        <!-- ------------------------------- -->
        <!-- apps Dropdown in Small screen -->
        <!-- ------------------------------- -->
        <!--  Mobilenavbar -->
        <div class="offcanvas offcanvas-start pt-0" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
            aria-labelledby="offcanvasWithBothOptionsLabel">
            <nav class="sidebar-nav scroll-sidebar">
                <div class="offcanvas-header justify-content-between">
                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/index.html"
                        class="text-nowrap logo-img">
                        <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/logo-icon.svg"
                            alt="Logo" />
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-0 h-n80" data-simplebar="" data-simplebar>
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow ms-0" href="javascript:void(0)" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:slider-vertical-line-duotone"
                                        class="fs-7"></iconify-icon>
                                </span>
                                <span class="hide-menu">Apps</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level my-3">
                                <li class="sidebar-item py-2">
                                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-chat.html"
                                        class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/svgs/icon-dd-chat.svg"
                                                alt="malbaligaleria" class="img-fluid" width="24"
                                                height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Chat Application</h6>
                                            <span class="fs-3 d-block text-muted">New messages
                                                arrived</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-invoice.html"
                                        class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/svgs/icon-dd-invoice.svg"
                                                alt="malbaligaleria" class="img-fluid" width="24"
                                                height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Invoice App</h6>
                                            <span class="fs-3 d-block text-muted">Get latest
                                                invoice</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-contact2.html"
                                        class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/svgs/icon-dd-mobile.svg"
                                                alt="malbaligaleria" class="img-fluid" width="24"
                                                height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Contact Application</h6>
                                            <span class="fs-3 d-block text-muted">2 Unsaved
                                                Contacts</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-email.html"
                                        class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/svgs/icon-dd-message-box.svg"
                                                alt="malbaligaleria" class="img-fluid" width="24"
                                                height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Email App</h6>
                                            <span class="fs-3 d-block text-muted">Get new emails</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/page-user-profile.html"
                                        class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/svgs/icon-dd-cart.svg"
                                                alt="malbaligaleria" class="img-fluid" width="24"
                                                height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">User Profile</h6>
                                            <span class="fs-3 d-block text-muted">learn more
                                                information</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-calendar.html"
                                        class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/svgs/icon-dd-date.svg"
                                                alt="malbaligaleria" class="img-fluid" width="24"
                                                height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Calendar App</h6>
                                            <span class="fs-3 d-block text-muted">Get dates</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-contact.html"
                                        class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/svgs/icon-dd-lifebuoy.svg"
                                                alt="malbaligaleria" class="img-fluid" width="24"
                                                height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Contact List Table</h6>
                                            <span class="fs-3 d-block text-muted">Add new contact</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-notes.html"
                                        class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/svgs/icon-dd-application.svg"
                                                alt="malbaligaleria" class="img-fluid" width="24"
                                                height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Notes Application</h6>
                                            <span class="fs-3 d-block text-muted">To-do and Daily
                                                tasks</span>
                                        </div>
                                    </a>
                                </li>
                                <ul class="px-8 mt-7 mb-4">
                                    <li class="sidebar-item mb-3">
                                        <h5 class="fs-5 fw-semibold">Quick Links</h5>
                                    </li>
                                    <li class="mb-3">
                                        <a class="fw-semibold bg-hover-primary"
                                            href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/page-pricing.html">Pricing
                                            Page</a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="fw-semibold bg-hover-primary"
                                            href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/authentication-login.html">Authentication
                                            Design</a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="fw-semibold bg-hover-primary"
                                            href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/authentication-register.html">Register
                                            Now</a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="fw-semibold bg-hover-primary"
                                            href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/authentication-error.html">404
                                            Error
                                            Page</a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="fw-semibold bg-hover-primary"
                                            href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-notes.html">Notes
                                            App</a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="fw-semibold bg-hover-primary"
                                            href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/page-user-profile.html">User
                                            Application</a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="fw-semibold bg-hover-primary"
                                            href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/page-account-settings.html">Account
                                            Settings</a>
                                    </li>
                                </ul>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ms-0"
                                href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-chat.html"
                                aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:chat-unread-outline" class="fs-7"></iconify-icon>
                                </span>
                                <span class="hide-menu">Chat</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ms-0"
                                href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-calendar.html"
                                aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:calendar-minimalistic-outline"
                                        class="fs-7"></iconify-icon>
                                </span>
                                <span class="hide-menu">Calendar</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ms-0"
                                href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-email.html"
                                aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:inbox-unread-outline" class="fs-7"></iconify-icon>
                                </span>
                                <span class="hide-menu">Email</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="app-header with-horizontal">
        <nav class="navbar navbar-expand-xl container-fluid p-0">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler ms-n3" id="sidebarCollapse" href="javascript:void(0)">
                        <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                    </a>
                </li>
                <li class="nav-item d-none d-xl-block">
                    <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/" class="text-nowrap nav-link">
                        <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/dark-logo.svg"
                            class="dark-logo" width="180" alt="malbaligaleria" />
                        <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/light-logo.svg"
                            class="light-logo" width="180" alt="malbaligaleria" />
                    </a>
                </li>

            </ul>
            <div class="d-block d-xl-none">
                <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/" class="text-nowrap nav-link">
                    <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/logos/dark-logo.svg"
                        width="180" alt="malbaligaleria" />
                </a>
            </div>
            <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="p-2">
                    <i class="ti ti-dots fs-7"></i>
                </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)"
                                class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                aria-controls="offcanvasWithBothOptions">
                                <iconify-icon icon="solar:sort-line-duotone" class="fs-7"></iconify-icon>
                            </a>
                        </li>
                        <li class="nav-item nav-icon-hover">
                            <a class="nav-link moon dark-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
                            </a>
                            <a class="nav-link sun light-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
                            </a>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- start message Dropdown -->
                        <!-- ------------------------------- -->
                        {{-- <li class="nav-item nav-icon-hover dropdown">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="solar:inbox-line-line-duotone" class="fs-6"></iconify-icon>
                                <span class="badge text-bg-primary fs-1 notification">3</span>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                    <h5 class="mb-0 fs-5 fw-semibold">Inbox</h5>
                                    <span class="badge text-bg-warning rounded-4 px-3 py-1 lh-sm">3
                                        new</span>
                                </div>
                                <div class="message-body" data-simplebar>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-6.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-danger border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Michell Flintoff</h6>
                                                <span class="fs-2 d-block">just now</span>
                                            </div>
                                            <span class="d-block w-100 text-truncate">You: Yesterdy was
                                                great...</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-2.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-primary border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Bianca Anderson</h6>
                                                <span class="fs-2 d-block">5 mins ago</span>
                                            </div>

                                            <span class="d-block w-100 text-truncate">Nice looking dress
                                                you...</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-3.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-success border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Andrew Johnson</h6>
                                                <span class="fs-2 d-block">10 mins ago</span>
                                            </div>
                                            <span class="d-block w-100 text-truncate">Sent a photo</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-4.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-warning border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Marry Strokes</h6>
                                                <span class="fs-2 d-block">days ago</span>
                                            </div>
                                            <span class="d-block w-100 text-truncate">
                                                If I don’t like something, I’ll stay away from it.
                                            </span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item">
                                        <span class="me-3 position-relative">
                                            <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-5.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" />
                                            <span
                                                class="position-absolute top-25 start-75 translate-middle-x p-1 bg-success border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </span>
                                        <div class="w-75 v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1">Josh Anderson</h6>
                                                <span class="fs-2 d-block">year ago</span>
                                            </div>
                                            <span class="d-block w-100 text-truncate">$230 deducted from
                                                account</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="py-6 px-7 mb-1">
                                    <button class="btn btn-outline-primary w-100">See All
                                        Messages</button>
                                </div>
                            </div>
                        </li> --}}
                        <!-- ------------------------------- -->
                        <!-- end message Dropdown -->
                        <!-- ------------------------------- -->

                        <!-- ------------------------------- -->
                        <!-- start notification Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item nav-icon-hover dropdown">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
                                <div class="notification text-bg-danger rounded-circle fs-1">5</div>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                    <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                    <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">5
                                        new</span>
                                </div>
                                <div class="message-body" data-simplebar>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                        <span
                                            class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
                                            <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1 fw-semibold">Launch Admin</h6>
                                                <span class="d-block fs-2">9:30 AM</span>
                                            </div>
                                            <span class="d-block text-truncate text-truncate">Just see the
                                                my new admin!</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                        <span
                                            class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
                                            <iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1 fw-semibold">Event today</h6>
                                                <span class="d-block fs-2">9:15 AM</span>
                                            </div>
                                            <span class="d-block text-truncate text-truncate">Just a
                                                reminder that you have event</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                        <span
                                            class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
                                            <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1 fw-semibold">Settings</h6>
                                                <span class="d-block fs-2">4:36 PM</span>
                                            </div>
                                            <span class="d-block text-truncate text-truncate">You can
                                                customize this template as you want</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                        <span
                                            class="flex-shrink-0 bg-warning-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-warning">
                                            <iconify-icon icon="solar:widget-4-line-duotone"></iconify-icon>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1 fw-semibold">Launch Admin</h6>
                                                <span class="d-block fs-2">9:30 AM</span>
                                            </div>
                                            <span class="d-block text-truncate text-truncate">Just see the
                                                my new admin!</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                        <span
                                            class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
                                            <iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1 fw-semibold">Event today</h6>
                                                <span class="d-block fs-2">9:15 AM</span>
                                            </div>
                                            <span class="d-block text-truncate text-truncate">Just a
                                                reminder that you have event</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                        <span
                                            class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
                                            <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-1 fw-semibold">Settings</h6>
                                                <span class="d-block fs-2">4:36 PM</span>
                                            </div>
                                            <span class="d-block text-truncate text-truncate">You can
                                                customize this template as you want</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="py-6 px-7 mb-1">
                                    <button class="btn btn-outline-primary w-100">See All
                                        Notifications</button>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- end notification Dropdown -->
                        <!-- ------------------------------- -->

                        <!-- ------------------------------- -->
                        <!-- start profile Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="d-flex align-items-center gap-2 lh-base">
                                    <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-1.jpg"
                                        class="rounded-circle" width="35" height="35" alt="malbaligaleria" />
                                </div>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop1">
                                <div class="profile-dropdown position-relative" data-simplebar>
                                    <div class="py-3 px-7 pb-0">
                                        <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                    </div>
                                    <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                        <img src="https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-1.jpg"
                                            class="rounded-circle" width="80" height="80"
                                            alt="malbaligaleria" />
                                        <div class="ms-3">
                                            <h5 class="mb-0 fs-4">Jonathan Deo</h5>
                                            <span class="mb-1 d-block">Admin</span>
                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                <i class="ti ti-mail fs-4"></i> info@MaterialM.com
                                            </p>
                                        </div>
                                    </div>
                                    <div class="message-body">
                                        <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/page-user-profile.html"
                                            class="py-8 px-7 mt-8 d-flex align-items-center">
                                            <span
                                                class="d-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded round">
                                                <iconify-icon icon="solar:wallet-2-line-duotone"
                                                    class="fs-7"></iconify-icon>
                                            </span>
                                            <div class="w-75 v-middle ps-3">
                                                <h5 class="mb-1 fs-3 fw-medium">My Profile</h5>
                                                <span class="fs-2 d-block text-body-secondary">Account
                                                    Settings</span>
                                            </div>
                                        </a>
                                        <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-email.html"
                                            class="py-8 px-7 d-flex align-items-center">
                                            <span
                                                class="d-flex align-items-center justify-content-center bg-success-subtle text-success rounded round">
                                                <iconify-icon icon="solar:inbox-line-duotone"
                                                    class="fs-7"></iconify-icon>
                                            </span>
                                            <div class="w-75 v-middle ps-3">
                                                <h5 class="mb-1 fs-3 fw-medium">My Inbox</h5>
                                                <span class="fs-2 d-block text-body-secondary">Messages &
                                                    Emails</span>
                                            </div>
                                        </a>
                                        <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/app-notes.html"
                                            class="py-8 px-7 d-flex align-items-center">
                                            <span
                                                class="d-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded round">
                                                <iconify-icon icon="solar:checklist-minimalistic-line-duotone"
                                                    class="fs-7"></iconify-icon>
                                            </span>
                                            <div class="w-75 v-middle ps-3">
                                                <h5 class="mb-1 fs-3 fw-medium">My Task</h5>
                                                <span class="fs-2 d-block text-body-secondary">To-do and
                                                    Daily Tasks</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-grid py-4 px-7 pt-8">
                                        <a href="https://bootstrapdemos.wrappixel.com/materialM/dist/default-sidebar/authentication-login.html"
                                            class="btn btn-primary">Log Out</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- end profile Dropdown -->
                        <!-- ------------------------------- -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
