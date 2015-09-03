// --------------
/*
  Author: Amin Meyghani
  Date: 10/26/2014
  Description: 
    Gulp task for compiling JS/Coffee files
*/
// --------------
var gulp = require('gulp');
var config      = require("../gulp-config");
var plugins     = require('gulp-load-plugins')({ camelize: true });

gulp.task('clean-build', function() {
  gulp.src('_build', {read: false})
          .pipe(plugins.clean());
});

gulp.task('copy-fonts', function() {
  gulp.src([ './fonts/*' ], { base: '.' })
    .pipe(gulp.dest(config.global.buildLocation));
});

gulp.task('copy-fonts-dev', function() {
  gulp.src([ './fonts/*' ], { base: '.' })
    .pipe(gulp.dest('..'));
});