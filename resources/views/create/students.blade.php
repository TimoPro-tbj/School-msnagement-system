<div id="student-popup" class="popup-overlay">
    <div class="popup-content">
        <a href="#" class="close-btn">&times;</a>
        <form action="/students/create/student" method="POST" class="popup-form" enctype="multipart/form-data">
            @csrf
            <h2>Enter Student Details</h2>

            <div class="input-group">
                <label for="student-name">Student Name</label>
                <input type="text" id="student-name" name="name" required />
            </div>

            <div class="input-group">
                <label for="student-course">Student Course</label>
                <input type="text" id="student-course" name="course" list="course-list" placeholder="Select Course" />
                <datalist id="course-list">
                    @if(isset($courses) && $courses->isNotEmpty())
                        @foreach ($courses as $course)
                            <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
                        @endforeach
                    @endif
                </datalist>
            </div>

            <div class="input-group">
                <label for="images">Upload Image</label>
                <input type="file" id="images" name="image_path" accept="image/*">
            </div>

            <button type="submit" class="submit-btn student-color">Submit Student</button>
        </form>
    </div>
</div>
