import defaultTheme from 'tailwindcss/defaultTheme';
//import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		 './storage/framework/views/*.php',
		 './resources/views/**/*.blade.php',
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
		//forms,
		require("daisyui"),
	],

    daisyui: {
        themes: [
          {
            caapedia: {
              "primary": "#021201",
              "secondary": "#f6d860",
              "accent": "#37cdbe",
              "neutral": "#3d4451",
              "base-100": "#ffffff",
    
              "--rounded-box": "1rem", // border radius rounded-box utility class, used in card and other large boxes
              "--rounded-btn": "0.5rem", // border radius rounded-btn utility class, used in buttons and similar element
              "--rounded-badge": "1.9rem", // border radius rounded-badge utility class, used in badges and similar
              "--animation-btn": "0.25s", // duration of animation when you click on button
              "--animation-input": "0.2s", // duration of animation for inputs like checkbox, toggle, radio, etc
              "--btn-focus-scale": "0.95", // scale transform of button when you focus on it
              "--border-btn": "1px", // border width of buttons
              "--tab-border": "1px", // border width of tabs
              "--tab-radius": "0.5rem", // border radius of tabs

              ".input": {
                  "background-color": "transparent",
                  "border-color": "#000000",
              },
              ".input:focus": {
                  "border-color": "#000000",
                  "outline-color": "#000000",
              },
              ".input::placeholder": {
                  "color": "rgba(0,0,0, 0.8)",
              },
              ".select": {
                  "background-color": "rgba(255,255,255, .1)",
                  "border-color": "#000000",
              },
              "table, td, th, tr": {
                  "border-bottom": "1px solid #000;",
              }
            },
          },
        ],
      },
};
