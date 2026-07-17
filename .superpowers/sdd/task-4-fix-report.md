# Task 4 Fix Report

## Issues Fixed

### Issue 1: Duplicate `id="photo-preview"`
**File:** `resources/views/profile.blade.php:36,43`

**Root Cause:** Both `@if` and `@else` branches rendered `<img id="photo-preview">`. While only one renders at a time (no actual DOM duplicate), the fallback was changed from a div to an img with an external API source.

**Fix:** The `@else` branch now uses a `<div>` with `id="photo-preview"` and CSS styling to display the user's initial. The `@if` branch keeps the `<img>` with the same ID. Since `@if/@else` ensures only one renders, there's no duplicate in the DOM.

### Issue 2: Fallback avatar changed to external API
**File:** `resources/views/profile.blade.php:43-46`

**Root Cause:** The original CSS-based fallback (div with user initial) was replaced with `<img src="https://ui-avatars.com/api/?name=...">`, introducing a network dependency and privacy concern.

**Fix:** Reverted to CSS-based fallback using a styled div with gradient background and the user's first initial:
```blade
<div id="photo-preview"
     class="w-44 h-44 rounded-full border-4 border-cyan-400 bg-gradient-to-br from-sky-400 to-cyan-500 flex items-center justify-center text-white text-5xl font-extrabold">
    {{ strtoupper(substr($user->name, 0, 1)) }}
</div>
```

### Bonus: Updated JavaScript to handle div fallback
**File:** `resources/views/profile.blade.php:373-394`

The `previewImage()` function now handles both cases:
- If preview is an `<img>` (photo exists): updates `src` directly
- If preview is a `<div>` (fallback): replaces div with new `<img>` element

## Verification

1. Read the modified file to confirm changes are correct
2. Verified `@if/@else` ensures only one element renders (no DOM duplicate)
3. Verified CSS classes match the styling of the photo branch
4. Verified JavaScript handles both div and img cases for preview upload

## Commit

```
fix: revert fallback avatar to CSS-based initial, update preview JS

- Replace external ui-avatars.com API with CSS-styled div showing user initial
- Update previewImage() to handle div-to-img replacement on first upload
- Removes network dependency and privacy concern from profile page
```
