// --------------
/*
  Author: Amin Meyghani
  Date: 10/02/2014
  Description: 
    Gulp SASS Task
*/
// --------------
var gulp        = require('gulp'),
    plugins     = require('gulp-load-plugins')({ camelize: true }),
    path        = require('path'),
    plumber     = require('gulp-plumber'), // handle error and "broken pipes"
    config      = require('../gulp-config'),
    browserSync = require('browser-sync'),
    reload      = browserSync.reload;

// LESS tasks
// ------
// LESS: compile + minify (no source maps because everything is on one line)
gulp.task('less', function () {
  gulp.src(config.less.src)
    .pipe(plumber()) // prevent less from breaking on error.
    .pipe(plugins.less())
    .pipe(plugins.autoprefixer({
            browsers: config.autoprefixer.browsers,
            cascade: false
        }))
    .pipe(plugins.csso())
    .pipe(plugins.rename(config.less.minFileName))
    .pipe(gulp.dest(config.less.buildDestination))
});

// LESS dev, no minification, for development.
// source map is embeded in the final result.
gulp.task('less-dev', function () {
  gulp.src(config.less.src)
    .pipe(plumber()) // prevent less from breaking on error.
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.less())
    .pipe(plugins.sourcemaps.write())
    .pipe(plugins.autoprefixer({
            browsers: config.autoprefixer.browsers,
            cascade: false
        }))
    .pipe(plugins.rename(config.less.devFileName))
    .pipe(gulp.dest(config.less.destination))
    .pipe(reload({stream:true}));
});