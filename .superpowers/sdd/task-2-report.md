# Task 2: Update ProfileController to Use update() Method

## What I Implemented

Replaced manual property assignment with `$user->update()` method in `ProfileController::update()` for more reliable persistence. The password handling was also updated to use `$user->save()` only when password is changed (since `update()` already saves the model).

## What I Tested

- Ran the focused `birth date can be updated via profile form` test: **PASS**
- Ran the full profile test suite: 5/6 pass (1 pre-existing failure unrelated to this change)
- Ran the full test suite: 50/53 pass (3 pre-existing failures, all Livewire Volt component issues)

## Files Changed

- `app/Http/Controllers/ProfileController.php`: Lines 51-65 — replaced manual property assignment with `$user->update()` array, moved password `$user->save()` inside the password check conditional

## Self-Review Findings

No issues. The change is minimal and focused:
- `$user->update([...])` saves the model, so the unconditional `$user->save()` was removed
- Password save is conditional and only triggers when a new password is provided
- The code follows the exact pattern specified in the task brief
