/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.html", "./**/*.php", "./views/**"],
  theme: {
    screens: {
      sm: "480px",
      md: "768px",
      lg: "976px",
      xl: "1440px",
    },
    extend: {
      fontFamily: {
        inter: ["Inter", "sans-serif"],
      },
    },
  },
  plugins: [],
};
