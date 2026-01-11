# Plan: Legacy Table Layout Adaptation

## Phase 1: Modularize Legacy Structure
- [x] Task: Update `components/header.php` with the legacy table-based header and nav images.
- [x] Task: Update `components/hero.php` to use the legacy `idx0_Banner` HTML structure.
- [x] Task: Update `components/footer.php` with the legacy table-based footer.
- [ ] Task: Conductor - User Manual Verification 'Phase 1: Structure' (Protocol in workflow.md)

## Phase 2: Refactor Main Layout
- [x] Task: Update `index.php` to use the legacy centering table (`width="962"`) as the primary wrapper.
- [x] Task: Move current modular content sections (About, Brands, News) into the appropriate legacy table cells.
- [ ] Task: Conductor - User Manual Verification 'Phase 2: Layout' (Protocol in workflow.md)

## Phase 3: FIDO Integration
- [x] Task: Integrate the `.auth-card` and WebAuthn triggers into the legacy login area (top-right).
- [x] Task: Ensure all CSS for `.auth-card` is scoped correctly to not break the table layout.
- [ ] Task: Conductor - User Manual Verification 'Phase 3: FIDO Integration' (Protocol in workflow.md)

## Phase 4: Asset and CSS Alignment
- [x] Task: Fix all image paths to point to the `20260111141054139/` directory.
- [x] Task: Import `pronew.css` and `showcut.css` from the legacy folder.
- [ ] Task: Conductor - User Manual Verification 'Phase 4: Final Verification' (Protocol in workflow.md)
