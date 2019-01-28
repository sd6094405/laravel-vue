let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
    module: {
        // strictExportPresence:true,

        rules: [
            {
                test: /\.less$/,
                loader: 'less-loader',
                options: {javascriptEnabled: true},

            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader',
                options: {
                    "presets": [
                        ["es2015", {"modules": false}]
                    ],
                    "plugins": [["component", [
                        {
                            "libraryName": "element-ui",
                            "styleLibraryName": "theme-chalk"
                        }
                    ]]]
                }
            },
            {
                test: /\.css$/,
                loader: "style-loader!css-loader"
            },
        ]
    }
});
mix.extend('cssModules', function(webpackConfig) {
    webpackConfig.module.rules.forEach( module => {
        if(module.loader !== 'vue-loader')
            return;
        module.options.cssModules = {
            localIdentName: '[name]-[hash:base64:5]',
            camelCase: true,
        };
    });
});

mix.cssModules().js('resources/assets/js/admin.js', 'public/js');

mix.cssModules().js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');


