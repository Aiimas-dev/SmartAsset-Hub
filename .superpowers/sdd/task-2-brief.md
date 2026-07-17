# Task 2: Update ProfileController to Use update() Method

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
