// Fix EventEmitter memory leak detected issue.
require('events').EventEmitter.prototype._maxListeners = 100;

// include gulp
var gulp = require('gulp');
// include plugins
var jshint = require('gulp-jshint');
var imagemin = require('gulp-imagemin');
var notify = require('gulp-notify');
var autoprefix = require('gulp-autoprefixer');
var compass = require('gulp-compass');
var uncss = require('gulp-uncss');
var concat = require('gulp-concat');
var minifyCSS = require('gulp-clean-css');
var uglify = require('gulp-uglify');

// JS minify
gulp.task('scripts', function () {
    return gulp.src('./src/js/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('./js/'));
});


// minify new images
gulp.task('images', function () {
    return gulp.src('./src/img/**/*')
        .pipe(imagemin({optimizationLevel: 3, progressive: true, interlaced: true}))
        .pipe(gulp.dest('./img'))
});


// Compile the Sass
gulp.task('compass', function () {
    gulp.src('./src/sass/*.scss')
        .pipe(compass({
            css: './src/css',
            sass: './src/sass'
        }))
        .pipe(gulp.dest('./src/css'));
});


// CSS concat, auto-prefix, optimise and minify
gulp.task('styles', function () {
    gulp.src(['./src/css/*.css'])
        .pipe(autoprefix('last 2 versions'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('./css/'));
});


// default gulp task
gulp.task('default', ['images', 'scripts', 'compass', 'styles'], function () {

    // watch for img optim changes
    gulp.watch('./src/img/*', function () {
        gulp.start('images');
    });

    gulp.watch('./src/img/**/*', function () {
        gulp.start('images');
    });

    // watch for JS changes
    gulp.watch('./src/js/*.js', function () {
        gulp.start('scripts');
    });

    // watch for Sass changes
    gulp.watch('./src/sass/*.scss', function () {
        gulp.start('compass');
    });

    // watch for CSS changes
    gulp.watch('./src/css/*.css', function () {
        gulp.start('styles');
    });

});
