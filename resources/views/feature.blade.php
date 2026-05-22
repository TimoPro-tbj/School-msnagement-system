<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Features</title>
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
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            max-width: 1100px;
            width: 100%;
            text-align: center;
        }

        .title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #38bdf8;
            font-weight: 700;
        }

        .subtitle {
            font-size: 1.1rem;
            color: #94a3b8;
            margin-bottom: 3rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 2.5rem 2rem;
            text-align: left;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: #38bdf8;
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .card-title {
            font-size: 1.4rem;
            color: #f1f5f9;
            margin-bottom: 0.75rem;
        }

        .card-text {
            color: #94a3b8;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .back-btn {
            display: inline-block;
            margin-top: 3rem;
            padding: 0.75rem 1.5rem;
            background-color: #38bdf8;
            color: #0f172a;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.2s ease;
        }

        .back-btn:hover {
            background-color: #0ea5e9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="title">System Features</h1>
        <p class="subtitle">A complete digital environment tailored for every user role in our institution.</p>

        <div class="grid">
            <div class="card">
                <span class="card-icon">💼</span>
                <h3 class="card-title">For Administrators</h3>
                <p class="card-text">Complete authority over system configurations, secure record archives, and streamlined background registration workflows for tracking new additions.</p>
            </div>

            <div class="card">
                <span class="card-icon">👨‍🏫</span>
                <h3 class="card-title">For Teachers</h3>
                <p class="card-text">Effortless structural management tools to assign directories, organize dedicated classrooms, and view course distribution updates in real-time.</p>
            </div>

            <div class="card">
                <span class="card-icon">🎓</span>
                <h3 class="card-title">For Students</h3>
                <p class="card-text">A simplified user experience to view current personal profiles, track assigned class curricula, and view active educational courses smoothly.</p>
            </div>
        </div>

        <a href="/" class="back-btn">Back to Home</a>
    </div>

</body>
</html>
