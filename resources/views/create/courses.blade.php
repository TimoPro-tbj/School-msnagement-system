<div id="course-popup" class="popup-overlay">
    <div class="popup-content">
        <a href="#" class="close-btn">&times;</a>
        <form action="/courses/create/course" method="POST" class="popup-form">
            @csrf
            <h2>Enter Course Details</h2>

            <div class="input-group">
                <label for="course-name">Course Name</label>
                <input type="text" id="course-name" name="course_name" required />
            </div>

            <button type="submit" class="submit-btn course-color">Submit Course</button>
        </form>
    </div>
</div>
