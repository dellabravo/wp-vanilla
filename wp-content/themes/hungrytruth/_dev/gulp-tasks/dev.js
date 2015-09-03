// --------------
/*
  Author: Amin Meyghani
  Date: 10/02/2014
  Description: 
    Gulp Dev task: used for watching and auto reloading
*/
// --------------
var gulp = require('gulp');
var config= require('../gulp-config');
var browserSync = require('browser-sync');

gulp.task('browser-sync', function() {
  browserSync(config.browserSync);
});

gulp.task('bs-reload', function () {
    browserSync.reload();
});

gulp.task('dev', ['browser-sync'], function () {
  // JS + SASS
  gulp.watch(config.js.allSrc, ['bs-reload']);
  gulp.watch(config.sass.allSrc, ['sass-dev']);
  gulp.watch("../*.php", ['bs-reload']);
});

gulp.task('wp-watch-sass', function () {
  // JS + SASS
  // gulp.watch(config.js.allSrc, ['js-wp-dev']);
  gulp.watch(config.sass.allSrc, ['sass-dev']);
});

