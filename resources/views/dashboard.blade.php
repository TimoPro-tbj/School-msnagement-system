<x-layout>
    <style>
        

        

        .dashboard-header {
            position: relative;
            z-index: 1;
            padding: 3.5rem 4rem 1rem 4rem;
        }

        .dashboard-header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.75px;
            color: var(--text-primary);
            background: linear-gradient(135deg, #ffffff 60%, #a1a1aa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dashboard-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
            padding: 2rem 4rem;
        }

        .stat-card-card-teachers,
        .card-students,
        .card-courses {
            background: var(--card-glass);
            border: 1px solid var(--border-glow);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transition: border-color 0.4s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease;
        }

        .stat-card-card-teachers::before,
        .card-students::before,
        .card-courses::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 140px;
            height: 140px;
            background: radial-gradient(circle at top right, rgba(111, 78, 55, 0.12), transparent 70%);
            pointer-events: none;
        }

        .stat-card-card-teachers:hover,
        .card-students:hover,
        .card-courses:hover {
            border-color: rgba(111, 78, 55, 0.35);
            transform: translateY(-6px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(111, 78, 55, 0.05);
        }

        .view-icon {
            align-self: flex-start;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .view-icon a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem;
            text-decoration: none;
        }

        .view-icon svg {
            color: var(--text-secondary);
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .stat-card-card-teachers:hover .view-icon,
        .card-students:hover .view-icon,
        .card-courses:hover .view-icon {
            background: rgba(111, 78, 55, 0.15);
            border-color: rgba(111, 78, 55, 0.3);
        }

        .stat-card-card-teachers:hover .view-icon svg,
        .card-students:hover .view-icon svg,
        .card-courses:hover .view-icon svg {
            color: #fdd8a5;
            transform: translateX(2px);
        }

        .card-title {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 0.6rem;
        }

        .card-value {
            font-size: 2.75rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 2rem;
            letter-spacing: -1px;
        }

        .card-action-btn {
            text-decoration: none;
            text-align: center;
            background: linear-gradient(135deg, #1e120a 0%, #110905 100%);
            color: #e2d4c9;
            border: 1px solid rgba(111, 78, 55, 0.25);
            padding: 0.85rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-action-btn:hover {
            background: linear-gradient(135deg, var(--coffee-primary) 0%, #4a2c11 100%);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 12px 24px rgba(111, 78, 55, 0.35);
        }

        @media (max-width: 968px) {
            .nav-container {
                padding: 1.5rem 2rem;
            }
            .dashboard-header {
                padding: 3rem 2rem 0.5rem 2rem;
            }
            .dashboard-grid {
                padding: 1.5rem 2rem;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1.5rem;
                align-items: flex-start;
            }
            .lenks {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 12rem;
            }
            .dashboard-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
  @include('partials.navbar')
  
    <div class="dashboard-header">
        <h1>School Overview Dashboard</h1>
    </div>

    <div class="dashboard-grid">

        <div class="stat-card-card-teachers">
            <div class="view-icon">
                <a href="/teachers/show">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            <div>
                <div class="card-title">Total Teachers</div>
                <div class="card-value">{{ $teachersCount }}</div>
            </div>
            <a href="#teacher-popup" class="card-action-btn">+ Add Teacher</a>
        </div>

        <div class="card-students">
            <div class="view-icon">
                <a href="/students/show">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            <div>
                <div class="card-title">Total Students</div>
                <div class="card-value">{{ $studentsCount }}</div>
            </div>
            <a href="#student-popup" class="card-action-btn">+ Add Student</a>
        </div>

        <div class="card-courses">
            <div class="view-icon">
                <a href="/courses/show">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            <div>
                <div class="card-title">Active Courses</div>
                <div class="card-value">{{ $coursesCount }}</div>
            </div>
            <a href="#course-popup" class="card-action-btn">+ Add Course</a>
        </div>

    </div>
<div class="card-grid">
    @include('create.teachers')
    @include('create.courses')
    @include('create.students')
</div>

</x-layout>

