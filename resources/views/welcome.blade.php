<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Management System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: url('{{ asset("welcome.image.jpg") }}') center/cover no-repeat;
      color: #f8fafc;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      z-index: 0;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.25rem 8%;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    .nav-logo {
      font-size: 1.5rem;
      font-weight: 800;
      letter-spacing: 0.5px;
      color: #fff;
    }

    .nav-logo span {
      color: #6366f1;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .nav-item {
      text-decoration: none;
      color: #cbd5e1;
      font-size: 0.95rem;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-item:hover, .nav-item.active {
      color: #fff;
    }

    .btn-signin {
      text-decoration: none;
      padding: 0.6rem 1.4rem;
      background: rgba(255, 255, 255, 0.05);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 8px;
      font-size: 0.95rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-signin:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .cont {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 8% 8% 4% 8%;
      margin-top: 80px;
      position: relative;
      z-index: 1;
    }

    .description {
      max-width: 700px;
      padding: 2.5rem;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 24px;
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    .description h1 {
      font-size: 2.8rem;
      font-weight: 800;
      line-height: 1.2;
      color: #ffffff;
      margin-bottom: 1.5rem;
    }

    .description h1 .highlight {
      background: linear-gradient(to right, #818cf8, #c084fc);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .separator {
      border: none;
      height: 4px;
      width: 60px;
      background: linear-gradient(to right, #6366f1, #a855f7);
      border-radius: 2px;
      margin: 0 auto 1.5rem auto;
    }

    .description .p {
      font-size: 1.1rem;
      line-height: 1.7;
      color: #cbd5e1;
      margin-bottom: 2rem;
    }

    .admin {
      padding: 0.8rem 2rem;
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1.05rem;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .admin:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.6);
    }

    .admin:active {
      transform: translateY(0);
    }

    @media (max-width: 968px) {
      .description h1 {
        font-size: 2.2rem;
      }
      .cont {
        padding: 120px 5% 5% 5%;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <div class="nav-logo">
      <span>Edu</span>OS
    </div>
    <div class="nav-links">
      <a href="" class="nav-item active">Home</a>
      <a href="/feature" class="nav-item">Features</a>
      <a href="/about" class="nav-item">About</a>
      <a href="/login" class="btn-signin">Sign In</a>
    </div>
  </nav>

  <div class="cont">
    <div class="description">
      <h1>The All-in-One <br><span class="highlight">Operating System</span> <br>for Modern Schools</h1>
      <hr class="separator">
      <p class="p">
        Streamline administration, engage parents, and empower educators with the cloud-based platform built for forward-thinking education institutions. Register your school today.
      </p>
      <a href="/register" class="admin">Get started <span class="arrow">→</span></a>
    </div>
  </div>

</body>
</html>
