// --------------
/*
  Author: Della Baines
  Date: 8/28/2015
  Description: 
    Gulp task for compiling JS/Coffee files
  Version: 1.1
*/
// --------------
var gulp = require('gulp');
var plugins     = require('gulp-load-plugins')({ camelize: true });
var browserSync = require('browser-sync');
var plumber     = require('gulp-plumber');
var config      = require("../gulp-config");
var reload      = browserSync.reload;

gulp.task('js-build', function() {
  gulp.src([
           config.lib.location + '/unveil/jquery.unveil.js',
           config.lib.location + '/fastclick/lib/fastclick.min.js',
           config.lib.location + '/jquery-cookie/jquery.cookie.min.js',
           config.lib.location + '/sticky-kit/jquery.sticky-kit.min.js',
           config.lib.location + '/imagesloaded/imagesloaded.pkgd.min.js',
           config.lib.location + '/masonry/dist/masonry.pkgd.min.js',
          config.js.src + '/main.js',
   ])
    .pipe(plumber()) // prevent pipe from breaking on error.
    .pipe(plugins.uglify())
    .pipe(plugins.concat("all.min.js"))
    .pipe(plugins.rename(config.scripts.minFileRaw))
    .pipe(gulp.dest(config.global.buildLocation))
});