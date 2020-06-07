let mix = require('laravel-mix');
require('laravel-mix-imagemin');
const CleanPlugin = require('clean-webpack-plugin');

// Använd en av dessa
// const proxy = 'din-doman.test';
 const proxy = 'localhost/wordpress';

const keepUncompressed = false;

mix.disableSuccessNotifications();

mix.setPublicPath('./dist');

const asset = path => `assets/${path}`;
const dist = path => `${mix.config.publicPath}/${path}`;

// JavaScript
const jsDist = dist `js`;
mix.js(asset `scripts/main.js`, jsDist)
  .js(asset `scripts/admin/admin.js`, jsDist);

// SCSS
const cssDist = dist `css`;
mix.sass(asset `styles/main.scss`, `${cssDist}/style.css`)
   .sass(asset `styles/admin/admin.scss`, cssDist)
   .sass(asset `styles/admin/editor.scss`, `${cssDist}/classic-editor.css`)
   .sass(asset `styles/gutenberg/editor.scss`, `${cssDist}/gutenberg-editor.css`);

// mix.copyDirectory(asset `fonts`, dist `fonts`);


if (!mix.inProduction()) {
  mix.browserSync({
    proxy,
    files: [
      '(lib|templates)/**/*.php',
      '*.php',
      dist `(css|js)/*.(css|js)`,
    ],
  });
} else {
  mix.sourceMaps();
  mix.version();
  mix.extract();

  if (keepUncompressed) {
    mix.options({
      terser: {
        test: /(\.min|manifest|vendor)\.js/i,
      },
    });

    mix.js(asset `scripts/main.js`, dist `js/main.min.js`)
       .extract();
  }

  mix.imagemin(
    'images/*',
    {
      context: 'assets/',
    },
    {
      optipng: {
        optimizationLevel: 7
      }
    }
  );
}

mix.webpackConfig({
  externals: {
    jquery: 'jQuery',
  },
  plugins: [
    new CleanPlugin(),
  ],
  module: {
    rules: [
      {
        test: /\.m?jsx?$/,
        exclude: {
          test: /node_modules/,
          not: [
            /js-dom-router/,
          ],
        },
        use: [
          {
            loader: 'babel-loader',
            options: Config.babel()
          }
        ]
      }
    ]
  },
});

mix.autoload({
  jquery: ['$', 'jQuery', 'window.jQuery'],
});

mix.options({
  processCssUrls: false,
  postCss: [
    require('postcss-preset-env'),
  ],
});


// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.preact(src, output); <-- Identical to mix.js(), but registers Preact compilation.
// mix.coffee(src, output); <-- Identical to mix.js(), but registers CoffeeScript compilation.
// mix.ts(src, output); <-- TypeScript support. Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.test');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.dump(); <-- Dump the generated webpack config object t the console.
// mix.extend(name, handler) <-- Extend Mix's API with your own components.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
