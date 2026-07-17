# Task 6: Create Storage Symlink

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
