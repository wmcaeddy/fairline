# Track Specification: Enable Usernameless Login (Discoverable Credentials)

## 1. Overview
The goal of this track is to modify the login flow to support Usernameless Authentication (Discoverable Credentials). Currently, the interface enforces a mandatory username field for both registration and login. The requirement is to relax this constraint for **Login only**, allowing users to authenticate with a passkey without manually typing their username. The username/ID fields will remain mandatory for Registration.

## 2. Functional Requirements
*   **Registration Flow:**
    *   Maintain existing validation: User Name and Display Name are **REQUIRED**.
*   **Login Flow:**
    *   Remove client-side validation that requires a non-empty User Name.
    *   If the User Name field is empty, the `checkRegistration()` function should initiate a WebAuthn `get()` call with an empty or null `allowCredentials` list (indicating a discoverable credential request).
    *   If the User Name field is NOT empty, the flow should proceed as a standard non-discoverable credential login (using the username to fetch specific credential ID).
*   **Backend Interaction:**
    *   Ensure the `server.php?fn=getGetArgs` call handles missing usernames correctly (likely by returning an empty `allowCredentials` array).

## 3. Non-Functional Requirements
*   **UX:** The transition should be seamless. If a user clicks "Login" with an empty box, the browser's native WebAuthn dialog should appear immediately.

## 4. Acceptance Criteria
*   [ ] Clicking "Register" with empty fields still shows an error.
*   [ ] Clicking "Login" with an empty User Name field **does not** show an error.
*   [ ] Clicking "Login" with an empty User Name initiates the WebAuthn flow.
*   [ ] The application successfully authenticates a user using a discoverable credential.

## 5. Out of Scope
*   UI layout changes (fields remain visible).
