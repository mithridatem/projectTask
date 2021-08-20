var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));

gulp.task(('styles'),  function(){
    return gulp.src('./css/scss/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'));
})


gulp.task(('watch'),function () {
    gulp.watch('./css/scss/*.scss', gulp.series('styles'));
})

