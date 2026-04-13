/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin')

export default {
    content: [
        './index.html',
        './src/**/*.{ts,tsx}',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                /* ── Material Design 3 tokens (existing components) ── */
                'surface-tint':               '#345ea2',
                'surface-container-highest':  '#e0e3e5',
                'surface-container-low':      '#f2f4f6',
                'surface-container-high':     '#e6e8ea',
                'surface':                    '#f7f9fb',
                'secondary-container':        '#d5e3fc',
                'error-container':            '#ffdad6',
                'error':                      '#ba1a1a',
                'on-secondary-container':     '#57657a',
                'on-primary':                 '#ffffff',
                'surface-dim':                '#d8dadc',
                'on-background':              '#191c1e',
                'outline-variant':            '#c3c6d2',
                'primary-container':          '#003b7e',
                'on-surface':                 '#191c1e',
                'secondary':                  '#515f74',
                'on-error':                   '#ffffff',
                'surface-variant':            '#e0e3e5',
                'surface-container':          '#eceef0',
                'inverse-surface':            '#2d3133',
                'on-secondary':               '#ffffff',
                'on-surface-variant':         '#434750',
                'inverse-on-surface':         '#eff1f3',
                'on-primary-container':       '#81a8f1',
                'outline':                    '#737782',
                'primary':                    '#002655',
                'surface-bright':             '#f7f9fb',
                'on-tertiary':                '#ffffff',
                'surface-container-lowest':   '#ffffff',
                'inverse-primary':            '#acc7ff',

                /* ── shadcn semantic tokens (new components) ── */
                background:             'hsl(var(--background))',
                foreground:             'hsl(var(--foreground))',
                card: {
                    DEFAULT:            'hsl(var(--card))',
                    foreground:         'hsl(var(--card-foreground))',
                },
                popover: {
                    DEFAULT:            'hsl(var(--popover))',
                    foreground:         'hsl(var(--popover-foreground))',
                },
                muted: {
                    DEFAULT:            'hsl(var(--muted))',
                    foreground:         'hsl(var(--muted-foreground))',
                },
                accent: {
                    DEFAULT:            'hsl(var(--accent))',
                    foreground:         'hsl(var(--accent-foreground))',
                },
                destructive: {
                    DEFAULT:            'hsl(var(--destructive))',
                    foreground:         'hsl(var(--destructive-foreground))',
                },
                border:                 'hsl(var(--border))',
                input:                  'hsl(var(--input))',
                ring:                   'hsl(var(--ring))',
            },
            fontFamily: {
                'headline': ['Manrope', 'sans-serif'],
                'body':     ['Inter', 'sans-serif'],
                'label':    ['Inter', 'sans-serif'],
                'sans':     ['Inter', 'sans-serif'],
                'heading':  ['Manrope', 'sans-serif'],
            },
            borderRadius: {
                DEFAULT: '0.5rem',
                lg:      '0.75rem',
                xl:      '1rem',
                full:    '9999px',
                md:      'calc(var(--radius) - 2px)',
                sm:      'calc(var(--radius) - 4px)',
            },
            backdropBlur: {
                xs: '2px',
            },
            keyframes: {
                'accordion-down': {
                    from: { height: '0' },
                    to:   { height: 'var(--radix-accordion-content-height)' },
                },
                'accordion-up': {
                    from: { height: 'var(--radix-accordion-content-height)' },
                    to:   { height: '0' },
                },
            },
            animation: {
                'accordion-down': 'accordion-down 0.2s ease-out',
                'accordion-up':   'accordion-up 0.2s ease-out',
            },
        },
    },
    plugins: [
        require('tailwindcss-animate'),
        plugin(({ addVariant }) => {
            // shadcn nova custom variants — Tailwind v3 compat layer
            addVariant('data-open',   ['&[data-state="open"]',   '&:where([data-open]:not([data-open="false"]))'])
            addVariant('data-closed', ['&[data-state="closed"]', '&:where([data-closed]:not([data-closed="false"]))'])
            addVariant('data-checked',   '&[data-state="checked"]')
            addVariant('data-unchecked', '&[data-state="unchecked"]')
            addVariant('data-selected',  '&[data-selected="true"]')
            addVariant('data-disabled',  '&[data-disabled="true"]')
            addVariant('data-active',  ['&[data-state="active"]', '&:where([data-active]:not([data-active="false"]))'])
            addVariant('data-horizontal', '&[data-orientation="horizontal"]')
            addVariant('data-vertical',   '&[data-orientation="vertical"]')
            addVariant('supports-backdrop-filter', '@supports (backdrop-filter: blur(0px))')
        }),
    ],
}
