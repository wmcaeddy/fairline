# Track Specification: Implement Data Preview Toggle

## 1. Overview
The goal of this track is to port the "Toggle Data Preview" feature from the `master` branch into the current split-screen interface. This feature allow developers to inspect the stored WebAuthn data on the server directly from the landing page.

## 2. Functional Requirements
*   **Toggle Button:**
    *   Add a "Toggle Data Preview" button to the authentication card.
    *   Location: Positioned between the login/register buttons and the "Advanced Settings" toggle.
    *   Styling: Align with the current theme's secondary button style.
*   **Data Preview Container:**
    *   Implement the `#preview-container` element containing an `<iframe>` that loads `_test/server.php?fn=getStoredDataHtml`.
    *   The container should be hidden by default (`.hidden` class).
    *   When toggled, it should appear directly below the authentication card in the right column.
*   **Functionality Porting:**
    *   Ensure the `togglePreview()` JavaScript function is present and correctly toggles the container's visibility.
    *   Ensure the "Clear All" button within the preview container correctly calls the `clearRegistration()` function.
    *   Maintain the existing layout integrity when the preview is expanded.

## 3. Non-Functional Requirements
*   **Visual Consistency:** The preview container and button should match the current premium aesthetic.
*   **Mobile Responsiveness:** Ensure the preview container adapts correctly to the stacked mobile layout.

## 4. Acceptance Criteria
*   [ ] A "Toggle Data Preview" button is visible in the login card.
*   [ ] Clicking the button reveals/hides a container below the card.
*   [ ] The container displays the server's stored WebAuthn data via an iframe.
*   [ ] Clicking "Clear All" in the preview successfully triggers the data clearing flow.
*   [ ] The split-screen layout remains stable when the preview is shown.

## 5. Out of Scope
*   Adding new server-side functions.
*   Changing the data format returned by the server.
