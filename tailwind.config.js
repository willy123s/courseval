/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.{html,js,php}", "./controllers/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        brand: {
          light: "#3361ac",
          DEFAULT: "#0d6efd",
          dark: "#052a63",
        },
        accent: {
          light: "#0d4eff",
          DEFAULT: "#ffcc33",
          dark: "#fc9601",
        },
        success: {
          light: "#95c22b",
          DEFAULT: "#507b00",
          dark: "#28430a",
        },
        danger: {
          light: "#c62e12",
          DEFAULT: "#af0401",
          dark: "#9c0401",
        },
        warning: {
          light: "#FFBB5C",
          DEFAULT: "#FF9B50",
          dark: "#E25E3E",
        },
      },
    },
  },
  plugins: [],
};
