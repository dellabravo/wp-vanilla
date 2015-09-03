// --------------
/*
  Author: Amin Meyghani
  Date: 10/02/2014
  Description: 
    Gulpfile manifest file
*/
// --------------
var dir = require('require-dir');

// Load all the taks
dir('./gulp-tasks', { recurse: true });
