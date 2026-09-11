<x-layout>
<style>
/* === Dashboard Styles (your original CSS) === */
.dashboard-announcement-banner {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(135deg,#1e293b 0%, #0f172a 100%);
    color: #ffffff;
    padding: 14px 22px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
    gap: 16px;
    border-left: 4px solid #0a1d3d;
    transform: translateY(-20px);
    opacity: 0;
    animation: slideDown 0.6s ease forwards;
}
.dismiss-banner-btn {
    position: absolute;
    top: 8px;
    right: 12px;
    background: transparent;
    border: none;
    color: #fff;
    font-size: 1.4rem;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease, transform 0.2s ease;
}
.dismiss-banner-btn:hover {
    color: #ef4444;
    transform: scale(1.2);
}
.dashboard-header {
    margin-bottom: 2rem;
    text-align: left;
    padding-left: 2rem;
    position: relative;
}
.dashboard-header h1 {
    font-size: 2rem;
    font-weight: 800;
    color: var(--accent);
    margin-bottom: 0.5rem;
}
.animated-line {
    width: 6px;
    height: 100%;
    background: linear-gradient(180deg,#ef4444,#f59e0b,#10b981,#3b82f6,#8b5cf6);
    border-radius: 6px;
    position: absolute;
    left: 0;
    top: 0;
    animation: pulseLine 4s linear infinite;
}
@keyframes pulseLine {
    0% { opacity: 0.6; }
    50% { opacity: 1; }
    100% { opacity: 0.6; }
}
.box {
    background: #fff;
    padding: 20px 10px;
    border-radius: 10px;
}
.dashboard-grid {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 2rem;
    flex-wrap: wrap;
    margin-left: 2rem;
}
.stat-card-card-teachers,
.card-students,
.card-courses {
    background: var(--card-bg);
    border: 1px solid var(--border-glow);
    border-radius: 12px;
    padding: 1.5rem;
    flex: 1 1 220px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.stat-card-card-teachers:hover,
.card-students:hover,
.card-courses:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.card-title {
    font-size: 0.9rem;
    color: var(--text-secondary);
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}
.card-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 1rem;
}
.card-action-btn {
    text-decoration: none;
    background: var(--accent);
    color: #fff;
    padding: 0.6rem 1.2rem;
    border-radius: 6px;
    font-weight: 600;
    transition: background 0.3s ease, transform 0.2s ease;
    display: inline-block;
}
.card-action-btn:hover {
    background: #4a2c11;
    transform: scale(1.05);
}
@keyframes slideDown {
    to { transform: translateY(0); opacity: 1; }
}
.fade-out-up {
    animation: fadeOutUp 0.5s ease forwards;
}
@keyframes fadeOutUp {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-20px); }
}
@media (max-width: 768px) {
    .dashboard-grid { margin-left: 0; justify-content: center; }
    .dashboard-header { text-align: center; padding-left: 0; }
    .animated-line { display: none; }
}
.toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #161b22;
    color: #e6edf3;
    padding: 12px 18px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.5s ease forwards, fadeOut 4s ease forwards;
    z-index: 1000;
}
.dashboard-header h1 {
  color: var(--accent);
}

.card-title {
  color: var(--text-secondary);
}

.card-value {
  color: var(--accent);
}

.card-action-btn {
  background: var(--accent);
  color: #fff;
}
.card-action-btn:hover {
  background: #4a2c11; /* optional: make this a variable too */
}

.toast-success { border-left: 4px solid #10b981; }
.toast-error { border-left: 4px solid #ef4444; }
@keyframes slideUp { to { opacity: 1; transform: translateY(0); } }
@keyframes fadeOut { 0%, 80% { opacity: 1; } 100% { opacity: 0; transform: translateY(20px); } }
</style>

<!-- Announcement Banner -->
<div id="announcement-banner" class="dashboard-announcement-banner">
    <div class="announcement-left">
        <span class="announcement-tag">Notice Board</span>
    </div>
    <div class="announcement-text">
        <p>{{ $latestAnnouncement }}</p>
    </div>
    <div class="announcement-action">
        <span class="announcement-time">Latest Update</span>
    </div>
    @if(Auth::user()->role === 'admin')
        <button type="button" class="dismiss-banner-btn" aria-label="Dismiss">&times;</button>
    @endif
</div>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="animated-line"></div>
    <h1>{{ $school?->schoolname ?? 'No school' }}</h1>
</div>

<!-- Stats Cards -->
<div class="box">
    <div class="dashboard-grid">
        <div class="stat-card-card-teachers">
            <div class="card-title">Total Teachers</div>
            <div class="card-value">{{ $teachersCount }}</div>
            @if(Auth::user()->role === 'admin')
                <a href="#teacher-popup" class="card-action-btn">+ Add Teacher</a>
            @endif
        </div>

        <div class="card-students">
            <div class="card-title">Total Students</div>
            <div class="card-value">{{ $studentsCount }}</div>
            @if(Auth::user()->role === 'admin')
                <a href="#student-popup" class="card-action-btn">+ Add Student</a>
            @endif
        </div>

        <div class="card-courses">
            <div class="card-title">Active Courses</div>
            <div class="card-value">{{ $coursesCount }}</div>
            @if(Auth::user()->role === 'admin')
                <a href="#course-popup" class="card-action-btn">+ Add Course</a>
            @endif
        </div>
    </div>
</div>

<!-- Popups (only for admins) -->
@if(Auth::user()->role === 'admin')
<div class="card-grid">
    @include('create.teachers')
    @include('create.courses')
     @include('create.students')
    @include('settings')
</div>
@endif

@if(session('success'))
    <div id="toast" class="toast toast-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div id="toast" class="toast toast-error">
        {{ $errors->first() }}
    </div>
@endif

<script>
document.addEventListener("DOMContentLoaded", () => {
    const banner = document.getElementById("announcement-banner");
    const dismissBtn = banner.querySelector(".dismiss-banner-btn");
    if(dismissBtn){
        const message = banner.querySelector(".announcement-text p").textContent;
        const dismissed = localStorage.getItem("dismissed_announcement");
        if (dismissed === message) {
            banner.style.display = "none";
        }
        dismissBtn.addEventListener("click", () => {
            banner.classList.add("fade-out-up");
            setTimeout(() => {
                banner.style.display = "none";
                localStorage.setItem("dismissed_announcement", message);
            }, 500);
        });
    }
});
</script>
</x-layout>
