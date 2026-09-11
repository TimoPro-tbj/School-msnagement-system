<div class="sidebar" id="sidebar">

    <div class="header">
                <button id="toggleSidebar" aria-label="Toggle sidebar">☰</button>
        <div class="header-top">
            <img src="{{ asset('storage/' . ($schoolBadge ?? 'default-badge.png')) }}" class="logo-img" alt="School Badge">
            <a href="/dashboard" class="school-name">{{ $schoolName ?? 'Default School' }}</a>
        </div>
    </div>

    <nav class="nav-links">
        <a href="/teachers/show" class="link {{ Request::is('teachers/*') ? 'active' : '' }}">👨‍🏫 <span class="link-text">Teachers</span></a>
        <a href="/students/show" class="link {{ Request::is('students/*') ? 'active' : '' }}">🎓 <span class="link-text">Students</span></a>
        <a href="/courses/show" class="link {{ Request::is('courses/*') ? 'active' : '' }}">📚 <span class="link-text">Courses</span></a>
        <a href="/admin/dashboard" class="link {{ Request::is('admin/*') ? 'active' : '' }}">🛡️ <span class="link-text">Admin</span></a>
        <a href="{{ route('admin.actions.index') }}" class="link {{ Request::is('admin/actions*') ? 'active' : '' }}">⚡ <span class="link-text">Actions</span></a>
    </nav>

    <div class="sidebar-footer">
        <a href="#settings-popup" onclick="openSettings()" class="link settings">⚙️ <span class="link-text">Settings</span></a>
        <form method="POST" action="/logout">
            @csrf
            @method('DELETE')
            <button type="submit" class="logout-btn">🚪 <span class="link-text">Log out</span></button>
        </form>
    </div>
</div>

<style>
.sidebar {
    width: 220px;
    height: 100vh;
    background: #072846;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    padding: 1rem;
    box-shadow: 2px 0 12px rgba(0,0,0,0.2);
    transition: width 0.3s ease; /* smooth collapse */
}
.header {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.6rem;
    margin-bottom: 2rem;
}

.header-top {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.6rem;
}

#toggleSidebar {
    background: transparent;
    border: none;
    color: #fff;
    font-size: 1.4rem;
    cursor: pointer;
    transition: transform 0.3s ease;
}
#toggleSidebar:hover { transform: rotate(90deg); }
        .sidebar.collapsed { width: 80px; }


.header {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.6rem;
    margin-bottom: 2rem;
}

.logo-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.2);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.school-name {
    font-size: 1rem;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
}


.nav-links {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    margin-top:20px;
}

.link {
    text-decoration: none;
    color: #cbd5e1;
    font-size: 0.95rem;
    font-weight: 600;
    padding: 0.5rem 0.8rem;
    border-radius: 6px;
    transition: background 0.2s ease, color 0.2s ease;
}

.link:hover { background: rgba(255,255,255,0.1); color: #fff; }
.link.active { background: rgba(255,255,255,0.2); color: var(--accent); }

.sidebar-footer {
    margin-top: auto;
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.logout-btn {
    background: rgba(228, 32, 32, 0.1);
    color: var(--danger);
    border: 1px solid rgba(239, 68, 68, 0.25);
    padding: 0.6rem 1rem;
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom:20px;
    width: 100%;
    text-align: center;
}

.logout-btn:hover {
    background: var(--danger);
    color: #fff;
    border-color: var(--danger);
}
</style>
<script>
const toggleBtn = document.getElementById('toggleSidebar');
const sidebar = document.getElementById('sidebar');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
});
</script>