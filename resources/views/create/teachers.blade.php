<div id="teacher-popup" class="popup-overlay">
    <div class="popup-content">
        <a href="#" class="close-btn">&times;</a>
        <form action="/teachers/create/teacher" method="POST" class="popup-form" enctype="multipart/form-data">
            @csrf
            <h2>Enter Teacher Details</h2>

            <div class="input-group">
                <label for="teacher-name">Teacher Name</label>
                <input type="text" id="teacher-name" name="teacher_name" required />
            </div>

            <div class="input-group">
                <label for="course-name">Teacher Courses</label>
                <input type="text" id="course-name" name="course" list="course-list" placeholder="Enter course or select from available" required />
                <datalist id="course-list">
                    @if ($courses->isNotEmpty())
                        @foreach ($courses as $course)
                            <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
                        @endforeach
                    @endif
                </datalist>
            </div>

            <div class="input-group">
                <label for="images">Upload image</label>
                <input type="file" id="images" name="image_path" accept="image/*">
            </div>

            <div class="error-text">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>

            <button type="submit" class="submit-btn">Submit Teacher</button>
        </form>
    </div>
</div>
