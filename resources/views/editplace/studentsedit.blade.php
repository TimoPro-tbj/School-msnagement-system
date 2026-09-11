<x-layout>
    <style>
        .form-container {
            max-width: 800px; margin: 3rem auto; padding: 2.5rem;
            background: #fff; border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .form-header h2 { font-size: 1.75rem; color: #1f2937; margin-bottom: 2rem; }
        .form-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 3rem; }
        .avatar-section { display: flex; flex-direction: column; align-items: center; }
        #photo-preview {
            width: 150px; height: 150px; border-radius: 50%;
            object-fit: cover; border: 4px solid #f3f4f6; margin-bottom: 1.5rem;
        }
        .custom-upload {
            padding: 0.6rem 1.2rem; background: #2563eb; color: white;
            border-radius: 6px; cursor: pointer; font-size: 0.875rem; font-weight: 500;
        }
        .form-group { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.5rem; }
        input[type="text"], input[type="date"] {
            padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px;
        }
        .btn-save {
            background: #16a34a; color: white; padding: 0.75rem 2rem;
            border: none; border-radius: 6px; cursor: pointer; font-weight: 600;
        }
    </style>

    <div class="form-container">
        <div class="form-header"><h2>Edit Student: {{ $student->name }}</h2></div>

        <form action="/{{  $student->id }}/student/update" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-grid">
                <div class="avatar-section">
                    <img src="{{ asset('storage/' . $student->image_path) }}" id="photo-preview">
                    <label class="custom-upload">Change Photo
                        <input type="file" name="image_path" class="hidden" hidden onchange="previewImage(event)">
                    </label>
                </div>

                <div class="input-section">
                    <div class="form-group">
                        <label>Student Name</label>
                        <input type="text" name="name" value="{{ old('name', $student->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Registration Date</label>
                        <input type="date" name="created_at" value="{{ old('created_at', $student->created_at )}}" required>
                    </div>
                    <div class="form-group">
                        <label>Assigned Course</label>
                        <input type="text" name="course" value="{{ old('course', $student->course) }}" required>
                    </div>
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = (e) => document.getElementById('photo-preview').src = e.target.result;
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layout>
