# Design System Document

## 1. Overview & Creative North Star
The visual identity of this design system is anchored by the Creative North Star: **"The Sovereign Analyst."** 

In the volatile world of finance, users seek more than just data; they seek clarity and authority. This system moves away from the cluttered, "ticker-tape" density of traditional portals (like the legacy boerse.de) and adopts a sophisticated editorial approach. By leveraging intentional white space, high-contrast typography, and a layered surface architecture, we transform a financial portal into a premium, curated experience. The design breaks the traditional rigid grid through subtle shifts in container elevation and "breathable" layouts that prioritize cognitive ease.

## 2. Colors
Our palette is a study in depth and stability, utilizing a professional deep blue core balanced by a sophisticated range of neutral surfaces.

*   **Primary (`#002655`):** Reserved for high-authority moments, global navigation, and core brand identifiers.
*   **Surface Hierarchy:** We define depth through tonal shifts rather than lines.
    *   **Surface (`#f7f9fb`):** The base "canvas" of the application.
    *   **Surface-Container-Low (`#f2f4f6`):** Used for large secondary content areas.
    *   **Surface-Container-Lowest (`#ffffff`):** Used for primary cards to make them "pop" against the background.
*   **The "No-Line" Rule:** 1px solid borders are strictly prohibited for sectioning. Structural boundaries must be defined solely through background color shifts. If a card sits on `surface`, it should be `surface-container-lowest`.
*   **The "Glass & Gradient" Rule:** For floating headers or interactive stock overlays, use Glassmorphism (Background Blur: 20px) with 80% opacity on surface colors. Apply subtle linear gradients from `primary` to `primary_container` on main CTAs to add a "liquid" premium finish.

## 3. Typography
We utilize a dual-font strategy to balance character with readability.

*   **Display & Headlines (Manrope):** A modern, geometric sans-serif that feels architectural and confident. Use `display-lg` (3.5rem) for major market movements and `headline-md` (1.75rem) for news titles.
*   **Body & Labels (Inter):** The gold standard for data readability. Inter’s tall x-height ensures that complex financial tables remain legible even at `body-sm` (0.75rem).
*   **Hierarchy as Identity:** By pairing a bold `headline-sm` Manrope title with a spacious `body-md` Inter lead-in, we create an editorial "magazine" feel that elevates financial news above mere data points.

## 4. Elevation & Depth
This system rejects "flat" design in favor of **Tonal Layering**.

*   **The Layering Principle:** Depth is achieved by stacking surface tokens. A typical stack: `surface` (base) > `surface-container-low` (section wrapper) > `surface-container-lowest` (individual stock card). This creates a natural, soft lift.
*   **Ambient Shadows:** When a card requires a "floating" state (e.g., a hovered stock chart), use a shadow tinted with `on_surface` at 6% opacity, with a 32px blur and 16px offset. It should feel like an atmospheric glow, not a dark smudge.
*   **The "Ghost Border":** If a container requires definition against a similar background, use `outline_variant` at 15% opacity. Never use 100% opaque borders.
*   **Glassmorphism:** Use semi-transparent `surface_container_lowest` for navigation bars and modal overlays to maintain a sense of place and context.

## 5. Components

### Cards & Lists
*   **Style:** Roundedness `md` (0.75rem) or `lg` (1rem). 
*   **Rule:** Forbid divider lines. Use `spacing-4` (1.4rem) or `spacing-6` (2rem) to separate news items.
*   **Context:** Market overview cards should use `surface_container_lowest` with a subtle `outline_variant` ghost border to feel like independent physical objects.

### Buttons
*   **Primary:** `primary` background, `on_primary` text. Use `rounded-full` for a modern, 2026 tech aesthetic.
*   **Secondary:** `secondary_container` background with `on_secondary_container` text. No border.

### Chips & Tags
*   **Market Status:** Use `tertiary_container` for "Trending" or "Live" tags.
*   **Selection:** Filter chips should transition from `surface_container_high` to `primary` when active.

### Input Fields
*   **Style:** Search bars (crucial for a financial portal) should use `surface_container_highest` with a `rounded-full` shape and `inter` `body-md` typography. 
*   **States:** On focus, the ghost border increases to 40% opacity—never a solid dark line.

### Financial Data Visualization
*   **Sparklines:** Use a 2px stroke width. Bullish trends use a custom blend of `primary` and `secondary`; bearish trends use `error`.
*   **Tables:** Striping is forbidden. Use `surface_container_low` on hover to highlight rows.

## 6. Do's and Don'ts

### Do
*   **Do** use asymmetrical layouts for news sections (e.g., one large featured story next to two smaller stacked stories) to avoid the "template" look.
*   **Do** prioritize `spacing-8` (2.75rem) between major sections to let the financial data "breathe."
*   **Do** use `title-lg` for stock prices to give them the visual weight they deserve.

### Don't
*   **Don't** use pure black `#000000` for text; use `on_surface` (`#191c1e`) for a softer, premium contrast.
*   **Don't** use standard "drop shadows" on every card; rely on tonal background shifts first.
*   **Don't** crowd the UI. If a screen feels full, increase the spacing tokens rather than shrinking the text.
*   **Don't** use high-saturation reds or greens for market data. Stick to the refined `error` and `primary` variants to maintain the "Sovereign Analyst" tone.