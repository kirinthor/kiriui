const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    './ts/**/*.js',
    './resources/views/**/*.blade.php',
    './src/View/**/*.php'
  ],
  safelist: [
        'w-64',
        'w-1/2',
        'rounded-l-lg',
        'rounded-r-lg',
        'bg-gray-200',
        'bg-primary',
        'bg-secondary',
        'grid-cols-4',
        'grid-cols-7',
        'h-6',
        'leading-6',
        'h-9',
        'leading-9',
        'shadow-lg'
    ],
  darkMode: 'class',
  theme: {

      screens: {
          sm: '640px',
          md: '768px',
          lg: '1024px',
          xl: '1280px',
          '2xl': '1536px',
      },
      extend: {
          colors :{
              "primary": "#2fa800",
              "secondary": "#0a92d3",
              "accent": "#e13b3b",
              "neutral": "#4b5563",
              "base": "#e5e7eb",
              "info": "#0059ff",
              "success": "#52ff00",
              "warning": "#f8b818",
              "error": "#ff0000",
              "dark" : {
                  "primary": "#288c03",
                  "secondary": "#008ac9",
                  "accent": "#b23131",
                  "neutral": "#4b5769",
                  "base": "#edeef1",
                  "info": "#0346c0",
                  "success": "#4ae004",
                  "warning": "#c5961f",
                  "error": "#d00d0d",
              }
          },
      fontSize: {
        '3xs': '0.5rem',
        '2xs': '0.65rem'
      },
      spacing: {
        '2.2': '0.55rem',
        '3.5': '0.875rem',
        '4.5': '1.13rem',
        '5.5': '1.38rem',
        '6.5': '1.63rem',
        '9.5': '2.38rem'
      }
    }
  },
  plugins: [
    require('./tailwindcss/plugins/hideScrollbar')
  ]
}
