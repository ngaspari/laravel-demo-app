/** @type {import('tailwindcss').Config} */
module.exports = {
  mode : 'jit',
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
	'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
  theme: {
    extend: {},
  },
  plugins: [
  ],
}
