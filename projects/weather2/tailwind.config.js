/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./dist/**/*.{html,js}"],
  theme: {
      extend: {
          fontFamily: {
              "montserrat": ["Montserrat", "sans-serif"],
          },
      },
  },
  plugins: [require("tailwindcss-3d")({ legacy: true })],
};
