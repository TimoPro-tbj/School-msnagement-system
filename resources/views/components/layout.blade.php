<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'School Management System' }}</title>
     <style>
        {!! file_get_contents(resource_path('css/app.css')) !!}
        {!! file_get_contents(resource_path('css/popups.css')) !!}
    </style>
    <style>
html, body {
  margin: 0;
  min-height: 100vh;
  font-family: 'Segoe UI', system-ui, sans-serif;
  background: var(--bg);
  color: var(--text);
}
.sidebar {
  background: var(--sidebar-bg);
}
a, .links, .btn {
  color: var(--text);
}
.btn.primary {
  background: var(--accent);
  color: #fff;
}
body.theme-light {
  --bg: #f9fafb;
  --text: #111827;
  --accent: #2563eb;
  --sidebar-bg: #0f1724;
  background: var(--bg);
  color: var(--text);
}

body.theme-dark {
  --bg: #0b1220;
  --text: #e5e7eb;
  --accent: #38bdf8;
  --sidebar-bg: #111827;
  background: var(--bg);
  color: var(--text);
}

body.theme-blue {
  --bg: #eaf2ff;
  --text: #1e293b;
  --accent: #2563eb;
  --sidebar-bg: #1e40af;
  background: var(--bg);
  color: var(--text);
}

        :root {
            --bg-main: #f4f6f9;
            --sidebar-bg: #072846;
            --accent: #6f4e37;
            --danger: #ef4444;
        }

        html, body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg-main);
            color: #1e293b;
        }

        .global-layout-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: #fff;
            transition: width 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem 1rem;
        }
        .sidebar.collapsed {
            width: 80px;
        }

        #toggleSidebar {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }
        #toggleSidebar:hover { transform: rotate(90deg); }

        .main-content {
            flex: 1;
            padding: 2rem;
            transition: margin-left 0.3s ease;
            margin-left: 260px;
        }
        .sidebar.collapsed + .main-content {
            margin-left: 80px; 
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -260px;
                top: 0;
                height: 100%;
                z-index: 1001;
            }
            .sidebar.active { left: 0; }
            .main-content { margin-left: 0; }
        }

        .overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1000;
            display: none;
        }
        .overlay.active { display: block; }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <button id="toggleSidebar">☰</button>
        @include('partials.navbar')
    </div>
    <div class="main-content">
        {{ $slot }}
    </div>
    <div class="overlay"></div>

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.querySelector('.overlay');

        toggleBtn.addEventListener('click', () => {
            if(window.innerWidth <= 768){
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>
</html>
