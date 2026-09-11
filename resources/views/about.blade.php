<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Our School</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .about-box {
            max-width: 800px;
            width: 100%;
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .heading {
            font-size: 2.5rem;
            color: #38bdf8;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .description {
            font-size: 1.1rem;
            color: #cbd5e1;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            text-align: justify;
        }

        .stats-container {
            display: flex;
            justify-content: space-around;
            gap: 1rem;
            border-top: 1px solid #334155;
            border-bottom: 1px solid #334155;
            padding: 2rem 0;
            margin-bottom: 2.5rem;
        }

        .stat-item {
            flex: 1;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .home-link {
            display: inline-block;
            padding: 0.75rem 2rem;
            background-color: transparent;
            color: #38bdf8;
            border: 2px solid #38bdf8;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .home-link:hover {
            background-color: #38bdf8;
            color: #0f172a;
        }

        @media (max-width: 600px) {
            .stats-container {
                flex-direction: column;
                gap: 1.5rem;
            }
            .about-box {
                padding: 2rem 1.5rem;
            }
        }

    </style>

</head>
<body>

    <div class="about-box">
        <h1 class="heading">About Our Portal</h1>

        <p class="description">
            Welcome to our unified School Management Platform. Designed to optimize modern academic operations, this platform coordinates vital relationships among administration teams, teaching departments, and the student collective. Our mission centers on refining data entry workflows, safeguarding institutional information, and offering immediate workspace visibility to everyone involved.
        </p>

        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number">100%</div>
                <div class="stat-label">Digital Control</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">Real-Time</div>
                <div class="stat-label">Data Sync</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">Secure</div>
                <div class="stat-label">Authentication</div>
            </div>
        </div>

        <a href="/" class="home-link">Return Home</a>
    </div>

</body>
</html>
