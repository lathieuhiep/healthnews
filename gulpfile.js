'use strict';

const {src, dest, watch} = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const babel = require('gulp-babel')
const webpack = require('webpack-stream')
const browserSync = require('browser-sync')
const concat = require('gulp-concat')
const uglify = require('gulp-uglify')
const minifyCss = require('gulp-clean-css')
const concatCss = require('gulp-concat-css')
const rename = require("gulp-rename")
const TerserPlugin = require('terser-webpack-plugin')
const autoprefixer = require('gulp-autoprefixer')

const pathAssets = './assets'
const pathNodeModule = './node_modules'

// server
function server() {
    browserSync.init({
        proxy: "localhost/suckhoedanang",
        open: false,
        cors: true,
        ghostMode: false
    })
}

/*
Task build fontawesome
* */
function buildFontawesomeStyle() {
    return src([
        './node_modules/@fortawesome/fontawesome-free/scss/fontawesome.scss',
        './node_modules/@fortawesome/fontawesome-free/scss/solid.scss',
        './node_modules/@fortawesome/fontawesome-free/scss/regular.scss',
        './node_modules/@fortawesome/fontawesome-free/scss/brands.scss',
    ])
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(concatCss('fontawesome.css'))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/fontawesome/css`))
        .pipe(browserSync.stream())
}

function buildFontawesomeWebFonts() {
    return src([
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.ttf',
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff2',
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-regular-400.ttf',
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-regular-400.woff2',
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-brands-400.ttf',
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-brands-400.woff2',
    ])
        .pipe(dest(`${pathAssets}/libs/fontawesome/webfonts`))
        .pipe(browserSync.stream());
}

/*
Task build Bootstrap
* */

// Task build style bootstrap
function buildStylesBootstrap() {
    return src(`${pathAssets}/scss/bootstrap.scss`)
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/bootstrap/`))
        .pipe(browserSync.stream());
}

// Task build js bootstrap
function buildLibsBootstrapJS() {
    return src([
        `${pathNodeModule}/bootstrap/js/dist/offcanvas.js`
    ])
        .pipe(babel())
        .pipe(webpack({
            mode: 'production',
            output: {
                filename: 'bootstrap.js'
            },
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        exclude: /node_modules/,
                        use: {
                            loader: 'babel-loader'
                        }
                    }
                ]
            },
            optimization: {
                minimize: true,
                minimizer: [
                    new TerserPlugin({
                        terserOptions: {
                            output: {
                                comments: false,
                            },
                        },
                        extractComments: false,
                    }),
                ],
            },
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/bootstrap/`))
        .pipe(browserSync.stream());
}

/*
Task build owl carousel
* */
function buildStylesOwlCarousel() {
    return src(`${pathNodeModule}/owl.carousel/dist/assets/owl.carousel.css`)
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/owl.carousel/`))
        .pipe(browserSync.stream());
}

function buildJsOwlCarouse() {
    return src([
        `${pathNodeModule}/owl.carousel/dist/owl.carousel.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/owl.carousel/`))
        .pipe(browserSync.stream());
}

// Task build style
function buildStylesTheme() {
    return src(`${pathAssets}/scss/style-theme.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/`))
        .pipe(browserSync.stream());
}

// Task build style elementor
function buildStylesElementor() {
    return src(`${pathAssets}/scss/elementor-addon/elementor-addon.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`./extension/elementor-addon/css/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`./extension/elementor-addon/css/`))
        .pipe(browserSync.stream());
}

// Task build style custom post type
function buildStylesCustomPostType() {
    return src(`${pathAssets}/scss/post-type/*/**.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/post-type/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/post-type/`))
        .pipe(browserSync.stream());
}

// Task build style templates
function buildStylesTemplates() {
    return src(`${pathAssets}/scss/templates/*.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/templates/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/templates/`))
        .pipe(browserSync.stream());
}

// buildJSTheme
function buildJSTheme() {
    return src([
        `${pathAssets}/js/*.js`,
        `!${pathAssets}/js/*.min.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/js/`))
        .pipe(browserSync.stream());
}

/*
Task build project
* */
async function buildProject() {
    await buildFontawesomeStyle()
    await buildFontawesomeWebFonts()

    await buildStylesBootstrap()
    await buildLibsBootstrapJS()

    await buildStylesOwlCarousel()
    await buildJsOwlCarouse()

    await buildStylesTheme()
    await buildStylesElementor()
    await buildStylesCustomPostType()
    await buildStylesTemplates()

    await buildJSTheme()
}

exports.buildProject = buildProject

// Task watch
function watchTask() {
    server()

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/bootstrap.scss`
    ], buildStylesBootstrap)

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/base/*.scss`,
        `${pathAssets}/scss/style-theme.scss`,
    ], buildStylesTheme)

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/elementor-addon/*.scss`
    ], buildStylesElementor)

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/post-type/*/**.scss`
    ], buildStylesCustomPostType)

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/templates/*.scss`
    ], buildStylesTemplates)

    watch([`${pathAssets}/js/*.js`, `!${pathAssets}/js/*.min.js`], buildJSTheme)

    watch([
        './**/*.js',
        './*.php',
        './**/*.php',
        './assets/images/*/**.{png,jpg,jpeg,gif}'
    ], browserSync.reload);
}

exports.watchTask = watchTask