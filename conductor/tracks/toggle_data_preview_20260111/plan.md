# Implementation Plan - Implement Data Preview Toggle

This plan outlines the steps to port the data preview functionality to the current interface.

## Phase 1: Implementation
Goal: Add the button, container, and logic.

- [ ] Task: Add the "Toggle Data Preview" button to `index.php` inside the `.btn-group-vertical`.
- [ ] Task: Add the `#preview-container` HTML structure to `index.php` below the authentication card wrapper.
- [ ] Task: Update `assets/theme/js/webauthn.js` to ensure `togglePreview()` and `clearRegistration()` logic is robust and matches the requirements.
- [ ] Task: Conductor - User Manual Verification 'Implementation' (Protocol in workflow.md)

## Phase 2: Styling and Refinement
Goal: Ensure the new elements look good and work on all devices.

- [ ] Task: Style the toggle button to match `.btn-theme-secondary` but perhaps smaller or distinct.
- [ ] Task: Style the preview container to look like a card consistent with the theme.
- [ ] Task: Verify mobile responsiveness of the preview iframe.
- [ ] Task: Conductor - User Manual Verification 'Styling' (Protocol in workflow.md)
