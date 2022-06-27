const webpack = require('webpack'),
    path = require('path'),
    ExtractTextPlugin = require("extract-text-webpack-plugin"),
    autoprefixer = require('autoprefixer'),
    cssnano = require('cssnano'),
    browsersync = require('browser-sync-webpack-plugin'),
    CopyWebpackPlugin = require("copy-webpack-plugin");

config = {
    entry: {
        main: ['./js/main.js', './scss/main.scss']
    },
    output: {
        filename: 'js/[name].js',
        chunkFilename: "js/[name]_[chunkhash].js",
        path: path.resolve(__dirname, '../dist/'),
        publicPath: '/app/themes/giantpeach/dist/'
    },
    devtool: "source-map",
    module: {
        loaders: [{
                test: /\.js$/,
                exclude: '/node_modules/',
                use: {
                    loader: 'babel-loader',
                    query: {
                        presets: ['es2015'],
                        plugins: ["syntax-dynamic-import"]
                    }
                }
            },
            { // sass / scss loader for webpack
                test: /\.(sass|scss|css)$/,
                exclude: '/node_modules/',
                use: ExtractTextPlugin.extract({
                    use: [{
                            loader: 'css-loader?sourceMap'
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: true,
                                plugins: function() {
                                    return [autoprefixer, cssnano];
                                }
                            }
                        },
                        {
                            loader: 'resolve-url-loader?sourceMap'
                        },
                        {
                            loader: 'sass-loader?sourceMap'
                        }
                    ]
                })
            },
            {
                test: /\.(jpe?g|gif|png|svg)$/,
                use: {
                    loader: 'file-loader?name=./images/[hash].[ext]'
                }
            },
            {
                test: /\.(eot|otf|ttf|woff|woff2)$/,
                use: {
                    loader: 'file-loader?name=fonts/[name].[ext]'
                }
            },
            {
                test: /\.modernizrrc.js$/,
                loader: "modernizr-loader"
            },
            {
                test: /\.modernizrrc(\.json)?$/,
                loader: "modernizr-loader!json-loader"
            },
        ]
    },
    plugins: [
        new ExtractTextPlugin({ // define where to save the file
            filename: 'css/[name].css',
            allChunks: true,
            // publicPath: '/'
        }),
        new webpack.optimize.CommonsChunkPlugin({
            name: 'vendor',
            minChunks: function(module) {
                // this assumes your vendor imports exist in the node_modules directory
                return module.context && module.context.indexOf('node_modules') !== -1;
            }
        }),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        }),
        new browsersync({
            host: 'localhost',
            port: 3000,
            proxy: "http://www.igreppi.local:8888",
            open: false
        }),
        new CopyWebpackPlugin([
            {
                from: "static/img",
                to: "images"
            },
            {
                from: "static/js",
                to: "js"
            }
        ])

    ],
    resolve: {
        alias: {
            modernizr$: path.resolve(__dirname, ".modernizrrc")
        }
    }
}

module.exports = config;
