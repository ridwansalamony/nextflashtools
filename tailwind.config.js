/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/views/**/*.{html,js,php}","./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      fontFamily: {
        manrope: "Manrope",
    },
    colors: {
        primary: "#E3A62F",
        background: "#F3F4F7",
    },
    },
  },
  plugins: [require('flowbite/plugin')],
}

