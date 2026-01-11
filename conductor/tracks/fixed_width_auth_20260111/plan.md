# Implementation Plan - Adaptive Split-Screen with Fixed-Width Auth

This plan outlines the steps to adjust the layout to use a fixed-width for the authentication column, a fluid-width for the hero, and reorder them for mobile priority.

## Phase 1: CSS Refactoring for Desktop [checkpoint: 99e274b]
Goal: Implement the fixed/fluid split layout.

- [x] Task: Update the `.split-screen-container` CSS in `index.php` to use a non-wrapping flex layout by default for desktop. 99e274b
- [x] Task: Set `.split-auth` to a fixed width (e.g., `480px`) and prevent it from shrinking. 99e274b
- [x] Task: Set `.split-hero` to `flex: 1` to occupy the remaining space. 99e274b
- [x] Task: Conductor - User Manual Verification 'Fluid Layout' (Protocol in workflow.md) 99e274b

## Phase 2: Mobile Priority and Stacking [checkpoint: c664fb3]
Goal: Reorder sections for mobile devices.

- [x] Task: Update the 768px media query in `index.php` to use `flex-direction: column-reverse`. c664fb3
- [x] Task: Adjust mobile-specific padding to ensure the Auth box at the top looks cohesive with the header. c664fb3
- [x] Task: Ensure the Hero section below still functions correctly as a secondary visual element. c664fb3
- [x] Task: Conductor - User Manual Verification 'Mobile Reordering' (Protocol in workflow.md) c664fb3

## Phase 3: Final Verification
Goal: Final audit of visual and functional integrity.

- [ ] Task: Audit all WebAuthn buttons and states in the new layout.
- [ ] Task: Final audit of responsiveness and cross-browser alignment.
- [ ] Task: Conductor - User Manual Verification 'Final Audit' (Protocol in workflow.md)
