const gulp = require('gulp');
const php = require('gulp-connect-php');
const spawn = require('child_process').spawn;

gulp.task('php', function() {
  php.server({
    base: 'www',
    port: 3000,
    hostname: '0.0.0.0',
    keepalive: true
  });
});

gulp.task('install', function() {
  spawn('composer', ['update'], {stdio: 'inherit'});
  spawn('bower', ['install'], {stdio: 'inherit', cwd: 'www'});
});

gulp.task('default', ['php']);
