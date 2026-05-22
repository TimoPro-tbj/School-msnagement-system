<style>
.nav-container {
    position: relative;
    z-index: 10;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 4rem;
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid var(--border-glow);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}
.btnm {
            background: rgba(239, 68, 68, 0.05);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.25);
            padding: 0.6rem 1.4rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btnm:hover {
            background: #ef4444;
            color: #ffffff;
            border-color: #ef4444;
            box-shadow: 0 8px 24px rgba(239, 68, 68, 0.3);
            transform: translateY(-2px);
        }
.header {
    display: flex;
    align-items: center;
    gap: 1.2rem;
}
.logo-img {
    width: 44px;
    height: 44px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
}
.span {
    text-decoration:none;
    font-size: 1.4rem;
    font-weight: 800;
    letter-spacing: -0.5px;
    background: linear-gradient(135deg, #ffffff 40%, var(--coffee-light) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 0.3px;
    position: relative;

}

.span::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--coffee-primary);
    transition: width 0.3s ease;
}
.span:hover {
    color: var(--text-primary);
}
.span:hover::after {
    width: 100%;
}
.span.active {
    color: var(--text-primary);
}
.span.active::after {
    width: 100%;
}
.lenks {
    display: flex;
    align-items: center;
    gap: 2.2rem;
}
.links {
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 0.95rem;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: color 0.3s ease, transform 0.2s ease;
    position: relative;
    padding: 0.2rem 0;
}
.links::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--coffee-primary);
    transition: width 0.3s ease;
}
.links:hover {
    color: var(--text-primary);
}
.links:hover::after {
    width: 100%;
}
.links.active {
    color: var(--text-primary);
}
.links.active::after {
    width: 100%;
}
@media (max-width: 768px) {
    .nav-container {
        flex-direction: column;
        padding: 1rem 2rem;
        gap: 1rem;
    }
    .lenks {
        flex-direction: column;
        gap: 1rem;
    }
}
</style>

<nav class="nav-container" aria-label="Main navigation">
    <div class="header">
        <div class="image">
            <img src="{{ asset('storage/' . $schoolBadge) }}" class="logo-img" alt="School Badge">
        </div>
        <a href="/dashboard" class="span">{{ $schoolName }}</a>
    </div>

    <div class="nav-group" id="nav">
        @auth
            <div class="lenks">
                <a href="/teachers/show" class="links {{ Request::is('teachers/*') ? 'active' : '' }}">Teachers</a>
                <a href="/students/show" class="links {{ Request::is('students/*') ? 'active' : '' }}">Students</a>
                <a href="/courses/show" class="links {{ Request::is('courses/*') ? 'active' : '' }}">Course</a>
               <form method="POST" action="/logout">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btnm">Log out</button>
                    </form>
            </div>
        @else
            <div class="lenks">
                <a href="/login" class="links {{ Request::is('login') ? 'active' : '' }}">Login</a>
                <a href="/register" class="links {{ Request::is('register') ? 'active' : '' }}">Register</a>
            </div>
        @endauth
    </div>
</nav>
