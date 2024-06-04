/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'lavender': {
          '50': '#f8f7fb',
          '100': '#f1f1f6',
          '200': '#e6e5ef',
          '300': '#d2d0e2',
          '400': '#bcb8d3',
          '500': '#9d95bd',
          '600': '#887daa',
          '700': '#776a97',
          '800': '#63587f',
          '900': '#534a68',
          '950': '#353045',
        },
        'outline': '#EBEBED',
        'danger': '#dc3545',
        'primary': '#007bff',
        'success': '#198754'

      }
    },
    fontFamily: {
      "DM_Sans": ["DM Sans"]
    }
  },
  plugins: [],
}