
<section class="card">
    <h2 class="card-title">🔑 Change Your Password</h2>
    <p class="card-desc">You must set a new password before continuing.</p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
        <input type="password" name="password" id="password" class="input mb-2" required minlength="8">

        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="input mb-2" required minlength="8">

        <button type="submit" class="btn">Update Password</button>
    </form>
</section>
<style>
:root {
  --bg: #f9fafb;
  --text: #111827;
  --text-secondary: #6b7280;
  --accent: #2563eb;
  --sidebar-bg: #0f1724;
  --card-bg: #ffffff;
  --border-glow: #e2e8f0;
}

/* Light theme */
body.theme-light {
  --bg: #f9fafb;
  --text: #111827;
  --text-secondary: #6b7280;
  --accent: #2563eb;
  --sidebar-bg: #0f1724;
  --card-bg: #ffffff;
  --border-glow: #e2e8f0;
}

/* Dark theme */
body.theme-dark {
  --bg: #0b1220;
  --text: #e5e7eb;
  --text-secondary: #9ca3af;
  --accent: #38bdf8;
  --sidebar-bg: #111827;
  --card-bg: #161b22;
  --border-glow: #30363d;
}

/* Blue theme */
body.theme-blue {
  --bg: #eaf2ff;
  --text: #1e293b;
  --text-secondary: #475569;
  --accent: #2563eb;
  --sidebar-bg: #1e40af;
  --card-bg: #ffffff;
  --border-glow: #cbd5e1;
}
.card {
    background: var(--card-bg);
    border: 1px solid var(--border-glow);
    border-radius: 12px;
    padding: 2rem;
    max-width: 420px;
    margin: 3rem auto;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}

/* Title and description */
.card-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 0.5rem;
    text-align: center;
}

.card-desc {
    font-size: 0.95rem;
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    text-align: center;
}

/* Labels */
.label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-secondary);
    margin-bottom: 0.4rem;
}

/* Inputs */
.input {
    width: 100%;
    padding: 0.6rem 0.8rem;
    border: 1px solid var(--border-glow);
    border-radius: 8px;
    background: var(--bg);
    color: var(--text);
    margin-bottom: 1rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.3);
    outline: none;
}

/* Button */
.btn {
    width: 100%;
    background: var(--accent);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 0.7rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.2s ease;
}

.btn:hover {
    background: #1e40af; /* darker accent */
    transform: scale(1.03);
}
</style>