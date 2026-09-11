<style>
:root {
  --bg: #f9fafb;
  --text: #111827;
  --accent: #2563eb;
  --sidebar-bg: #0f1724;
}

/* Overlay */
.settings-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.6);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 2000;
  backdrop-filter: blur(6px);
}
.settings-overlay.active { display: flex; }

/* Modal */
.settings-box {
  width: 850px;
  max-width: 95%;
  border-radius: 14px;
  overflow: hidden;
  display: grid;
  position: relative;
  grid-template-columns: 220px 1fr;
  background: #fff;
  box-shadow: 0 30px 80px rgba(0,0,0,0.4);
  color: var(--text);
  animation: popIn 0.3s ease;
}
@keyframes popIn {
  from { opacity: 0; transform: translateY(20px) scale(0.95); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}

/* Sidebar */
.settings-sidebar {
  background: var(--sidebar-bg);
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
.settings-sidebar button {
  background: transparent;
  border: none;
  color: #cbd5e1;
  text-align: left;
  padding: 10px;
  border-radius: 8px;
  cursor: pointer;
  font-weight:600;
  transition: all .2s ease;
}
.settings-sidebar button.active {
  background: var(--accent);
  color: #fff;
}
.settings-sidebar button:hover { color:#fff; transform: translateX(6px); }

/* Sections */
.settings-section { display: none; padding: 1.5rem; }
.settings-section.active { display: block; }
.settings-section h2 {
  font-size: 1.2rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: var(--accent);
  border-bottom: 1px solid #e5e7eb;
  padding-bottom: 0.5rem;
}

/* Cards */
.settings-card {
  background: #fff;
  border-radius: 12px;
  padding: 16px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.08);
  border: 1px solid #e5e7eb;
  margin-bottom: 1rem;
}

/* General profile */
.profile-row { display:flex; gap:16px; align-items:center; }
.profile-avatar {
  width:60px; height:60px; border-radius:50%;
  background: var(--accent); color:#fff;
  display:flex; align-items:center; justify-content:center;
  font-size:1.5rem; font-weight:700;
}
.close-btn {
  position: absolute;
  top: 12px;
  right: 16px;
  font-size: 22px;
  font-weight: bold;
  color: #6b7280; /* neutral gray */
  background: #f3f4f6;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: all 0.2s ease;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  cursor: pointer;
}

.close-btn:hover {
  background: var(--accent); /* highlight with accent color */
  color: #fff;
  transform: rotate(90deg) scale(1.1);
}

.profile-meta h3 { margin:0; font-size:1rem; }
.profile-meta p { margin:0; color:#6b7280; }

/* Stats */
.stats-grid { display:flex; gap:20px; margin-top:1rem; }
.stat { flex:1; text-align:center; }
.stat-title { font-size:0.85rem; color:#6b7280; }
.stat-value { font-size:1.4rem; font-weight:700; color:var(--accent); }

/* Theme cards */
.theme-grid { display:flex; gap:16px; flex-wrap:wrap; margin-top:1rem; }
.theme-card {
  flex:1 1 150px;
  padding:14px;
  border-radius:12px;
  cursor:pointer;
  border:1px solid #e5e7eb;
  background:#fff;
  box-shadow:0 6px 16px rgba(0,0,0,0.08);
  transition: transform .2s ease, box-shadow .2s ease;
}
.theme-card:hover { transform: translateY(-6px); box-shadow:0 12px 24px rgba(0,0,0,0.12); }
.theme-card.active { outline:3px solid var(--accent); }
.theme-preview { height:60px; border-radius:8px; margin-bottom:8px; }
.theme-light .theme-preview { background:#f9fafb; }
.theme-dark .theme-preview { background:#0b1220; }
.theme-blue .theme-preview { background:#eaf2ff; }

/* Toggles */
.toggle-row {
  display:flex; justify-content:space-between; align-items:center;
  margin-top:1rem; padding:10px; border-radius:10px; background:#f3f4f6;
}
.toggle-label { font-weight:600; }
.switch {
  width:44px;height:24px;border-radius:999px;background:#d1d5db;position:relative;cursor:pointer;
}
.knob {
  width:20px;height:20px;border-radius:50%;background:#fff;position:absolute;top:2px;left:2px;
  transition:left .2s ease;
}
.switch.on { background:var(--accent); }
.switch.on .knob { left:22px; }

/* Accounts form */
.settings-form label { display:block; font-size:0.85rem; color:#6b7280; margin-top:10px; }
.settings-form input {
  width:100%; padding:8px; border-radius:8px; border:1px solid #e5e7eb; margin-top:6px;
}
.settings-actions { display:flex; gap:10px; margin-top:14px; justify-content:flex-end; }
.btn { padding:8px 12px; border-radius:8px; border:none; cursor:pointer; font-weight:700; }
.btn.ghost { background:#f3f4f6; color:#111827; }
.btn.primary { background:var(--accent); color:#fff; }
</style>

<div id="settings-popup" class="settings-overlay">
  <div class="settings-box">
    <a href="" class="close-btn">&times;</a>
    <div class="settings-sidebar">
      <button class="active" onclick="showSettingsSection('general')">🏠 General</button>
      <button onclick="showSettingsSection('personalization')">🎨 Personalization</button>
      <button onclick="showSettingsSection('accounts')">👤 Accounts</button>
    </div>
    <div>
      <!-- General -->
      <div id="general" class="settings-section active">
     <a href="" class="close-btn">&times;</a>
        <h2>⚙️ Settings – General</h2>
        <div class="settings-card">
          <div class="profile-row">
            <div class="profile-avatar">{{ substr(auth()->user()->name,0,1) }}</div>
            <div class="profile-meta">
              <h3>{{ auth()->user()->name }}</h3>
              <p>{{ auth()->user()->email }}</p>
              <span style="background:var(--accent);color:#fff;padding:4px 8px;border-radius:6px;font-size:0.8rem;">
                {{ auth()->user()->role }}
              </span>
            </div>
          </div>
          <div class="stats-grid">
            <div class="stat">
              <div class="stat-title">Teachers</div>
              <div class="stat-value">{{ $teachersCount }}</div>
            </div>
            <div class="stat">
              <div class="stat-title">Students</div>
              <div class="stat-value">{{ $studentsCount }}</div>
            </div>
            <div class="stat">
              <div class="stat-title">Courses</div>
              <div class="stat-value">{{ $coursesCount }}</div>
            </div>
          </div>
        </div>
      </div>

 <!-- Personalization -->
      <div id="personalization" class="settings-section">
        <h2>⚙️ Settings – Personalization</h2>
        <div class="settings-card">
          <p>Choose a theme:</p>
          <div class="theme-grid">
            <div class="theme-card theme-light" onclick="applyTheme('light')">
              <div class="theme-preview"></div>
              <div>🌞 Light</div>
            </div>
            <div class="theme-card theme-dark" onclick="applyTheme('dark')">
              <div class="theme-preview"></div>
              <div>🌙 Dark</div>
            </div>
            <div class="theme-card theme-blue" onclick="applyTheme('blue')">
              <div class="theme-preview"></div>
              <div>💎 Blue</div>
            </div>
          </div>

          <div class="toggle-row">
            <div class="toggle-label">Auto start on login</div>
            <div class="switch" id="autoStart" onclick="toggleSwitch(this)">
              <div class="knob"></div>
            </div>
          </div>
          <div class="toggle-row">
            <div class="toggle-label">Keep app running on close</div>
            <div class="switch" id="keepRunning" onclick="toggleSwitch(this)">
              <div class="knob"></div>
            </div>
</div>

<!-- Accounts -->
<div id="accounts" class="settings-section">
  <h2>⚙️ Settings – Accounts</h2>
  <div class="settings-card settings-form">
    <form method="POST" action="settings\update">
      @csrf
      <label>Name</label>
      <input type="text" name="name" value="{{ auth()->user()->name }}">

      <label>Email</label>
      <input type="email" name="email" value="{{ auth()->user()->email }}">

      <div class="settings-actions">
        <button type="button" class="btn ghost" onclick="closeSettings()">Cancel</button>
        <button type="submit" class="btn primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

    </div>
  </div>
</div>

<script>
function showSettingsSection(id) {
  document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  document.querySelectorAll('.settings-sidebar button').forEach(b => b.classList.remove('active'));
  document.querySelector(`.settings-sidebar button[onclick="showSettingsSection('${id}')"]`).classList.add('active');
}
function openSettings() {
  document.getElementById("settings-popup").classList.add("active");
}
function applyTheme(theme) {
  document.body.classList.remove('theme-light','theme-dark','theme-blue');
  document.body.classList.add('theme-'+theme);

  // highlight selected card
  document.querySelectorAll('.theme-card').forEach(c => c.classList.remove('active'));
  document.querySelector('.theme-'+theme).classList.add('active');

  // save choice
  localStorage.setItem('selectedTheme', theme);
}

function closeSettings() {
  document.getElementById("settings-popup").classList.remove("active");

  document.body.classList.remove('theme-light','theme-dark','theme-blue');
  localStorage.removeItem('selectedTheme');
}

window.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('selectedTheme');
  if (savedTheme) {
    document.body.classList.add('theme-'+savedTheme);
    document.querySelector('.theme-'+savedTheme)?.classList.add('active');
  }
});

function toggleSwitch(el) {
  el.classList.toggle('on');
}
</script>
