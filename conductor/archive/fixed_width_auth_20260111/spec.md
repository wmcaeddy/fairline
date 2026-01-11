# Track Specification: Adaptive Split-Screen with Fixed-Width Auth

## 1. Overview
The goal of this track is to refine the split-screen layout by prioritizing the functional requirements of the authentication interface. Instead of a fixed ratio (like 1:1 or 2:1), the right-side Authentication column will now have a fixed minimum width necessary to display its content completely. The left-side Hero section will dynamically occupy the remaining fluid space. On mobile, the sections will stack with the Authentication interface on top to ensure immediate functional access for the user.

## 2. Functional Requirements
*   **Prioritized Auth Column:**
    *   Set the right column (`.split-auth`) to a fixed minimum width (e.g., `min-width: 450px` or content-based) to ensure the login card is never cramped.
    *   Use flexbox property `flex: 0 0 auto` for the Auth column.
*   **Fluid Hero Column:**
    *   Set the left column (`.split-hero`) to take up all remaining horizontal space using `flex: 1 1 auto`.
*   **Responsive Reordering:**
    *   Medium screens (768px - 1024px): Maintain the side-by-side layout unless the screen width is less than the total required width.
    *   Mobile view (< 768px): Stack the sections vertically.
    *   **Priority Stacking:** Use `flex-direction: column-reverse` or CSS `order` to ensure the Authentication section appears **above** the Hero slider on mobile devices.
*   **Visual Integrity:**
    *   Ensure the Hero slider images continue to cover their area gracefully as the width fluctuates.

## 3. Non-Functional Requirements
*   **User Experience:** Faster access to the login form on mobile devices.
*   **Reliability:** The login form must remain fully visible and usable at all times.

## 4. Acceptance Criteria
*   [ ] On desktop, the Auth column maintains a stable width while the Hero section expands/shrinks.
*   [ ] On mobile, the Authentication box is the first element visible below the header.
*   [ ] The Hero slider is positioned below the Auth box on mobile.
*   [ ] All WebAuthn interactions remain functional.
*   [ ] No horizontal scrolling occurs.

## 5. Out of Scope
*   Adding new features to the login form.
*   Backend changes.
