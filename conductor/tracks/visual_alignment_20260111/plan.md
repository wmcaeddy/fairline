# Plan: Fairline Visual Alignment

This plan outlines the steps to align the project's visual identity and user experience with `https://www.fairline.com.tw/`, excluding `_test/client.html`.

## Phase 1: Brand Asset Acquisition and Analysis [checkpoint: eff7598]
- [x] Task: Inspect `fairline.com.tw` to extract the primary/secondary color palette and typography (font families). [5de0790]
- [x] Task: Source and download the official logo and favicon from the reference site. [5de0790]
- [x] Task: Create an `assets/brand/` directory and organize the sourced assets. [5de0790]
- [x] Task: Conductor - User Manual Verification 'Brand Asset Acquisition and Analysis' (Protocol in workflow.md) [eff7598]

## Phase 2: Global Component Structure [checkpoint: 7f5a28d]
- [x] Task: Design and implement a responsive Header mirroring the reference site's navigation and layout. [814c58a]
- [x] Task: Design and implement a comprehensive Footer mirroring the reference site's contact info and links. [814c58a]
- [x] Task: Integrate the new Header and Footer into `index.php` and modern UI pages. [814c58a]
- [x] Task: Conductor - User Manual Verification 'Global Component Structure' (Protocol in workflow.md) [7f5a28d]

## Phase 3: Visual Styling Implementation
- [ ] Task: Define CSS variables for the new color palette and typography in a central stylesheet (e.g., `modern.css`).
- [ ] Task: Overhaul component styles (buttons, cards, forms) to match the "Look & Feel" of the reference site.
- [ ] Task: Apply the new global styles to `index.php`, ensuring high fidelity.
- [ ] Task: Conductor - User Manual Verification 'Visual Styling Implementation' (Protocol in workflow.md)

## Phase 4: Landing Page Overhaul
- [ ] Task: Restructure the content of `index.php` to follow the section hierarchy (About, News, etc.) of the reference site.
- [ ] Task: Implement the grid system and layout patterns used on `fairline.com.tw`.
- [ ] Task: Ensure the landing page is fully responsive and visually polished.
- [ ] Task: Conductor - User Manual Verification 'Landing Page Overhaul' (Protocol in workflow.md)

## Phase 5: Motion and Interaction
- [ ] Task: Implement smooth section transitions and scrolling animations consistent with the reference site.
- [ ] Task: Add hover states, menu transitions, and other interactive "feel" elements.
- [ ] Task: Final pass on animations to ensure a premium, high-fidelity experience.
- [ ] Task: Conductor - User Manual Verification 'Motion and Interaction' (Protocol in workflow.md)

## Phase 6: Final Verification and Cleanup
- [ ] Task: **CRITICAL**: Verify that `_test/client.html` remains completely untouched and functional.
- [ ] Task: Perform cross-browser and mobile responsiveness testing.
- [ ] Task: Conductor - User Manual Verification 'Final Verification and Cleanup' (Protocol in workflow.md)
