<x-layout title="Admin Dashboard">

    <!-- Announcement Section -->
    <section class="card">
        <h2 class="card-title">📢 Create Announcement</h2>
        <form method="POST" action="/admin">
            @csrf
            <label for="message" class="label">New Idea</label>
            <textarea name="message" id="message" rows="3" class="input"></textarea>
            @if ($errors->has('message'))
                <p class="error-text">{{ $errors->first('message') }}</p>
            @endif
            <button type="submit" class="btn">🚀 Post Announcement</button>
        </form>
    </section>
<section class="card">
    <h2 class="card-title">🛡️ Promote Teacher to Admin</h2>
    <p class="card-desc">Search and select a teacher to grant admin rights.</p>

    <form method="POST" action="/admin/promote">
        @csrf

        <!-- Search box -->
        <input type="text" id="teacherSearch" placeholder="Search teacher..." class="input mb-2">

        <!-- Dropdown -->
        <select name="teacher_id" id="teacherSelect" class="input" required size="6">
            @foreach ($teachers as $teacher)
                @if ($teacher->user && $teacher->user->role === 'teacher')
                    <option value="{{ $teacher->id }}">
                        {{ $teacher->teacher_name }}
                    </option>
                @endif
            @endforeach
        </select>

        <label for="password" class="label">New Admin Password</label>
        <input type="password" name="password" id="password" class="input mb-2" required minlength="8">

        <button type="submit" class="btn">Promote to Admin</button>
    </form>
</section>



  


    <!-- Admin Actions Timeline -->
    <section class="card">
        <h2 class="card-title">🕒 Admin Activity Timeline</h2>

        <!-- Export Button -->
        <form method="GET" action="/admin/actions/export" style="margin-bottom: 1rem;">
            <button type="submit" class="btn">⬇️ Export Logs (CSV)</button>
        </form>

        <div class="timeline">
            @foreach($actions as $action)
                <div class="timeline-item" id="action-{{ $action->id }}">
                    <div class="timeline-icon">
                        @if(str_contains($action->action, 'Promoted'))
                            🛡️
                        @elseif(str_contains($action->action, 'Deleted'))
                            ❌
                        @else
                            📌
                        @endif
                    </div>
                    <div class="timeline-content">
                        <span class="timeline-time">{{ $action->created_at->format('d M Y H:i') }}</span>
                        <p class="timeline-text">
                            {{ $action->action }}
                            <span class="admin-name">by {{ $action->admin->name }}</span>
                        </p>
                        <button class="remove-btn" onclick="removeAction({{ $action->id }})">Remove</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $actions->links() }}
        </div>
    </section>

    <!-- Inline CSS -->
    <style>
        body { font-family: Arial, sans-serif; background: #0d1117; color: #e6edf3; }
        .card {
            background: #161b22;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
            margin-bottom: 2rem;
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #38bdf8;
        }
        .card-desc { font-size: 0.9rem; margin-bottom: 1rem; color: #8b949e; }
        .label { display: block; margin-bottom: 6px; font-weight: 600; color: #c9d1d9; }
        .input, textarea, select {
            width: 100%; padding: 10px; border-radius: 8px;
            border: 1px solid #30363d; background: #0d1117; color: #e6edf3;
            margin-bottom: 1rem; font-size: 0.95rem;
        }
        .input:focus, textarea:focus, select:focus {
            outline: none; border-color: #58a6ff;
            box-shadow: 0 0 0 2px rgba(56, 189, 248, 0.4);
        }
        .btn {
            background: #238636; color: #fff; padding: 10px 16px;
            border-radius: 8px; border: none; cursor: pointer;
            font-weight: 600; transition: background 0.2s ease;
        }
        .btn:hover { background: #2ea043; }
        .error-text { color: #f85149; font-size: 0.85rem; margin-top: -8px; margin-bottom: 10px; }

        /* Timeline styling */
        .timeline {
            position: relative;
            margin: 20px 0;
            border-left: 2px solid #30363d;
            padding-left: 20px;
        }
        .timeline-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .timeline-icon {
            flex: 0 0 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #58a6ff;
            background: #161b22;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #58a6ff;
            margin-right: 12px;
        }
        .timeline-content {
            flex: 1;
            background: #0d1117;
            padding: 12px 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        }
        .timeline-time {
            font-size: 0.85rem;
            color: #8b949e;
            margin-bottom: 6px;
            display: block;
        }
        .timeline-text {
            font-size: 0.95rem;
            color: #e6edf3;
            margin-bottom: 6px;
        }
        .admin-name {
            color: #38bdf8;
            font-weight: 700;
            margin-left: 6px;
            font-style: italic;
        }
        .remove-btn {
            background: #f85149;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background 0.2s ease;
            margin-top: 8px;
        }
        .remove-btn:hover { background: #c93c37; }
    </style>

    <!-- JS -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let page = 1;
            const timeline = document.querySelector(".timeline");

            window.addEventListener("scroll", () => {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                    page++;
                    fetch(`/admin/actions?page=${page}`)
                        .then(res => res.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const newItems = parser.parseFromString(html, "text/html")
                                .querySelectorAll(".timeline-item");
                            newItems.forEach(item => timeline.appendChild(item));
                        });
                }
            });
        });

        function removeAction(id) {
            const item = document.getElementById(`action-${id}`);
            if (item) {
                item.style.transition = "opacity 0.3s ease";
                item.style.opacity = "0";
                setTimeout(() => item.remove(), 300);
            }
        }
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("teacherSearch");
    const teacherSelect = document.getElementById("teacherSelect");

    searchInput.addEventListener("keyup", function() {
        const filter = searchInput.value.toLowerCase();
        const options = teacherSelect.options;

        for (let i = 0; i < options.length; i++) {
            const text = options[i].text.toLowerCase();
            options[i].style.display = text.includes(filter) ? "" : "none";
        }
    });
});
</script>
</x-layout>
