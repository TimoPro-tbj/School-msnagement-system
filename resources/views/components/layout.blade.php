<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'School Management System' }}</title>
    <link rel="stlyesheet" href="css/app.css" />
    <style>
        :root {
            --bg-main: #030305;
            --bg-glass: rgba(10, 10, 14, 0.85);
            --card-glass: rgba(255, 255, 255, 0.02);
            --border-glow: rgba(255, 255, 255, 0.05);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --coffee-primary: #6f4e37;
            --coffee-glow: rgba(111, 78, 55, 0.25);
            --coffee-light: #dcd1c4;
        }

       html, body {
            background-color: var(--bg-main);
            color: var(--text-primary);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            max-height:100vh;
            overflow-x: hidden;
        }

        .global-layout-wrapper {
            position: relative;
            min-height: 100vh;
            background: var(--bg-glass);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
        }

        .global-layout-wrapper::before {
            content: '';
            position: fixed;
            top: -250px;
            right: -250px;
            width: 800px;
            height: 300px;
            background: radial-gradient(circle at center, var(--coffee-glow) 0%, rgba(74, 44, 17, 0.03) 60%, transparent 100%);
            pointer-events: none;
            z-index: 0;
        }
        </style>
        <style>
    {!! file_get_contents(resource_path('css/app.css')) !!}
    {!! file_get_contents(resource_path('css/popups.css')) !!}
</style>

</head>
<body>

    <div class="global-layout-wrapper">
        {{ $slot }}
    </div>
</body>
</html>
