// --------------
/*
  Author: Amin Meyghani
  Date: 10/02/2014
  Description: 
    Gulp task for building the sass and js files into the build folder.
*/
// --------------
var gulp = require('gulp');

//  Build SASS + JS
// gulp.task('build', ['sass', 'js']);

//  Build LESS + JS
// gulp.task('build', ['less', 'js']);

//  Build SASS + JS
gulp.task('build', ['sass-build', 'js-build', 'copy-fonts', 'critical']);

//  Build LESS + Coffee
// gulp.task('build', ['less', 'coffee']);


