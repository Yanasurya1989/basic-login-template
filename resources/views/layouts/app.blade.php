<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            transition: background-color 0.3s ease;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #212529;
            color: white;
            flex-shrink: 0;
            transition: width 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-header .full-title {
            display: inline;
        }

        .sidebar.collapsed .sidebar-header .full-title {
            display: none;
        }

        .sidebar-header .short-title {
            display: none;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .sidebar.collapsed .sidebar-header .short-title {
            display: inline;
        }

        .sidebar a {
            color: white;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: background-color 0.2s ease;
            border-radius: 4px;
            margin: 2px 8px;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar a span,
        .sidebar-footer form button span {
            opacity: 1;
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed a span,
        .sidebar.collapsed .sidebar-footer form button span {
            opacity: 0;
            display: none;
        }

        .sidebar a.active {
            background-color: #495057;
            font-weight: bold;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        /* Footer buttons */
        .sidebar-footer {
            margin-top: auto;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .collapse-btn {
            background: #343a40;
            color: white;
            border: none;
            padding: 6px;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .collapse-btn.rotate {
            transform: rotate(180deg);
        }

        /* Content */
        .content {
            flex-grow: 1;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            transition: background-color 0.3s ease;
        }

        header {
            background-color: white;
            border-bottom: 1px solid #ddd;
            padding: 15px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        main {
            flex-grow: 1;
            padding: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Dark Mode */
        body.dark-mode {
            background-color: #1a1d20;
        }

        body.dark-mode .sidebar {
            background-color: #181b1f;
        }

        body.dark-mode header {
            background-color: #212529;
            color: white;
        }

        body.dark-mode .content {
            background-color: #2a2d31;
            color: white;
        }

        body.dark-mode a.active,
        body.dark-mode a:hover {
            background-color: #343a40 !important;
        }
    </style>
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-header">
            <span class="short-title">L</span>
            <span class="full-title">{{ config('app.name', 'MyApp') }}</span>
        </div>

        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}" data-bs-toggle="tooltip"
            data-bs-placement="right" title="Dashboard">
            <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
        </a>
        <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu 1">
            <i class="bi bi-list-task"></i> <span>Menu 1</span>
        </a>
        <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu 2">
            <i class="bi bi-folder"></i> <span>Menu 2</span>
        </a>
        <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu 3">
            <i class="bi bi-gear"></i> <span>Menu 3</span>
        </a>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Logout">
                    <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
                </button>
            </form>

            <button class="collapse-btn" id="collapseSidebar" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Collapse / Expand">
                <i class="bi bi-chevron-left"></i>
            </button>

            <button class="collapse-btn" id="toggleDarkMode" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Toggle Dark Mode">
                <i class="bi bi-moon"></i>
            </button>
        </div>
    </div>

    {{-- Content --}}
    <div class="content">
        <header class="d-flex justify-content-between align-items-center">
            <h5 class="m-0">@yield('title', 'Dashboard')</h5>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>
                                Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tooltip
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

        // Collapse Sidebar
        const sidebar = document.getElementById('sidebarMenu');
        const collapseBtn = document.getElementById('collapseSidebar');

        collapseBtn.addEventListener('click', () => {
            const isCollapsed = sidebar.classList.contains('collapsed');
            collapseBtn.classList.toggle('rotate', !isCollapsed);

            if (isCollapsed) {
                sidebar.classList.remove('collapsed');
            } else {
                sidebar.classList.add('collapsed');
            }

            const icon = collapseBtn.querySelector('i');
            icon.classList.toggle('bi-chevron-left');
            icon.classList.toggle('bi-chevron-right');
        });

        // Dark Mode Toggle
        const toggleDarkModeBtn = document.getElementById('toggleDarkMode');
        toggleDarkModeBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        });

        // Load Dark Mode from storage
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        } else {
            const hour = new Date().getHours();
            if (hour >= 18 || hour < 6) {
                document.body.classList.add('dark-mode');
            }
        }
    </script>
</body>

</html>
