# Plan: Restore Advanced FIDO Features Implementation

## Phase 1: UI Restoration
- [x] Task: Add "Advanced Settings" toggle and HTML structure to `index.php`.
- [x] Task: Add "Server Data Preview" container and toggle to `index.php`.
- [x] Task: Style the new sections to match the Fairline theme (hidden by default, nice transitions).
- [x] Task: Conductor - User Manual Verification 'Phase 1: UI Restoration' (Protocol in workflow.md)

## Phase 2: Logic Re-binding
- [ ] Task: Update `getGetParams()` in `index.php` to read from the restored inputs.
- [ ] Task: Ensure "Clear All" button functions correctly.
- [ ] Task: Verify that changing settings (e.g., User Verification) actually changes the WebAuthn API call arguments.
- [ ] Task: Conductor - User Manual Verification 'Phase 2: Logic Re-binding' (Protocol in workflow.md)
