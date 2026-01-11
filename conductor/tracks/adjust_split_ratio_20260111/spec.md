# Track Specification: Update Split-Screen Ratio to 2:1

## 1. Overview
The goal of this track is to refine the split-screen layout by adjusting the width ratio from 1:1 to 2:1. The Hero slider (left column) will now occupy approximately 66.6% of the screen width, while the Authentication interface (right column) will occupy 33.3%. This change aims to emphasize the visual branding while maintaining a clean, centered login experience.

## 2. Functional Requirements
*   **Ratio Adjustment:**
    *   Update CSS to set the left column (`.split-hero`) width to 66.6%.
    *   Update CSS to set the right column (`.split-auth`) width to 33.3%.
*   **Adaptive Layout:**
    *   Large screens (> 1200px): Maintain the 2:1 ratio.
    *   Medium screens (768px - 1200px): Revert to a 1:1 ratio for better legibility of the auth form.
    *   Small screens (< 768px): Maintain the current vertically stacked layout.
*   **Visual Centering:**
    *   Ensure the authentication card remains perfectly centered within its 33.3% container.
*   **Hero Image Scaling:**
    *   Ensure the Hero image background correctly covers the wider container without distortion or loss of focal point.

## 3. Non-Functional Requirements
*   **Performance:** No impact on asset loading.
*   **Visual Fidelity:** Maintain the premium theme and existing animations.

## 4. Acceptance Criteria
*   [ ] On large desktops (> 1200px), the left slider is twice as wide as the right auth column.
*   [ ] On medium screens (e.g., tablets in landscape), the layout switches to 50/50.
*   [ ] On mobile devices, the layout remains stacked.
*   [ ] The authentication card is correctly padded and centered in the narrower column.
*   [ ] No horizontal scrolling occurs on any viewport size.

## 5. Out of Scope
*   Content changes to the Hero slider.
*   Functional changes to WebAuthn logic.
