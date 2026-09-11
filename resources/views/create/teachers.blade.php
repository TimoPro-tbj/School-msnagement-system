<div id="teacher-popup" class="popup-overlay">
  <div class="popup-content">
    <a href="#" class="close-btn">&times;</a>
    <form action="/teachers/create/teacher" method="POST" class="popup-form" enctype="multipart/form-data">
      @csrf
      <h2>Enter Teacher Details</h2>

      <div class="input-group">
        <label for="teacher-name">Teacher Name</label>
        <input type="text" id="teacher-name" name="teacher_name" placeholder="Enter teacher name" required />
      </div>

      <div class="input-group">
        <label for="course-name">Teacher Course</label>
        <select id="course-name" name="course" required>
          <option value="">-- Available courses --</option>
          @foreach ($courses as $course)
            <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="input-group">
        <label for="email">Teacher's Contact (Email)</label>
        <input type="email" id="email" name="email" placeholder="Enter teacher email" required />
      </div>

      <div class="input-group">
        <label for="images">Upload Image</label>
        <input type="file" id="images" name="image_path" accept="image/*">
      </div>

      <h3>Bulk Upload Teachers</h3>
      <div class="input-group">
        <label for="bulk-file">Upload File (CSV, Excel, PDF)</label>
        <button type="button" id="teacher-upload-trigger" class="upload-trigger">Upload File</button>
        <input type="file" id="bulk-file" name="bulk_file" accept=".csv,.xlsx,.xls,.pdf" style="display:none;">
      </div>

      <div class="error-text">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>

      <button type="submit" class="submit-btn teacher-color">Submit Teacher</button>
    </form>
  </div>
</div>

<div id="teacher-upload-popup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); align-items:center; justify-content:center; z-index:9999;">
  <div style="background:#fff; padding:20px; border-radius:8px; width:380px; text-align:center; box-shadow:0 5px 15px rgba(0,0,0,0.3);">
    <h3 style="margin-bottom:10px;">Before You Upload Teachers</h3>
    <p>Your file must contain these columns:</p>
    <ul style="text-align:left; margin:10px 0; padding-left:20px;">
      <li><strong>teacher_name</strong></li>
      <li><strong>course</strong></li>
      <li><strong>email</strong> (optional but recommended)</li>
    </ul>
    <div style="margin-top:15px; display:flex; justify-content:space-between;">
      <button id="teacher-upload-cancel" style="padding:8px 12px; border:none; border-radius:6px; cursor:pointer; font-size:14px; background:#dc3545; color:#fff;">Cancel</button>
      <button id="teacher-upload-continue" style="padding:8px 12px; border:none; border-radius:6px; cursor:pointer; font-size:14px; background:#28a745; color:#fff;">Continue</button>
    </div>
  </div>
</div>

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
  .error-text p { color: red; font-size: 14px; margin: 5px 0; }
  .submit-btn.teacher-color {
    background: #6f42c1;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
    width: 100%;
  }
  .submit-btn.teacher-color:hover { background: #59359c; }
</style>

<script>
  const teacherTriggerBtn = document.getElementById('teacher-upload-trigger');
  const teacherPopupReminder = document.getElementById('teacher-upload-popup');
  const teacherCancelBtn = document.getElementById('teacher-upload-cancel');
  const teacherContinueBtn = document.getElementById('teacher-upload-continue');
  const teacherFileInput = document.getElementById('bulk-file');

  teacherTriggerBtn.addEventListener('click', () => {
    teacherPopupReminder.style.display = 'flex';
  });
  teacherCancelBtn.addEventListener('click', () => {
    teacherPopupReminder.style.display = 'none';
  });
  teacherContinueBtn.addEventListener('click', () => {
    teacherPopupReminder.style.display = 'none';
    teacherFileInput.click();
  });
</script>
