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
    reload      = browserSync.reload,
    minifyCSS = require('gulp-minify-css'),
    fs = require('fs'),
    request = require('request'),
    criticalcss = require("criticalcss"),
    tmpDir = require('os').tmpdir();


// SASS tasks
// ------
// wordpress sass dev
gulp.task('sass-dev',['copy-fonts-dev'], function () {
  gulp.src(config.sass.src)
    .pipe(plumber()) // prevent sass from breaking on error.
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sass())
    .pipe(plugins.sourcemaps.write())
    .pipe(plugins.autoprefixer({
            browsers: config.autoprefixer.browsers,
            cascade: false
        }))
    .pipe(plugins.rename("style.css"))
    .pipe(gulp.dest(".."))
    .pipe(reload({stream:true}));
});

// wordpress sass build
gulp.task('sass-build', function () {
  gulp.src(config.sass.src)
    .pipe(plumber()) // prevent sass from breaking on error.
    .pipe(plugins.sass())
    .pipe(plugins.autoprefixer({
            browsers: config.autoprefixer.browsers,
            cascade: false
        }))
    .pipe(minifyCSS({noAdvanced: true}))
    .pipe(plugins.rename(config.sass.minFileNameRaw))
    .pipe(gulp.dest(config.global.buildLocation))
});

// inline critical css
/*gulp.task('critical', ['sass-build', 'copystyles'], function () {
    fs.readFile(config.browserSync.proxy, {encoding: 'utf-8'}, function(err,html){
        critical.generateInline({
            inline: false,
            html: html,
            src: '../_build/index.html',
            base: './',
            css: ['../_build/'+config.sass.minFileNameRaw],
            dest: '../_build/critical.css',
            minify: false
        });
    });
    

});*/

gulp.task('critical', ['sass-dev'], function() {  

  var cssUrl = config.browserSync.proxy + '/wp-content/themes/hungrytruth/style.css';
  var cssPath = path.join( tmpDir, 'style.css' );
  var includePath = path.join( config.global.assetRoot, '/inc/critical.css.php' );
  request(cssUrl).pipe(fs.createWriteStream(cssPath)).on('close', function() {
    criticalcss.getRules(cssPath, function(err, output) {
      if (err) {
        throw new Error(err);
      } else {
        criticalcss.findCritical(config.global.devURL, { rules: JSON.parse(output) }, function(err, output) {
          if (err) {
            throw new Error(err);
          } else {

            fs.writeFile(includePath, output, function(err) {
              if(err) {
                return console.log(err);
              }
              console.log("Critical written to include!");
            });

          }
        });
      }
    });
  });

});

gulp.task('copystyles', function () {
    return gulp.src(['_build/'+config.sass.minFileNameRaw])
        .pipe(plugins.rename({
            basename: "site" // site.css
        }))
        .pipe(gulp.dest('_build/'));
});