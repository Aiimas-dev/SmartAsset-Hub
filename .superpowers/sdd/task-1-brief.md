# Task 1: Fix Birth Date Update in User Model

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
