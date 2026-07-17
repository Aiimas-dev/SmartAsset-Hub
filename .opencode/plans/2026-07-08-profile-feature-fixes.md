# Profile Feature Fixes Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Fix two critical bugs in the profile feature: birth date not updating and profile photo upload not working.

**Architecture:** Modify the User model to fix date casting, update the ProfileController to handle photo uploads and use proper update methods, and enhance the profile blade template with file input and JavaScript preview functionality.

**Tech Stack:** Laravel, PHP, Blade templates, JavaScript, HTML5 File API

## Global Constraints

- Laravel framework (existing codebase)
- Must maintain backward compatibility with existing user data
- Follow existing code patterns and conventions
- Ensure storage directory exists and is writable
- Run `php artisan storage:link` to create public storage symlink

---

## File Structure

### Files to Modify:
1. `app\Models\User.php` - Remove date cast from birth_date
2. `app\Http\Controllers\ProfileController.php` - Add photo upload handling and use update() method
3. `resources\views\profile.blade.php` - Add file input, move upload button, add JavaScript preview

### Files to Create:
None (all changes are modifications to existing files)

---

## Task 1: Fix Birth Date Update in User Model

**Files:**
- Modify: `app\Models\User.php:37`

**Interfaces:**
- Consumes: User model with date cast
- Produces: User model without problematic date cast

- [ ] **Step 1: Remove date cast from birth_date**

```php
// Before (line 37)
'birth_date' => 'date',

// After - Remove this line entirely
```

- [ ] **Step 2: Verify the change**

Read the file to confirm the line is removed:
```bash
Read file: app/Models/User.php
```

Expected: The `$casts` array no longer contains `'birth_date' => 'date'`

- [ ] **Step 3: Commit**

```bash
git add app/Models/User.php
git commit -m "fix: remove date cast from birth_date to prevent dirty detection issues"
```

---

## Task 2: Update ProfileController to Use update() Method

**Files:**
- Modify: `app\Http\Controllers\ProfileController.php:52-57`

**Interfaces:**
- Consumes: User model with fillable attributes
- Produces: ProfileController that uses update() method for reliable persistence

- [ ] **Step 1: Replace manual assignment with update() method**

```php
// Before (lines 52-57)
$user->name = $validated['name'];
$user->email = $validated['email'];
$user->phone = $validated['phone'] ?? null;
$user->gender = $validated['gender'] ?? null;
$user->birth_date = $validated['birth_date'] ?? null;
$user->address = $validated['address'] ?? null;

// After
$user->update([
    'name' => $validated['name'],
    'email' => $validated['email'],
    'phone' => $validated['phone'] ?? null,
    'gender' => $validated['gender'] ?? null,
    'birth_date' => $validated['birth_date'] ?? null,
    'address' => $validated['address'] ?? null,
]);
```

- [ ] **Step 2: Verify the change**

Read the file to confirm the update method is used:
```bash
Read file: app/Http/Controllers/ProfileController.php
```

Expected: The controller now uses `$user->update()` instead of manual property assignment

- [ ] **Step 3: Commit**

```bash
git add app/Http/Controllers/ProfileController.php
git commit -m "fix: use update() method for reliable profile persistence"
```

---

## Task 3: Add Photo Upload Handling to ProfileController

**Files:**
- Modify: `app\Http\Controllers\ProfileController.php:25-67`

**Interfaces:**
- Consumes: User model with photo attribute, Storage facade
- Produces: ProfileController that handles photo uploads with validation and storage

- [ ] **Step 1: Add Storage facade import**

```php
// At the top of the file, add this import
use Illuminate\Support\Facades\Storage;
```

- [ ] **Step 2: Add photo validation rule**

```php
// In the validation rules array (around lines 29-49), add:
'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```

- [ ] **Step 3: Add photo upload logic after validation**

```php
// After the validation and before the $user->update() call, add:
if ($request->hasFile('photo')) {
    // Delete old photo if exists
    if ($user->photo) {
        Storage::disk('public')->delete($user->photo);
    }
    
    // Store new photo
    $photo = $request->file('photo')->store('photos', 'public');
    $user->photo = $photo;
}
```

- [ ] **Step 4: Verify the change**

Read the file to confirm the photo handling logic is added:
```bash
Read file: app/Http/Controllers/ProfileController.php
```

