# Specification: PChome Theme Integration (pchome_theme_20260113)

## Overview
Transform the current WebAuthn interface to match the visual identity and layout of PChome (24h.pchome.com.tw) while maintaining all existing WebAuthn (FIDO2) functionality, including registration, login, and usernameless login.

## Functional Requirements
*   **Existing FIDO2 Functions:** Ensure all WebAuthn flows (Register, Login, Usernameless Login) remain fully functional and correctly integrated into the new UI.
*   **Adaptive Layout:** Maintain the split-screen/fixed-width architecture but re-skin it to match PChome's design language.
*   **Interactive Elements:** All buttons and form inputs must use PChome-specific styling (e.g., the primary red action buttons).

## Non-Functional Requirements
*   **Visual Fidelity:** Replicate PChome's color palette (Red: #ec2c22, Blue, White), typography, and general density.
*   **Responsiveness:** The PChome-inspired layout must be fully responsive, prioritizing functional access on mobile devices.
*   **Branding:** Incorporate PChome's header and footer styles for an authentic look and feel.

## Acceptance Criteria
1.  The landing page visually resembles PChome 24h, including the header, footer, and central container styles.
2.  The authentication section (right side of the split-screen) uses the "Standard PChome Login Box" style.
3.  The branding section (left side) is styled to match the PChome environment.
4.  User can successfully register a new passkey using the new UI.
5.  User can successfully log in with an existing passkey using the new UI.
6.  The "Show Server Data" toggle remains functional and integrated into the new theme.

## Out of Scope
*   Actually connecting to PChome's backend or user database.
*   Implementing functional shopping cart or search features (these will be visual placeholders only).
