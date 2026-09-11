<x-layout>
<style>
.table-container {
    background: rgba(15, 15, 22, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 20px;
    padding: 1.75rem;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    margin-top: 2rem;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.table-header h2 {
    text-align:center;
    font-size: 1.3rem;
    font-weight: 600;
    color: #ffffff;
    margin: 0;
}

.table-subtitle {
    text-align:center;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.4);
    margin: 0.25rem 0 0 0;
}

.table-badge-total {
    background: rgba(79, 70, 229, 0.1);
    border: 1px solid rgba(79, 70, 229, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 30px;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
    font-weight: 500;
}

.table-badge-total span {
    color: #4f46e5;
    font-weight: 700;
}

.table-responsive {
    overflow-x: auto;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.custom-table th {
    padding: 1rem;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: rgba(255, 255, 255, 0.4);
    font-weight: 600;
    border-bottom: 2px solid rgba(255, 255, 255, 0.05);
}

.custom-table td {
    padding: 1.1rem 1rem;
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.95rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.03);
    vertical-align: middle;
}

.custom-table tbody tr {
    transition: background-color 0.2s ease;
}

.custom-table tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.02);
}

.student-profile-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.avatar-placeholder {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #06b6d4);
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 0.75rem;
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
}

.student-name {
    font-weight: 500;
    color: #ffffff;
}

.course-tag {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: rgba(6, 182, 212, 0.1);
    border: 1px solid rgba(6, 182, 212, 0.2);
    color: #06b6d4;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
}

.date-text {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.85rem;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.edit-btn {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: rgba(255, 255, 255, 0.7);
}

.edit-btn:hover {
    background: #ffffff;
    color: #0f0f16;
    border-color: #ffffff;
    transform: translateY(-1px);
}

.text-right {
    text-align: right;
}
.image{
    border-radius:19px;
    width:45px;
}
.btn-delete{
    background:transparent;
    border:none;
    color:blue;
    cursor:pointer;
}
.filter-bar {
    display:flex; gap:1rem; margin-bottom:1rem;
}
.filter-bar input, .filter-bar select {
    padding:0.6rem 1rem; border-radius:8px;
    border:1px solid rgba(255,255,255,0.2);
    background:rgba(255,255,255,0.05); color:#fff;
    font-size:0.9rem; outline:none; transition:all 0.2s ease;
}
.filter-bar input:focus, .filter-bar select:focus {
    border-color:#4f46e5; box-shadow:0 0 8px rgba(79,70,229,0.4);
}
</style>

<div class="table-container">
    <div class="table-header">
        <div>
            <h2>Registered Teachers At {{ $school->schoolname }}</h2>
            <p class="table-subtitle">Manage active Teacher's accounts and course allocations</p>
        </div>
        <div class="table-badge-total">
            Total: <span>{{ $teacher->count() }}</span>
        </div>
    </div>

    <div class="filter-bar">
        <input type="text" id="searchInput" placeholder="Search by name...">
        <select id="courseFilter">
            <option value="">Filter by course</option>
            @foreach($courses as $course)
                <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Teacher Photo</th>
                    <th>Teacher Name</th>
                    <th>Assigned Course</th>
                    <th>Registration Date</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teacher as $t)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' .$t->image_path ) }}" class="image" alt="Photo of {{ $t->teacher_name }}">
                    </td>
                    <td>
                        <div class="student-profile-cell">
                            <div class="avatar-placeholder">
                                {{ strtoupper(substr($t->teacher_name, 0, 2)) }}
                            </div>
                            <span class="student-name">{{ $t->teacher_name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="course-tag">{{ $t->course ?? 'Unassigned' }}</span>
                    </td>
                    <td>
                        <span class="date-text">{{ $t->created_at ? $t->created_at->format('M d, Y') : 'No Date' }}</span>
                    </td>
                    <td class="text-right">
                        <a href="/{{ $t->id }}/teacher/edit" class="action-btn edit-btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="/{{ $t->id }}/teacher/delete" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" title="Delete">🗑</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
const searchInput = document.getElementById('searchInput');
const courseFilter = document.getElementById('courseFilter');
const rows = document.querySelectorAll('.custom-table tbody tr');

function filterTable() {
    let nameFilter = searchInput.value.toLowerCase();
    let courseFilterValue = courseFilter.value.toLowerCase();

    rows.forEach(row => {
        let name = row.querySelector('.student-name').textContent.toLowerCase();
        let course = row.querySelector('.course-tag').textContent.toLowerCase();

        let matchesName = name.includes(nameFilter);
        let matchesCourse = courseFilterValue === "" || course.includes(courseFilterValue);

        row.style.display = (matchesName && matchesCourse) ? '' : 'none';
    });
}

searchInput.addEventListener('keyup', filterTable);
courseFilter.addEventListener('change', filterTable);
</script>
</x-layout>
