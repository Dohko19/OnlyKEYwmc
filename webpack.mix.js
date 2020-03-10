const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.browserSync({
    //     proxy: 'http://onlykeywmc.sw/'
    proxy: "http://key.test:8001/"
});

if (mix.inProduction()) {
    mix.version();
}
