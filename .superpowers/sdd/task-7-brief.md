# Task 7: Test Profile Features

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
