const gulp = require('gulp');
const sass = require('gulp-sass');
const clean = require('gulp-clean-css');

function style() {
  return (
    gulp
      .src("scss/*.scss")
      .pipe(sass())
      .on("error", sass.logError)
      .pipe(clean())
      .pipe(gulp.dest("./"))
  );
}

function watch() {
  gulp.watch('scss/*.scss', style)
}

exports.watch = watch
exports.style = style;
