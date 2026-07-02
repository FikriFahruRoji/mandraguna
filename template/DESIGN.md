---
name: Agricultural Excellence
colors:
  surface: '#f8f9fa'
  surface-dim: '#d9dadb'
  surface-bright: '#f8f9fa'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f4f5'
  surface-container: '#edeeef'
  surface-container-high: '#e7e8e9'
  surface-container-highest: '#e1e3e4'
  on-surface: '#191c1d'
  on-surface-variant: '#4f4634'
  inverse-surface: '#2e3132'
  inverse-on-surface: '#f0f1f2'
  outline: '#817662'
  outline-variant: '#d3c5ae'
  surface-tint: '#795900'
  primary: '#795900'
  on-primary: '#ffffff'
  primary-container: '#daa520'
  on-primary-container: '#553d00'
  inverse-primary: '#f6be3b'
  secondary: '#5e5e5e'
  on-secondary: '#ffffff'
  secondary-container: '#e2e2e2'
  on-secondary-container: '#646464'
  tertiary: '#0c60a9'
  on-tertiary: '#ffffff'
  tertiary-container: '#73b0ff'
  on-tertiary-container: '#004279'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffdea0'
  primary-fixed-dim: '#f6be3b'
  on-primary-fixed: '#261900'
  on-primary-fixed-variant: '#5c4300'
  secondary-fixed: '#e2e2e2'
  secondary-fixed-dim: '#c6c6c6'
  on-secondary-fixed: '#1b1b1b'
  on-secondary-fixed-variant: '#474747'
  tertiary-fixed: '#d4e3ff'
  tertiary-fixed-dim: '#a4c9ff'
  on-tertiary-fixed: '#001c39'
  on-tertiary-fixed-variant: '#004883'
  background: '#f8f9fa'
  on-background: '#191c1d'
  surface-variant: '#e1e3e4'
  earth-black: '#1A1A1A'
  harvest-gold: '#E5B02E'
  pure-white: '#FFFFFF'
  surface-gray: '#EDEDED'
typography:
  headline-xl:
    fontFamily: Hanken Grotesk
    fontSize: 64px
    fontWeight: '800'
    lineHeight: 72px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Hanken Grotesk
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
  headline-lg-mobile:
    fontFamily: Hanken Grotesk
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
  headline-md:
    fontFamily: Hanken Grotesk
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-caps:
    fontFamily: IBM Plex Sans
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.1em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  container-max: 1280px
  gutter: 32px
  margin-desktop: 64px
  margin-mobile: 20px
  section-gap: 120px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
---

## Brand & Style

The design system establishes a narrative of professional sustainability and agricultural authority. Drawing inspiration from industry leaders, the visual style prioritizes clarity, trust, and large-scale impact. It is designed for an audience of farmers, industrial partners, and environmental stakeholders who value proven results and institutional stability.

The aesthetic follows a **Corporate / Modern** approach with a high-contrast editorial edge. It utilizes expansive white space to denote premium quality, paired with bold, heavy-weight typography to communicate strength. The style avoids excessive ornamentation, relying instead on high-quality agricultural photography and structured grid alignments to convey a message of "clean" innovation in the organic fertilizer sector.

## Colors

The palette is a sophisticated "Prestige Agricultural" triad: **Gold, Black, and White**. 

- **Primary Gold**: Represents the harvest, the sun, and the premium nature of the amino acid products. It is used for calls to action, highlights, and critical iconography.
- **Secondary Black**: Provides the authoritative "anchor." It is used for primary typography and high-impact structural blocks to create a sense of permanence and industrial strength.
- **Neutral Surface**: A combination of pure white and extremely light grays ensures the layout feels "breathable" and modern, preventing the bold gold and black from becoming overwhelming.

The color mode is strictly light, ensuring maximum readability and a clean, laboratory-grade professional feel.

## Typography

The typography system is built on modern, high-legibility sans-serifs that mirror the "clean tech" side of modern agriculture. 

**Hanken Grotesk** is used for headlines. Its sharp, contemporary geometry provides the "authoritative" voice requested. Heavy weights (Bold/ExtraBold) should be used for section titles to command attention.

**Inter** handles the bulk of the body copy. It is selected for its neutral, systematic character, ensuring that dense technical information (like dosage instructions) remains highly readable.

**IBM Plex Sans** is used for labels and technical data. Its slightly more "engineered" feel works perfectly for agricultural specifications and chemical breakdowns.

## Layout & Spacing

The layout utilizes a **Fixed Grid** model for desktop, centered within the viewport to maintain a professional, organized appearance. 

- **Grid Model**: A 12-column grid with generous 32px gutters. Content should typically span blocks of 3, 4, 6, or 12 columns.
- **Whitespace**: A "high-ratio" whitespace philosophy is applied. Section gaps are intentionally large (120px+) to separate distinct narratives like "Problem," "Solution," and "Product Details."
- **Reflow**: On mobile, the grid collapses to a single column with 20px side margins. Section gaps are reduced to 60px to maintain momentum while scrolling.
- **Vertical Rhythm**: Elements within a card or section follow a 8px base unit (8, 16, 24, 32) to ensure mathematical consistency.

## Elevation & Depth

To maintain a "clean" and "sustainable" look, this design system avoids heavy shadows and traditional skeuomorphism. 

Depth is achieved through **Tonal Layering** and **Ghost Borders**:
- **Tonal Layers**: Primary content sits on white (#FFFFFF) surfaces. Secondary information or "data" blocks use a very light gray (#F8F9FA) background to create a subtle recessed effect.
- **Low-Contrast Outlines**: Instead of shadows, cards and input fields use a subtle 1px border (#DDDDDD).
- **Interactive Depth**: Only on hover do elements exhibit a "lift." This is executed with a very soft, diffused ambient shadow (0px 10px 30px rgba(0,0,0,0.05)) to suggest interactivity without cluttering the interface.

## Shapes

The shape language is **Soft (0.25rem)**. 

The design leans toward a structured, "engineered" aesthetic. Sharp corners are avoided to remain approachable, but high roundedness is rejected to maintain an "industrial/professional" edge. 

Images and primary containers use the standard `rounded-sm` (4px). Interactive elements like buttons and input fields follow this same rhythm. Circular elements are reserved exclusively for numerical badges or specific "leaf" icon motifs derived from the logo.

## Components

### Buttons
Primary buttons are solid Black with White text or Gold with Black text. They feature a rectangular profile with minimal rounding (4px). Secondary buttons use the "Ghost" style—a 1px black border with no fill.

### Cards
Cards are the primary container for "Agricultural Insights." They feature a 1px border (#DDDDDD), no shadow, and a white background. Image headers within cards should have their top corners rounded to 4px to match the container.

### Input Fields
Fields are clean and minimalist. They feature a bottom-border-only design or a very light 4-sided stroke. Labels are set in uppercase IBM Plex Sans (Label-caps) for a technical appearance.

### Technical Data Lists
Given the product's focus on "Kandungan Pupuk" (Fertilizer Content), data lists should use a "Zebra-stripe" layout with alternating #FFFFFF and #F8F9FA rows to ensure data points are easy to track across the page.

### Iconography
Icons should be thin-stroke, monolinear, and professional. Avoid "bubbly" or overly illustrative icons. Use the "leaf" motif sparingly as a bullet point or decorative divider.