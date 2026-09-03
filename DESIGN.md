# Design System

## Color Palette

### Primary Colors
- Deep Royal Purple: `#5B14E6` (brand primary, CTAs, accents)
- Electric Violet: `#7B2CFF` (highlights, hover states)
- Bright Blue Accent: `#2196FF` (secondary accents, gradients)

### Neutral Colors
- Soft White: `#F8F8FA` (backgrounds)
- Light Gray Background: `#ECECEC` (subtle backgrounds)
- Dark Purple Shadow: `#2A0A66` (dark backgrounds, nav)
- Text Dark: `#1a0a3d` (primary text)
- Text Muted: `#6b5fa0` (secondary text)

### Semantic Colors
- Success: `#10B981`
- Warning: `#F59E0B`
- Error: `#EF4444`

### Gradients
- Primary gradient: `linear-gradient(135deg, #5B14E6, #2196FF)`
- Soft gradient: `linear-gradient(135deg, rgba(91,20,230,0.08), rgba(33,150,255,0.08))`
- Dark gradient: `linear-gradient(135deg, #0a0428, #2A0A66)`

## Typography

### Font Families
- Display/Headings: 'Noto Kufi Arabic', 'Cairo', sans-serif
- Body: 'Almarai', 'Cairo', sans-serif

### Type Scale
- Hero: `clamp(44px, 7vw, 100px)`
- H1: `clamp(32px, 5vw, 56px)`
- H2: `clamp(26px, 3.5vw, 42px)`
- H3: `clamp(18px, 2vw, 24px)`
- H4: `clamp(16px, 1.5vw, 20px)`
- Body: `16px`
- Small: `14px`
- Caption: `12px`

### Font Weights
- Light: 300
- Regular: 400
- Medium: 500
- Semibold: 600
- Bold: 700
- Extrabold: 800
- Black: 900

### Line Heights
- Tight: 1.2
- Normal: 1.5
- Relaxed: 1.7
- Loose: 1.8

## Spacing System

- 2xs: `4px`
- xs: `8px`
- sm: `16px`
- md: `24px`
- lg: `40px`
- xl: `64px`
- 2xl: `96px`
- 3xl: `120px`

## Border Radius

- xs: `4px`
- sm: `10px`
- md: `16px`
- lg: `24px`
- xl: `32px`
- pill: `50px`
- full: `9999px`

## Shadows

- Glow: `0 0 40px rgba(91,20,230,0.25)`
- Card: `0 8px 32px rgba(91,20,230,0.08)`
- Small: `0 2px 8px rgba(0,0,0,0.08)`
- Medium: `0 4px 16px rgba(0,0,0,0.12)`
- Large: `0 8px 32px rgba(0,0,0,0.16)`

## Transitions

- Fast: `150ms ease`
- Base: `200ms ease`
- Slow: `300ms ease`
- Spring: `500ms cubic-bezier(0.34, 1.56, 0.64, 1)`

## Z-index Scale

- Dropdown: `100`
- Sticky: `200`
- Overlay: `300`
- Modal: `400`
- Toast: `500`

## Container Widths

- Small: `640px`
- Medium: `768px`
- Large: `1024px`
- XL: `1280px`
- 2XL: `1440px`

## Components

### Navigation
- Fixed position, dark background with blur
- Height: `68px`
- Logo with gradient mark
- Links with purple hover state

### Buttons
- Rounded corners (`--radius-pill`)
- Purple gradient background
- White text
- Glow effect on hover

### Cards
- Soft white background
- Subtle purple shadow
- Rounded corners (`--radius-md` to `--radius-lg`)

### Forms
- Clean inputs with purple focus ring
- Clear validation states
- Accessible labels and error messages

## RTL Support

- Full RTL layout support
- Mirrored navigation and content flow
- Proper Arabic typography handling
