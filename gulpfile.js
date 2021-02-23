var gulp = require('gulp'),
  concat = require('gulp-concat'),
  browserSync = require('browser-sync').create(),
  sass = require('gulp-sass');

function swallowError(error) {
  console.log(error.toString());
  this.emit('end');
}

gulp.task('default', function () {
  gulp.start('sass', 'watch');
});

// gulp.task('vendor', function () {
//   gulp.src([
//     './node_modules/jquery/dist/jquery.min.js'
//   ])
//     .pipe(concat('vendor.js'))
//     .pipe(gulp.dest('./'));
// });

// gulp.task('js', function () {
//   gulp.src([
//     './assets/js/home.js',
//     './assets/js/menu.js',
//     './assets/js/news.js',
//     './assets/js/gallery.js',
//     './assets/js/people.js',
//     './assets/js/map.js'
//   ])
//     .pipe(concat('scripts.js'))
//     .pipe(gulp.dest('./'));
// });

gulp.task('vendor', function () {
  gulp.src([
    './node_modules/jquery/dist/jquery.min.js'
  ])
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('./'));
});

gulp.task('sass', function () {
  gulp.src('./sass/style.scss')
    .pipe(sass({
      outputStyle: 'compressed'
    }))
    .on('error', swallowError)
    .pipe(gulp.dest('./css/'));
});

gulp.task('watch', function () {
  gulp.watch(['./sass/**/*.scss', './sass/*.scss'], ['sass']);
});