const mix = require("laravel-mix");

mix.disableSuccessNotifications();

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
    ])
    .postCss("resources/css/admin.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss")("./tailwind-admin.config.js"),
    ]);

if (mix.inProduction()) {
    mix.version();
}
