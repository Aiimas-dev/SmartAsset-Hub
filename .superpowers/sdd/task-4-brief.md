# Task 4: Update Profile Blade Template for Photo Upload

**Files:**
- Modify: `resources\views\profile.blade.php:63-68` (Upload button)
- Modify: `resources\views\profile.blade.php:28-35` (Profile image display)

**Interfaces:**
- Consumes: User model with photo attribute
- Produces: Profile page with functional photo upload and preview

- [ ] **Step 1: Move Upload Foto button inside the form**

Find the Upload Foto button (around line 63-68) and move it inside the form element. The form starts at line 146. Place the button near the profile image section.

```html
<!-- Inside the form, after the profile image display -->
<div class="relative">
    <img id="photo-preview" 
         src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0ea5e9&color=fff' }}" 
         alt="{{ $user->name }}"
         class="w-32 h-32 rounded-full mx-auto">
    
    <input type="file" 
           name="photo" 
           id="photo-input" 
           accept="image/*" 
           class="hidden"
           onchange="previewImage(this)">
    
    <button type="button" 
            onclick="document.getElementById('photo-input').click()"
            class="mt-4 bg-gradient-to-r from-sky-500 to-cyan-500 text-white px-6 py-2 rounded-xl font-bold">
        📷 Upload Foto
    </button>
</div>
```

- [ ] **Step 2: Add JavaScript for image preview**

Add this script before the closing `</body>` tag:

```html
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photo-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
```

- [ ] **Step 3: Verify the change**

Read the file to confirm the photo upload functionality is added:
```bash
Read file: resources/views/profile.blade.php
```

Expected: The profile page now has a file input, upload button inside the form, and preview functionality

- [ ] **Step 4: Commit**

```bash
git add resources/views/profile.blade.php
git commit -m "feat: add photo upload with preview functionality to profile page"
```
