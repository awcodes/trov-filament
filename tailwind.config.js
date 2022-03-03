const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");
const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/!(filament)**/*.blade.php",
    ],
    darkMode: "class",
    theme: {
        screens: {
            sm: "568px",
            md: "768px",
            lg: "1024px",
        },
        container: {
            center: true,
            padding: "1.5rem",
        },
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.yellow,
                secondary: colors.amber,
                tertiary: colors.orange,
                accent: colors.teal,
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        plugin(function ({ addUtilities, theme }) {
            addUtilities({
                ".text-shadow": {
                    textShadow: "0 0 3px rgba(0, 0, 0, 0.7)",
                },
                ".text-shadow-md": {
                    textShadow: "0 0 5px rgba(0, 0, 0, 0.7)",
                },
                ".text-shadow-lg": {
                    textShadow: "0 0 8px rgba(0, 0, 0, 0.7)",
                },
                ".text-shadow-xl": {
                    textShadow: "0 0 12px rgba(0, 0, 0, 0.2)",
                },
                ".text-shadow-white": {
                    textShadow: "0 0 3px rgba(255, 255, 255, 0.8)",
                },
                ".text-shadow-white-md": {
                    textShadow: "0 0 5px rgba(255, 255, 255, 0.8)",
                },
                ".text-shadow-white-lg": {
                    textShadow: "0 0 8px rgba(255, 255, 255, 0.8)",
                },
                ".text-shadow-white-xl": {
                    textShadow: "0 0 12px rgba(255, 255, 255, 0.7)",
                },
            });
        }),
    ],
};
