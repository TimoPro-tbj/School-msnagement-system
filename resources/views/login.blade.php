<x-nav></x-nav>
<div class="login-wrapper">
    <div class="login-card">
        <!-- Left form -->
        <div class="login-form">
            <div class="form-box">
                <h2>Sign In</h2>
                <form action="/login" method="POST" autocomplete="off">
                    @csrf
                    <label class="label">Email</label>
                    <input type="email" name="email" class="input" placeholder="Enter Email..." required>

                    <label class="label">Password</label>
                    <input type="password" name="password" class="input" placeholder="Enter Password..." required>

                    <label class="label">School Code</label>
                    <input type="text" name="schoolcode" class="input" placeholder="Enter School Code..." required>

                    <button type="submit" class="btn-login">Login</button>

                    @if ($errors->any())
                        <div class="error-text">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Right image -->
        <div class="login-image"></div>
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

/* Wrapper */
.login-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: var(--color-background);
}

/* Card */
.login-card {
    display: flex;
    border-radius: var(--radius-md);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    overflow: hidden;
    max-width: 900px;
    width: 100%;
    height: 500px;
}

/* Form side */
.login-form {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
    background: var(--color-card);
    color: var(--color-foreground);
}

.form-box {
    width: 100%;
    max-width: 320px;
}

.form-box h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: var(--color-primary);
}

/* Labels & Inputs */
.label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #64748b;
}

.input {
    width: 100%;
    padding: 0.75rem;
    border-radius: var(--radius-md);
    border: 1px solid var(--color-border);
    background: #f9fafb;
    color: var(--color-foreground);
    margin-bottom: 1rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.input:focus {
    border-color: var(--color-primary);
    outline: none;
    box-shadow: 0 0 0 2px var(--color-primary);
}

/* Button */
.btn-login {
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

.btn-login:hover {
    opacity: 0.9;
    transform: scale(1.02);
}

/* Error */
.error-text {
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 8px;
}

/* Image side */
.login-image {
    flex: 1;
    background: url('/image.png') no-repeat center center;
    background-size: cover;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
}
</style>