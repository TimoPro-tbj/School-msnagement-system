<nav class="auth-nav">
    <div class="nav-logo"> 
        <span>EduOs</span>
    </div>

    <button class="hamburger" id="hamburgerBtn" aria-label="Toggle menu">☰</button>

    <div class="auth-links" id="navLinks">
        @guest
            <a href="/" class="auth-link">🏠 Home</a>
            <a href="/register" class="btnn">Register</a>
            <a href="/login" class="btnb">Sign In</a>
        @endguest

        @auth
            <a href="/" class="auth-link">🏠 Home</a>
            <form method="POST" action="/logout">
                @csrf
                @method('DELETE')
                <button type="submit" class="btnm">Log out</button>
            </form>
        @endauth
    </div>
</nav>
<style>
.auth-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--color-card);
    border-bottom: 1px solid var(--color-border);
    padding: 0.8rem 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    position: sticky;
    top: 0;
    z-index: 100;
}

.nav-logo {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--color-primary);
    letter-spacing: 0.5px;
}

/* Links container */
.auth-links {
    display: flex;
    gap: 1rem;
}

/* Links */
.auth-link, .btnn, .btnb, .btnm {
    font-size: 0.95rem;
    font-weight: 600;
    text-decoration: none;
    padding: 0.5rem 0.8rem;
    border-radius: var(--radius-md);
    transition: color 0.2s ease, background 0.2s ease;
}

.auth-link {
    color: var(--color-foreground);
}
.auth-link:hover {
    color: var(--color-primary);
    background: rgba(56, 189, 248, 0.1);
}

/* Buttons */
.btnn {
    border: 1px solid var(--color-primary);
    color: var(--color-primary);
    background: transparent;
}
.btnn:hover {
    background: var(--color-primary);
    color: var(--color-background);
}

.btnb {
    background: var(--color-primary);
    color: var(--color-background);
}
.btnb:hover {
    background: #7dd3fc;
}

.btnm {
    background: transparent;
    border: 1px solid var(--color-border);
    color: #f87171;
    cursor: pointer;
}
.btnm:hover {
    background: rgba(248, 113, 113, 0.1);
    border-color: #f87171;
}

/* Hamburger button */
.hamburger {
    display: none;
    background: transparent;
    border: none;
    font-size: 1.5rem;
    color: var(--color-foreground);
    cursor: pointer;
}

/* Responsive */
@media (max-width: 768px) {
    .auth-links {
        display: none;
        flex-direction: column;
        gap: 0.8rem;
        background: var(--color-card);
        position: absolute;
        top: 60px;
        right: 1rem;
        padding: 1rem;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    .auth-links.active {
        display: flex;
    }

    .hamburger {
        display: block;
    }
}
</style>
<script>
const hamburgerBtn = document.getElementById('hamburgerBtn');
const navLinks = document.getElementById('navLinks');

hamburgerBtn.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});
</script>
