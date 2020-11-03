const gulp                      = require('gulp'),
      del                       = require('del'),
      sourcemaps                = require('gulp-sourcemaps'),
      plumber                   = require('gulp-plumber'),
      sass                      = require('gulp-sass'),
      autoprefixer              = require('gulp-autoprefixer'),
      minifyCss                 = require('gulp-clean-css'),
      babel                     = require('gulp-babel'),
      webpack                   = require('webpack-stream'),
      uglify                    = require('gulp-uglify'),
      concat                    = require('gulp-concat'),
      imagemin                  = require('gulp-imagemin'),
      browserSync               = require('browser-sync').create(),

      src_folder                = './src/',
      dist_folder               = './dist/',
      node_modules_folder       = './node_modules/',
      dist_node_modules_folder  = dist_folder + 'node_modules/',

      node_dependencies         = Object.keys(require('./package.json').dependencies || {});

gulp.task('clear', () => del([ dist_folder ]));

gulp.task('sass', () => {
  return gulp.src([
    src_folder + 'sass/**/*.sass',
    src_folder + 'scss/**/*.scss'
  ], { since: gulp.lastRun('sass') })
    .pipe(sourcemaps.init())
      .pipe(plumber())
      .pipe(sass())
      .pipe(autoprefixer())
      .pipe(minifyCss())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(dist_folder + 'css'))
    .pipe(browserSync.stream());
});

gulp.task('js', () => {
  return gulp.src([ src_folder + 'js/**/*.js' ], { since: gulp.lastRun('js') })
    .pipe(plumber())
    .pipe(webpack({
      mode: 'production'
    }))
    .pipe(sourcemaps.init())
      .pipe(babel({
        presets: [ '@babel/env' ]
      }))
      .pipe(concat('custom.js'))
      .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(dist_folder + 'js'))
    .pipe(browserSync.stream());
});

gulp.task('images', () => {
  return gulp.src([ src_folder + 'images/**/*.+(png|jpg|jpeg|gif|svg|ico)' ], { since: gulp.lastRun('images') })
    .pipe(plumber())
    .pipe(imagemin())
    .pipe(gulp.dest(dist_folder + 'images'))
    .pipe(browserSync.stream());
});

gulp.task('fonts', () => {
  return gulp.src([ src_folder + 'fonts/**/*'], { since: gulp.lastRun('fonts') })
  .pipe(gulp.dest(dist_folder + 'fonts'))
});

gulp.task('vendor', () => {
  return gulp.src([ src_folder + 'vendor/**/*' ], {since: gulp.lastRun('vendor') }) 
  .pipe(gulp.dest(dist_folder + 'vendor'))
});


gulp.task('build', gulp.series('clear', 'sass', 'js', 'images', 'fonts', 'vendor'));

gulp.task('dev', gulp.series('sass', 'js'));

gulp.task('serve', () => {
  return browserSync.init({
    proxy: "http://localhost:8888/mycupcup", // put your local website link here
    port: 3000,
    open: false
  });
});

gulp.task('watch', () => {
  const watchImages = [
    src_folder + 'images/**/*.+(png|jpg|jpeg|gif|svg|ico)'
  ];

  const watchVendor = [
    src_folder + 'vendor/**/*'
  ];

  // node_dependencies.forEach(dependency => {
  //   watchVendor.push(node_modules_folder + dependency + '/**/*.*');
  // });

  const watch = [
    src_folder + 'sass/**/*.sass',
    src_folder + 'scss/**/*.scss',
    src_folder + 'js/**/*.js',
    src_folder + 'vendor/**/*'
  ];

  gulp.watch(watch, gulp.series('dev')).on('change', browserSync.reload);
  gulp.watch(watchImages, gulp.series('images')).on('change', browserSync.reload);
  gulp.watch(watchVendor, gulp.series('vendor')).on('change', browserSync.reload);
});

gulp.task('default', gulp.series('build', gulp.parallel('serve', 'watch')));
