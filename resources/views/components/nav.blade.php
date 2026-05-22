<style>
 :root {
        --color-background: #0b0e14;
        --color-card: #161b22;
        --color-primary: #38bdf8;
        --color-border: #30363d;
        --color-foreground: #e6edf3;
        --spacing: 4px;
        --radius-md: 8px;
    }

    nav {
        backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--color-border);
        position: sticky;
        top: 0;
        z-index: 50;
        max-height:200px;
    }

    .nav-container {
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        height: 4rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .logo-img {
        max-width:15px;
        border-radius: 20px;
        transition: opacity 0.2s;
    }

    .logo-img:hover {
        opacity: 0.8;
    }

    .nav-group {
        display: flex;
        align-items: center;
        gap: 2.25rem;
    }

    .btnn, .btnb, .btnm {
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        padding: 0.5rem 1rem;
        background-color: var(--color-primary);
        border-radius: var(--radius-md);
        transition: all 0.2s ease;
    }

    .btnn:hover {
        color: var(--color-foreground);
    }

    .btnb {
        background-color: var(--color-primary);
        color: var(--color-background);
    }

    .btnb:hover {
        background-color: #7dd3fc;
    }

    .btnm {
        background-color: transparent;
        border: 1px solid var(--color-border);
        color: #f87171;
        cursor: pointer;
    }

    .btnm:hover {
        background-color: rgba(248, 113, 113, 0.1);
        border-color: #f87171;
    }
    
.nav-logo {
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    color: #fff;
}
</style>

<nav>
    <div class="nav-container">
        <div class="nav-logo"> 
            <span>EduOs</span>
        </div>

        <div class="nav-group" id="nav">
            @guest
                <a href="/register" class="btnn">Register</a>
                <a href="/login" class="btnb">Sign In</a>
            @endguest

            @auth
                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btnm">Log out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
