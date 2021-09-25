let mix = require("laravel-mix");

mix.webpackConfig({
  externals: {
    jquery: "jQuery"
  }
});

mix
  .js(["src/js/main.js"], "js")
  .sass("src/scss/main.scss", "css")
  .sourceMaps()
  .options({
    processCssUrls: false,
    postCss: [require("autoprefixer")]
  })
  .sourceMaps(true, "source-map")
  .setPublicPath("dist");
