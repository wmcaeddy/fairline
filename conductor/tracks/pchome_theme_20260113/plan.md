# Plan: PChome Theme Integration (pchome_theme_20260113)

## Phase 1: Foundation & Styling Assets [checkpoint: d1add22]
*Goal: Prepare the necessary CSS and structural updates to support the PChome theme.*

- [x] **Task 1: Define PChome Design System**
    - [x] Create a new CSS file `assets/css/pchome.css` or update `assets/css/modern.css` with PChome color variables (#ec2c22, etc.).
    - [x] Import PChome-appropriate fonts if possible or map existing ones.
- [x] **Task 2: Refactor Header and Footer Components**
    - [x] Update `components/header.php` to match PChome's top navigation bar style.
    - [x] Update `components/footer.php` to match PChome's footer style (site map, links placeholders).
- [x] Task: Conductor - User Manual Verification 'Phase 1: Foundation & Styling Assets' (Protocol in workflow.md)

## Phase 2: Main Layout Re-skinning
*Goal: Apply the PChome visual identity to the split-screen layout.*

- [x] **Task 1: Branding Section (Left Side)**
    - [x] Update `components/hero.php` or the main layout to include PChome-style promotional banners or category navigation placeholders.
    - [x] Ensure the branding section feels like the PChome landing environment.
- [x] **Task 2: Responsive Adjustments**
    - [ ] Verify that the PChome-styled layout maintains proper priority on mobile (auth box on top).
- [~] Task: Conductor - User Manual Verification 'Phase 2: Main Layout Re-skinning' (Protocol in workflow.md)

## Phase 3: Authentication Box Styling
*Goal: Replicate the PChome login box for WebAuthn functions.*

- [x] **Task 1: Standard PChome Login Box UI**
    - [x] Style the authentication container (right side) as a white card with grey borders.
    - [x] Implement the large red primary buttons for "Register" and "Login" actions.
- [x] **Task 2: FIDO2 Interaction Styling**
    - [ ] Ensure WebAuthn status messages and "Show Server Data" toggle fit the PChome aesthetic.
- [~] Task: Conductor - User Manual Verification 'Phase 3: Authentication Box Styling' (Protocol in workflow.md)

## Phase 4: Functional Verification & TDD
*Goal: Ensure the new theme hasn't broken the WebAuthn logic.*

- [x] **Task 1: Write Tests for Auth Flow with New UI**
    - [x] Add tests to verify that registration and login buttons/forms are correctly identified and functional in the new DOM structure.
- [x] **Task 2: Final Integration and Bug Fixes**
    - [ ] Fix any visual regressions or functional breaks caused by the theme change.
- [~] Task: Conductor - User Manual Verification 'Phase 4: Functional Verification & TDD' (Protocol in workflow.md)
