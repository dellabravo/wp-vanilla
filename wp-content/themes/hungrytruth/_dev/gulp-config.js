// --------------
/*
  Author: Amin Meyghani
  Date: 10/02/2014
  Description: 
    Gulp config file
*/
// --------------
var assetRoot = "." + "/";
var path = require('path');
var gulp = require('gulp');
var date = new Date();
var time = date.getHours() + "" + date.getMinutes() + "" + date.getSeconds();

module.exports = {
	browserSync: {
    // sepearate non wordpress
		// proxy: "cooperman.local.com",
    proxy: "http://ht.local",
		// online: false, // for using a local network
		logLevel: "debug"
	},
  global: {
    assetRoot : assetRoot,
    buildFolder: "_build",
    buildLocation: "../_build",
    prodURL: "http://live-hungry-truth.pantheon.io",
    devURL: "http://dev-hungry-truth.pantheon.io",
  },
  lib: {
    assetRoot: assetRoot,
    location: path.join(assetRoot, 'lib'),
  },
  scripts: {
    assetRoot: assetRoot,
    outputName: "ht.js",
    outputDestination: path.join(assetRoot, 'js'),
    minFileName: "ht.min" + time + ".js",
    minFileRaw: "ht.min.js"
  },
  js: {
    assetRoot: assetRoot,
    src: path.join(assetRoot, 'js-src'),
    allSrc: path.join(assetRoot, 'js-src/**/*.js')
  },
  coffee: {
    assetRoot: assetRoot,
    src: path.join(assetRoot, 'coffee/main.coffee'),
    allSrc: path.join(assetRoot, 'coffee/**/*.coffee')

  },
  sass: {
    assetRoot: assetRoot,
    src: path.join(assetRoot, 'sass/main.scss'),
    allSrc: path.join(assetRoot, 'sass/**/*.scss'),
    destination: path.join(assetRoot),
    minFileName: "ht.min" + time + ".css",
    minFileNameRaw: "ht.min.css",
    devFileName: "ht.css"
  },
  less: {
    assetRoot: assetRoot,
    src: path.join(assetRoot, 'less/main.less'),
    allSrc: path.join(assetRoot, 'less/**/*.less'),
    destination: path.join(assetRoot, 'css'),
    minFileName: "ht.min.css",
    devFileName: "ht.css"
  },
  autoprefixer: {
    browsers: ['last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'firefox < 30']
  }

};