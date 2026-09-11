<x-nav></x-nav>
<div class="register-wrapper">
    <div class="register-card">
        <div class="form-box">
            <h2>Create Account</h2>
            <form action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Next: Register School</button>
            </form>

            @if ($errors->any())
                <div class="error-text">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
:root {
    --color-background: #f4f6f9;
    --color-card: #ffffff;
    --color-primary: #2563eb;
    --color-border: #d1d5db;
    --color-foreground: #1e293b;
    --radius-md: 12px;
}

/* Wrapper centers the card */
.register-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: var(--color-background);
}

/* Card */
.register-card {
    background: var(--color-card);
    border-radius: var(--radius-md);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    padding: 2rem;
    max-width: 400px;
    width: 100%;
}

/* Form box */
.form-box h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: var(--color-primary);
}

/* Form groups */
.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #64748b;
    font-weight: 600;
}

.form-group input {
    width: 100%;
    padding: 0.75rem;
    border-radius: var(--radius-md);
    border: 1px solid var(--color-border);
    background: #f9fafb;
    color: var(--color-foreground);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-group input:focus {
    border-color: var(--color-primary);
    outline: none;
    box-shadow: 0 0 0 2px var(--color-primary);
}

/* Button */
.btn-primary {
    width: 100%;
    padding: 0.75rem;
    background: var(--color-primary);
    color: #fff;
    border: none;
    border-radius: var(--radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: opacity 0.2s, transform 0.2s;
}

.btn-primary:hover {
    opacity: 0.9;
    transform: scale(1.02);
}

/* Error */
.error-text {
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 8px;
}
</style>
