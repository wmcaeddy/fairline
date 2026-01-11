# Specification: Align Username and User ID for Consistent Passkey Selection

## Overview
Users are reporting confusion during passkey selection because the identifiers shown by the browser/authenticator (e.g., "BtpUqA") do not match their chosen username (e.g., "eddy6"). This track aims to synchronize the `user.name`, `user.displayName`, and `user.id` fields in the WebAuthn ceremony to ensure that the user's chosen identifier is what they see and select.

## Functional Requirements
- **Identifier Synchronization:** Update the WebAuthn registration and authentication flows to ensure that the `user.name` and `user.displayName` fields are consistently set to the human-readable username provided by the user.
- **User ID Alignment:** Ensure the internal `user.id` (binary) is derived directly from the username in a way that remains stable but doesn't interfere with the browser's display logic.
- **Display Consistency:** Verify that the "Ready to Scan" and passkey selection dialogs on various platforms (especially iOS and Desktop browsers) display the expected username.

## Non-Functional Requirements
- **Backward Compatibility:** Existing registrations should ideally still work, but the focus is on making new registrations and the overall selection experience consistent.
- **Security:** Maintain the requirement that `user.id` is a stable identifier for the user account.

## Acceptance Criteria
- When registering with username "eddy6", the authenticator selection dialog clearly shows "eddy6".
- When authenticating, the list of available passkeys displays the usernames entered during registration rather than encoded strings or internal IDs.
- The `modern_client.html` and `server.php` are updated to enforce this alignment.

## Out of Scope
- Implementing a full database-backed user management system (continuing to use the existing serialized storage).
- Changing the core WebAuthn library logic unless necessary for this alignment.
