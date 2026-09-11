<!-- Course Popup -->
<div id="course-popup" class="popup-overlay">
  <div class="popup-content">
    <a href="#" class="close-btn">&times;</a>
    <form action="/courses/create/course" method="POST" class="popup-form" enctype="multipart/form-data">
      @csrf
      <h2>Enter Course Details</h2>

      <!-- Single Course Entry -->
      <div class="input-group">
        <label for="course-name">Course Name</label>
        <input type="text" id="course-name" name="course_name" required />
      </div>

      <!-- Bulk Upload Courses -->
      <h3>Bulk Upload Courses</h3>
      <div class="input-group">
        <label for="bulk-file">Upload File (CSV, Excel, PDF)</label>
        <!-- Trigger button -->
        <button type="button" id="course-upload-trigger" class="upload-trigger">Upload File</button>
        <!-- Hidden file input -->
        <input type="file" id="bulk-file" name="bulk_file" accept=".csv,.xlsx,.xls,.pdf" style="display:none;">
      </div>

      <!-- Errors -->
      <div class="error-text">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>

      <button type="submit" class="submit-btn course-color">Submit Course</button>
    </form>
  </div>
</div>

<!-- Bulk Upload Reminder Popup -->
<div id="course-upload-popup" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
            background:rgba(0,0,0,0.6); align-items:center; justify-content:center; z-index:9999;">
  <div style="background:#fff; padding:20px; border-radius:8px; width:350px; text-align:center; box-shadow:0 5px 15px rgba(0,0,0,0.3);">
    <h3 style="margin-bottom:10px;">Before You Upload Courses</h3>
    <p>Your file must contain this column:</p>
    <ul style="text-align:left; margin:10px 0; padding-left:20px;">
      <li><strong>course_name</strong></li>
    </ul>
    <div style="margin-top:15px; display:flex; justify-content:space-between;">
      <button id="course-upload-cancel" style="padding:8px 12px; border:none; border-radius:6px; cursor:pointer; font-size:14px; background:#dc3545; color:#fff;">Cancel</button>
      <button id="course-upload-continue" style="padding:8px 12px; border:none; border-radius:6px; cursor:pointer; font-size:14px; background:#28a745; color:#fff;">Continue</button>
    </div>
  </div>
</div>

<!-- Styling -->
<style>
  .upload-trigger {
    background: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s ease;
  }
  .upload-trigger:hover { background: #0056b3; }

  .error-text p {
    color: red;
    font-size: 14px;
    margin: 5px 0;
  }

  .submit-btn.course-color {
    background: #007bff;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
    width: 100%;
  }
  .submit-btn.course-color:hover { background: #0056b3; }
</style>

<!-- Script -->
<script>
  const courseTriggerBtn = document.getElementById('course-upload-trigger');
  const coursePopupReminder = document.getElementById('course-upload-popup');
  const courseCancelBtn = document.getElementById('course-upload-cancel');
  const courseContinueBtn = document.getElementById('course-upload-continue');
  const courseFileInput = document.getElementById('bulk-file');

  // Show popup only when button is clicked
  courseTriggerBtn.addEventListener('click', () => {
    coursePopupReminder.style.display = 'flex';
  });

  courseCancelBtn.addEventListener('click', () => {
    coursePopupReminder.style.display = 'none';
  });

  courseContinueBtn.addEventListener('click', () => {
    coursePopupReminder.style.display = 'none';
    courseFileInput.click(); // open file chooser
  });
</script>
