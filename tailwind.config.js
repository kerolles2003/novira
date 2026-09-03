/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [
    "./**/*.php",
    "./**/*.html",
    "./**/*.js",
  ],
  corePlugins: {
    preflight: false,
  },
  theme: {
    extend: {
      colors: {
        "on-background": "#1a1c1d",
        "success": "#10B981",
        "surface-bright": "#f9f9fb",
        "secondary-container": "#7b2cff",
        "primary-fixed": "#e7deff",
        "primary": "#4200b2",
        "surface-container-high": "#e8e8ea",
        "on-tertiary-fixed": "#001c38",
        "surface-container": "#edeef0",
        "on-primary": "#ffffff",
        "on-error": "#ffffff",
        "bright-blue": "#2196FF",
        "tertiary": "#003d6f",
        "on-secondary-fixed": "#24005b",
        "on-primary-fixed": "#20005f",
        "warning": "#F59E0B",
        "secondary-fixed": "#eaddff",
        "on-secondary-container": "#ebdfff",
        "error": "#EF4444",
        "on-surface": "#1a1c1d",
        "secondary": "#6000d9",
        "on-primary-fixed-variant": "#4f00d1",
        "text-muted": "#6B5FA0",
        "surface": "#f9f9fb",
        "tertiary-fixed": "#d3e4ff",
        "surface-dim": "#d9dadc",
        "electric-violet": "#7B2CFF",
        "on-tertiary": "#ffffff",
        "deep-royal-purple": "#5B14E6",
        "dark-purple-shadow": "#2A0A66",
        "primary-container": "#5b14e6",
        "on-primary-container": "#ccbcff",
        "inverse-surface": "#2f3132",
        "background": "#f9f9fb",
        "surface-variant": "#e2e2e4",
        "surface-container-highest": "#e2e2e4",
        "inverse-primary": "#cdbdff",
        "surface-container-lowest": "#ffffff",
        "outline": "#7a7488",
        "on-secondary-fixed-variant": "#5800c8",
        "tertiary-fixed-dim": "#a3c9ff",
        "on-error-container": "#93000a",
        "on-secondary": "#ffffff",
        "tertiary-container": "#005496",
        "surface-tint": "#682df2",
        "text-dark": "#1A0A3D",
        "on-surface-variant": "#494456",
        "inverse-on-surface": "#f0f0f2",
        "bg-light-gray": "#ECECEC",
        "secondary-fixed-dim": "#d1bcff",
        "on-tertiary-container": "#a2c9ff",
        "on-tertiary-fixed-variant": "#004882",
        "error-container": "#ffdad6",
        "outline-variant": "#cac3d9",
        "surface-container-low": "#f3f3f5",
        "primary-fixed-dim": "#cdbdff",
        "brand": { "purple": "#5B14E6", "violet": "#8B5CF6", "dark": "#1E1B4B", "light": "#F5F3FF", "glass": "rgba(255, 255, 255, 0.9)", "50": "#f5f3ff", "100": "#ede9fe", "200": "#ddd6fe", "300": "#c4b5fd", "400": "#a78bfa", "500": "#8b5cf6", "600": "#7c3aed", "700": "#6d28d9", "800": "#5b21b6", "900": "#4c1d95", "950": "#2e1065", "primary": "#5B14E6", "gradientStart": "#8b5cf6", "gradientEnd": "#6d28d9" }
      },
      boxShadow: {
        "glass": "0 10px 40px -10px rgba(91, 20, 230, 0.1)",
        "card": "0 20px 50px -20px rgba(91, 20, 230, 0.15)"
      },
      backgroundImage: {
        "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
        "hero-bg": "url('https://lh3.googleusercontent.com/aida-public/AB6AXuCFNaWpO3skX2vRq4NS8YMZjQU6QKuDz-laBHr4-cRQRfEkKmGJbB8hOTndYcTgcZRxdQgQXifbUEb3BwVpcNMs2z0C__i0lhSg4lgriy4UuxjgaV6r5v6xK1f1IeVe31xX9Ki5r4AGpUCnwGYyKb19Mqlf_yX7WJ8oNfyimej-zyLg_HXCtAyICxs16SHSntKjc-7RSPAoY-_mW1bq4G-6gah61qzqKdAQD0sFj5y870Va2Cb2fGICtAb-jK2xBxGVx5iM-R2KiB3x')"
      },
      animation: {
        "liquid-wave": "wave 8s linear infinite",
        "spin-slow": "spin 15s linear infinite"
      },
      keyframes: {
        "wave": {
          "0%": { transform: "translateX(0)" },
          "100%": { transform: "translateX(-50%)" }
        }
      },
      borderRadius: {
        "DEFAULT": "0.25rem",
        "lg": "0.5rem",
        "xl": "0.75rem",
        "full": "9999px"
      },
      spacing: {
        "xl": "64px",
        "container-max": "1440px",
        "2xs": "4px",
        "lg": "40px",
        "2xl": "96px",
        "gutter": "24px",
        "3xl": "120px",
        "md": "24px",
        "sm": "16px",
        "xs": "8px"
      },
      fontFamily: {
        "label-sm": ["Almarai"],
        "hero-mobile": ["Noto Kufi Arabic"],
        "h1": ["Noto Kufi Arabic"],
        "body-lg": ["Almarai"],
        "h1-mobile": ["Noto Kufi Arabic"],
        "body-md": ["Almarai"],
        "h3": ["Noto Kufi Arabic"],
        "caption": ["Almarai"],
        "hero": ["Noto Kufi Arabic"],
        "h2": ["Noto Kufi Arabic"],
        "arabic": ['"Noto Kufi Arabic"', "sans-serif"],
        "english": ['"Plus Jakarta Sans"', "sans-serif"]
      },
      fontSize: {
        "label-sm": ["14px", { lineHeight: "1.2", fontWeight: "500" }],
        "hero-mobile": ["44px", { lineHeight: "1.2", fontWeight: "800" }],
        "h1": ["56px", { lineHeight: "1.2", fontWeight: "700" }],
        "body-lg": ["18px", { lineHeight: "1.7", fontWeight: "400" }],
        "h1-mobile": ["32px", { lineHeight: "1.2", fontWeight: "700" }],
        "body-md": ["16px", { lineHeight: "1.5", fontWeight: "400" }],
        "h3": ["24px", { lineHeight: "1.4", fontWeight: "600" }],
        "caption": ["12px", { lineHeight: "1.2", fontWeight: "400" }],
        "hero": ["100px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "800" }],
        "h2": ["42px", { lineHeight: "1.3", fontWeight: "600" }]
      }
    }
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/container-queries'),
  ],
}
