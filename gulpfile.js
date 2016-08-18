/**
 * Created by Администратор on 01.08.2016.
 */
var gulp = require('gulp');
gulp.task('hello', function() {
    console.log('Hello Zell');
});


var bsConfig = require("gulp-bootstrap-configurator");

// For CSS
gulp.task('make-bootstrap-css', function(){
    return gulp.src("./config.json")
        .pipe(bsConfig.css())
        .pipe(gulp.dest("./assets"));
    // It will create `bootstrap.css` in directory `assets`.
});

// For JS
gulp.task('make-bootstrap-js', function(){
    return gulp.src("./config.json")
        .pipe(bsConfig.js())
        .pipe(gulp.dest("./assets"));
    // It will create `bootstrap.js` in directory `assets`.
});