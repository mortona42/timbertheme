/**
 * Since I Left You Gulpfile
 */

var gulp        = require('gulp'),
    sass        = require('gulp-sass'),
    config      = require('./build.config.json');

var production;


// Task: Compile SASS
gulp.task('sass', function () {
  return gulp.src(config.scss.files)
    .pipe(sass())
    .pipe(gulp.dest(
        config.scss.dest
    ))
});


// Task: Watch files
gulp.task('watch', function () {

  // Watch Sass
  gulp.watch(
    config.scss.files,
    ['sass']
  );
});

gulp.task('default', function () {
  production = false;

  gulp.start(
    'sass'
  );
});