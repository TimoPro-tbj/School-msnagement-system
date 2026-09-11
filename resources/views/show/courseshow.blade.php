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
}

    </style>

<div class="table-container">
    <div class="table-header">
        <div>
            <h2>Registered Courses At {{ $school->schoolname}}</h2>
            <p class="table-subtitle">Manage active Courses</p>
        </div>
        <div class="table-badge-total">
            Total: <span>{{ $course->count() }}</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($course as $course)
                <tr>

                    <td>
                        <div class="student-profile-cell">
                            <span class="student-name">{{ $course->course_name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="date-text">{{ $course->created_at  ?? 'No Date' }}</span>
                    </td>
                    <td class="text-right">
                        <a href="/{{ $course->id }}/course/edit" class="action-btn edit-btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </td>
                  <td class="action-buttons">
                      <form action="/{{$course->id}}/course/delete" method="POST" onsubmit="return confirm('Are you sure?');">
                               @csrf
                              @method('DELETE')
                               <button type="submit" class="btn-delete" title="Delete">
                                   <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                      <polyline points="3 6 5 6 21 6"></polyline>
                                     <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                               </button>
                        </form>
                   </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-layout>
