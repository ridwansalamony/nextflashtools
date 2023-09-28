/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/views/**/*.{html,js,php}","./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      fontFamily: {
        manrope: "Manrope",
    },
    colors: {
        primary: "#4B030A",
        secondary: "#6E0717",
        warning: "#FED01C",
        info: "#006AB5",
        background: "#F3F4F7",
    },
    },
  },
  plugins: [require('flowbite/plugin')],
}

