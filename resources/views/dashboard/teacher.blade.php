<x-layout>
<style>
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

/* Cards */
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
.card {
    background: var(--card-bg);
    border: 1px solid var(--border-glow);
    border-radius: 12px;
    padding: 1.5rem;
    flex: 1 1 220px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
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
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 1rem;
}

/* Announcement Banner */
.announcement-banner {
    position: relative;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg,#1e293b 0%, #0f172a 100%);
    color: #ffffff;
    padding: 14px 22px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
    gap: 16px;
    border-left: 4px solid #3b82f6;
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
.fade-out-up {
    animation: fadeOutUp 0.5s ease forwards;
}
@keyframes fadeOutUp {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-20px); }
}
</style>

<!-- Sidebar -->
@include('partials.sidebar') 

<!-- Announcement Banner -->
<div id="announcement-banner" class="announcement-banner">
    <div class="announcement-left">
        <span class="announcement-tag">Notice Board</span>
    </div>
    <div class="announcement-text">
        <p>{{ $latestAnnouncement ?? 'No announcements yet' }}</p>
    </div>
    <div class="announcement-action">
        <span class="announcement-time">Latest Update</span>
    </div>
    <button type="button" class="dismiss-banner-btn" aria-label="Dismiss">&times;</button>
</div>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="animated-line"></div>
    <h1>{{ $school?->schoolname ?? 'No school' }}</h1>
    <h2>Welcome, {{ $teacher->teacher_name }}</h2>
    <p>Email: {{ $teacher->email }}</p>
</div>

<!-- Stats Cards -->
<div class="box">
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-title">Your Courses</div>
            <div class="card-value">{{ $courses->count() }}</div>
        </div>
    </div>
</div>

<!-- Detailed List -->
<div class="box" style="margin-top:2rem;">
    <h3>Your Courses</h3>
    <ul>
        @forelse($courses as $course)
            <li>{{ $course->course_name }} (Teacher: {{ $course->teacher_name }})</li>
        @empty
            <li>No courses assigned yet.</li>
        @endforelse
    </ul>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const banner = document.getElementById("announcement-banner");
    const dismissBtn = banner.querySelector(".dismiss-banner-btn");
    const message = banner.querySelector(".announcement-text p").textContent;

    // Check if dismissed before
    const dismissed = localStorage.getItem("dismissed_teacher_announcement");
    if (dismissed === message) {
        banner.style.display = "none";
    }

    // Dismiss button logic
    dismissBtn.addEventListener("click", () => {
        banner.classList.add("fade-out-up");
        setTimeout(() => {
            banner.style.display = "none";
            localStorage.setItem("dismissed_teacher_announcement", message);
        }, 500);
    });
});
</script>
</x-layout>
