
var raml2html = require('gulp-raml2html');
var gulp = require('gulp');

gulp.task('apidoc', function() {
  return gulp.src('api.raml')
      .pipe(raml2html())
      .pipe(gulp.dest('.'));
});