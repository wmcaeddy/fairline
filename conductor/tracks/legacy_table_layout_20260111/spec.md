# Specification: Legacy Table Layout Adaptation

## Overview
Adapt the current modular PHP application to use the legacy table-based layout provided in the reference HTML. This involves wrapping the modern FIDO/WebAuthn functionality within a centered, image-heavy 962px table structure.

## Functional Requirements
1.  **Centered Table Structure:** Replicate the 962px wide centered table layout.
2.  **Modular Component Migration:** 
    *   `components/header.php`: Render the legacy image-based header and navigation.
    *   `components/hero.php`: Render the legacy `idx0_Banner` slider.
    *   `components/footer.php`: Render the legacy image-based footer.
3.  **FIDO Login Card Integration:**
    *   Place the portable FIDO login card (`.auth-card`) into the legacy login area (top-right) or as a centered overlay/content block within the table structure.
4.  **Legacy Assets:** Use image paths starting with `20260111141054139/` or `assets/pronew/` to match the legacy slices.

## Non-Functional Requirements
*   **Visual Fidelity:** Must match the provided legacy HTML design exactly.
*   **Portability:** The FIDO component must remain self-contained and modular.

## Acceptance Criteria
*   The page is centered and uses the legacy 962px table structure.
*   Header, Nav, Hero, and Footer match the legacy design.
*   FIDO registration and login remain functional within the new (old) layout.
