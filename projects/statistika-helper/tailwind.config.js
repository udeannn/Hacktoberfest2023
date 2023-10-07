/** @type {import('tailwindcss').Config} */

const twDefault = require("tailwindcss/defaultTheme");

module.exports = {
  content: ["index.html"],
  theme: {
    container: {
      center: true,
    },
    extend: {
      fontFamily: {
        huruf: ['"Poppins"', ...twDefault.fontFamily.sans],
        angka: ['"Outfit"', "sans-serif"],
      },
    },
  },
  plugins: [require("@tailwindcss/forms")],
};
