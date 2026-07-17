# Task 5: Fix Date Format in Profile Blade Template

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
