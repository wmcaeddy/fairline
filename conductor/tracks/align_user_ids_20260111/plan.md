# Plan: Align Username and User ID for Consistent Passkey Selection

## Phase 1: Diagnostics and Library Audit
- [ ] Task: Audit `src/WebAuthn.php` to see how `user.name` and `user.displayName` are handled during `getCreateArgs`.
- [ ] Task: Verify the base64/binary conversion logic in `_test/modern_client.html` and `server.php` for the `userId`.
- [ ] Task: Create a reproduction script (test case) that simulates the registration of multiple users and logs the generated `createArgs`.
- [ ] Task: Conductor - User Manual Verification 'Diagnostics and Library Audit' (Protocol in workflow.md)

## Phase 2: Implementation of Identifier Alignment
- [ ] Task: Update `server.php` to ensure the `userName` and `userDisplayName` passed to the `WebAuthn` library match the user's input exactly.
- [ ] Task: Modify the `userId` generation to ensure it is a clean binary representation of the username, avoiding unnecessary double-encoding that might lead to confusing display values.
- [ ] Task: Update `_test/modern_client.html` to ensure the display name is correctly prioritized and passed to the WebAuthn API.
- [ ] Task: Conductor - User Manual Verification 'Implementation of Identifier Alignment' (Protocol in workflow.md)

## Phase 3: Verification and UX Polishing
- [ ] Task: Manually verify on multiple platforms (Chrome, Safari/iOS) that the passkey selection dialog shows the human-readable username.
- [ ] Task: Update the "Server Data Preview" in `server.php` to clearly show the relationship between stored UserID, UserName, and DisplayName.
- [ ] Task: Conductor - User Manual Verification 'Verification and UX Polishing' (Protocol in workflow.md)
