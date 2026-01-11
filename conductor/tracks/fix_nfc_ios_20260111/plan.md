# Plan: Fix NFC Registration Failure on iOS Safari

## Phase 1: Investigation and Reproduction
- [ ] Task: Audit `_test/client.html` and `_test/modern_client.html` to verify if WebAuthn calls are wrapped in direct user gestures (clicks).
- [ ] Task: Inspect `_test/server.php` to ensure RP ID and origin headers are correctly handled for iOS Safari environments.
- [ ] Task: Create a manual reproduction checklist to confirm the `NotAllowedError` on an iOS device.
- [ ] Task: Conductor - User Manual Verification 'Investigation and Reproduction' (Protocol in workflow.md)

## Phase 2: Fix Implementation
- [ ] Task: Refactor frontend JavaScript to ensure strict compliance with Safari's user gesture requirements for `navigator.credentials.create`.
- [ ] Task: Implement a check for secure context (HTTPS) in the frontend and display a warning if missing.
- [ ] Task: Verify that registration now proceeds to the platform's NFC/Biometric prompt on iOS.
- [ ] Task: Conductor - User Manual Verification 'Fix Implementation' (Protocol in workflow.md)

## Phase 3: UX & Error Handling
- [ ] Task: Update the error handling logic to catch `NotAllowedError` and provide specific guidance for iOS NFC users.
- [ ] Task: Add a "Help" or "Troubleshooting" tooltip specifically for NFC registration failures.
- [ ] Task: Conductor - User Manual Verification 'UX & Error Handling' (Protocol in workflow.md)
