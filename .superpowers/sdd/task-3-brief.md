# Task 3: Add Photo Upload Handling to ProfileController

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
