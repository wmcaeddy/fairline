# Implementation Plan - Split-Screen Ratio Adjustment (2:1)

This plan outlines the steps to adjust the layout ratio of the landing page from 1:1 to 2:1, with adaptive breakpoints for medium and small screens.

## Phase 1: CSS Refactoring
Goal: Implement the 2:1 ratio and responsive breakpoints.

- [ ] Task: Update the CSS in `index.php` to set `.split-hero` to 66.6% and `.split-auth` to 33.3% by default.
- [ ] Task: Add a media query for medium screens (768px to 1200px) to set the ratio back to 50/50.
- [ ] Task: Verify that the existing 768px media query correctly handles the vertical stacking.
- [ ] Task: Conductor - User Manual Verification 'Ratio Adjustment' (Protocol in workflow.md)

## Phase 2: Visual Polish and Centering
Goal: Ensure the auth card and hero images look perfect in the new ratio.

- [ ] Task: Refine the padding of `.split-auth` to ensure the card doesn't feel cramped in the 33.3% width.
- [ ] Task: Confirm that the Hero images use `background-size: cover` effectively for the wider 66.6% area.
- [ ] Task: Conductor - User Manual Verification 'Visual Integrity' (Protocol in workflow.md)
