# Specification: ProNew Branding and Split-Screen Layout Implementation

## Overview
This track aims to implement a new modern, split-screen layout for the WebAuthn server's main page, using branding elements from the "ProNew" design (provided in the `20260111141054139` folder). This will replace the current Fairline-themed `index.php`.

## Functional Requirements
1.  **Split-Screen Layout:** Implement a responsive split-screen design.
    -   **Left Side (Branding):** Showcases ProNew branding, including the logo, hero images (from `main_*.jpg`), and a brief description.
    -   **Right Side (Authentication):** Contains the FIDO (WebAuthn) registration and login forms.
2.  **WebAuthn Integration:** 
    -   Integrate existing JavaScript logic for `createRegistration` and `checkRegistration`.
    -   Maintain the "Advanced Settings" and "Server Data Preview" features.
    -   Implement the "Authenticated User" view (avatar, user info, logout button).
3.  **Responsive Design:**
    -   On mobile devices, the branding side (left) should be hidden to prioritize the authentication flow.
4.  **Asset Migration:** Use the images and color palette from the `20260111141054139` folder.

## Non-Functional Requirements
-   **Performance:** Optimize image loading for the hero section.
-   **User Experience:** Smooth transitions between login and authenticated states (fade effects).
-   **Visual Fidelity:** Match the "ProNew" aesthetic (colors: likely #841852 or similar from `pronew.css`).

## Acceptance Criteria
-   `index.php` displays the ProNew branding on the left and FIDO forms on the right.
-   Registration and Login flows function correctly.
-   The page is responsive and usable on mobile.
-   The "Authenticated" state correctly displays user information and allows logout.

## Out of Scope
-   The full table-based layout from `20260111141054139/index.html` (only branding elements will be extracted).
-   Changes to the backend `server.php` logic (unless required for integration).
