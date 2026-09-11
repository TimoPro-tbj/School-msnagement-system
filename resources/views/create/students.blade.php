<!-- Student Popup -->
<div id="student-popup" class="popup-overlay">
  <div class="popup-content">
    <a href="#" class="close-btn">&times;</a>
    <form action="/students/create/student" method="POST" class="popup-form" enctype="multipart/form-data">
      @csrf
      <h2>Enter Student Details</h2>

      <!-- Single Student Entry -->
      <div class="input-group">
        <label for="student-name">Student Name</label>
        <input type="text" id="student-name" name="name" required />
      </div>

      <div class="input-group">
        <label for="course-name">Student Course</label>
        <select id="course-name" name="course" required>
          <option value="">-- Available courses --</option>
          @foreach ($courses as $course)
            <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="input-group">
        <label for="images">Upload Image</label>
        <input type="file" id="images" name="image_path" accept="image/*">
      </div>

      <!-- Bulk Upload Students -->
      <h3>Bulk Upload Students</h3>
      <div class="input-group">
        <label for="bulk-file">Upload File (CSV, Excel, PDF)</label>
        <!-- Trigger button -->
        <button type="button" id="student-upload-trigger" class="upload-trigger">Upload File</button>
        <!-- Hidden file input -->
        <input type="file" id="bulk-file" name="bulk_file" accept=".csv,.xlsx,.xls,.pdf" style="display:none;">
      </div>

      <!-- Errors -->
      <div class="error-text">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>

      <button type="submit" class="submit-btn student-color">Submit Student</button>
    </form>
  </div>
</div>

<!-- Bulk Upload Reminder Popup -->
<div id="student-upload-popup" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
            background:rgba(0,0,0,0.6); align-items:center; justify-content:center; z-index:9999;">
  <div id="student-upload-box" style="background:#fff; padding:20px; border-radius:8px; width:350px; text-align:center; box-shadow:0 5px 15px rgba(0,0,0,0.3);">
    <h3 style="margin-bottom:10px;">Before You Upload Students</h3>
    <p>Your file must contain these columns:</p>
    <ul style="text-align:left; margin:10px 0; padding-left:20px;">
      <li><strong>name</strong></li>
      <li><strong>course</strong></li>
    </ul>
    <div style="margin-top:15px; display:flex; justify-content:space-between;">
      <button id="student-upload-cancel" style="padding:8px 12px; border:none; border-radius:6px; cursor:pointer; font-size:14px; background:#dc3545; color:#fff;">Cancel</button>
      <button id="student-upload-continue" style="padding:8px 12px; border:none; border-radius:6px; cursor:pointer; font-size:14px; background:#28a745; color:#fff;">Continue</button>
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

  .submit-btn.student-color {
    background: #28a745;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
    width: 100%;
  }
  .submit-btn.student-color:hover { background: #1e7e34; }
</style>

<!-- Script -->
<script>
  const studentTriggerBtn = document.getElementById('student-upload-trigger');
  const studentPopupReminder = document.getElementById('student-upload-popup');
  const studentCancelBtn = document.getElementById('student-upload-cancel');
  const studentContinueBtn = document.getElementById('student-upload-continue');
  const studentFileInput = document.getElementById('bulk-file');

  // Show popup only when button is clicked
  studentTriggerBtn.addEventListener('click', () => {
    studentPopupReminder.style.display = 'flex';
  });

  studentCancelBtn.addEventListener('click', () => {
    studentPopupReminder.style.display = 'none';
  });

  studentContinueBtn.addEventListener('click', () => {
    studentPopupReminder.style.display = 'none';
    studentFileInput.click(); // open file chooser
  });
</script>