Expected: The controller now includes photo validation and storage logic

- [ ] **Step 5: Commit**

```bash
git add app/Http/Controllers/ProfileController.php
git commit -m "feat: add photo upload handling with validation and storage"
```

---

## Task 4: Update Profile Blade Template for Photo Upload

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

---

## Task 5: Fix Date Format in Profile Blade Template

**Files:**
- Modify: `resources\views\profile.blade.php:245-249`

**Interfaces:**
- Consumes: User model with birth_date attribute
- Produces: Profile page with properly formatted date input

- [ ] **Step 1: Update date input value format**

```php
// Before (lines 245-249)
<input type="date" name="birth_date" value="{{ $user->birth_date }}" ...>

// After
<input type="date" name="birth_date" 
       value="{{ old('birth_date', $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') : '') }}" 
       ...>
```

- [ ] **Step 2: Verify the change**

Read the file to confirm the date format is updated:
```bash
Read file: resources/views/profile.blade.php
```

Expected: The date input now uses proper Y-m-d format with old() helper

- [ ] **Step 3: Commit**

```bash
git add resources/views/profile.blade.php
git commit -m "fix: update date input format for birth_date field"
```

---

## Task 6: Create Storage Symlink

**Files:**
- None (command execution only)

**Interfaces:**
- Consumes: Laravel artisan command
- Produces: Public storage symlink for photo access

- [ ] **Step 1: Run storage:link command**

```bash
php artisan storage:link
```

Expected: Symlink created successfully at public/storage

- [ ] **Step 2: Verify symlink exists**

```bash
ls -la public/storage
```

Expected: Symlink points to storage/app/public

- [ ] **Step 3: No commit needed for this task**

---

## Task 7: Test Profile Features

**Files:**
- None (testing only)

**Interfaces:**
- Consumes: Fixed profile functionality
- Produces: Verified working profile features

- [ ] **Step 1: Test birth date update**

1. Login to the application
2. Navigate to profile page
3. Change the birth date field
4. Click save/update button
5. Refresh the page
6. Verify the birth date has changed

- [ ] **Step 2: Test photo upload**

1. Navigate to profile page
2. Click "Upload Foto" button
3. Select an image file (JPEG, PNG, JPG, or GIF, max 2MB)
4. Verify preview appears
5. Click save/update button
6. Refresh the page
7. Verify the new photo is displayed

- [ ] **Step 3: Test validation**

1. Try uploading a non-image file (should fail)
2. Try uploading an image larger than 2MB (should fail)
3. Try uploading without selecting a file (should work, no photo change)

- [ ] **Step 4: Verify storage**

1. Check that photos are stored in `storage/app/public/photos/`
2. Check that old photos are deleted when new ones are uploaded

---

## Task 8: Final Verification and Cleanup

**Files:**
- None (verification only)

**Interfaces:**
- Consumes: All previous tasks completed
- Produces: Working profile feature with both bugs fixed

- [ ] **Step 1: Run all tests**

```bash
php artisan test
```

Expected: All tests pass

- [ ] **Step 2: Verify no regressions**

Test other profile functionality:
- Name update
- Email update
- Phone update
- Gender update
- Address update
- Password update (if applicable)

- [ ] **Step 3: Check for any linting or code style issues**

```bash
./vendor/bin/phpcs app/Http/Controllers/ProfileController.php
```

- [ ] **Step 4: Final commit if needed**

```bash
git add .
git commit -m "chore: final verification and cleanup for profile fixes"
```

---

## Success Criteria

1. ✅ Birth date changes persist after form submission
2. ✅ Photo upload button triggers file selection
3. ✅ Selected photo displays as preview
4. ✅ Photo is stored in `storage/app/public/photos/`
5. ✅ Old photos are cleaned up when new ones are uploaded
6. ✅ Validation rules prevent invalid file uploads
7. ✅ All existing profile functionality continues to work

## Risk Considerations

- **Storage Space**: Photo uploads will consume disk space. Monitor usage.
- **File Size**: The 2MB limit is reasonable for profile photos.
- **Security**: The `image` validation rule ensures only image files are uploaded.
- **Performance**: Photo uploads may be slow on poor connections. Consider adding loading indicators in future.
