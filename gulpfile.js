'use strict';

var fs          = require( 'fs' );
var gulp        = require( 'gulp' );
var clean 		= require( 'gulp-clean');
var sass 		= require( 'gulp-sass');
var imagemin    = require( 'gulp-imagemin' );
var jshint      = require( 'gulp-jshint' );
var cleanCSS    = require( 'gulp-clean-css');
var gulpconcat  = require( 'gulp-concat' );
var uglify      = require( 'gulp-uglify' );
var gulpconfig  = require( './gulpconfig' );
var pkg         = require( './package.json' );

require( 'colors' );



gulp.task( 'jshint', function() {
	var stream = gulp.src( [ gulpconfig.dirs.js + '/main.js' ] )
		.pipe( jshint() )
		.pipe( jshint.reporter( 'default' ) );

	return stream;
});



gulp.task( 'uglify', [ 'jshint' ], function() {
	gulp.src([
		gulpconfig.dirs.js + '/libs/*.js', 	// External libs/plugins
		gulpconfig.dirs.js + '/main.js',   	// Custom JavaScript
		gulpconfig.dirs.js + '/pace.min.js'	// Loading bar
	])
	.pipe( gulpconcat( 'main.min.js' ) )
	.pipe( uglify() )
	.pipe( gulp.dest( gulpconfig.dirs.js ) );
});






gulp.task('sass', [ 'clean' ], function () {
  return gulp.src( gulpconfig.dirs.sass + '/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest(gulpconfig.dirs.css));
});


// gulp.task('minify-css', function() {
//   return gulp.src(gulpconfig.dirs.css + '/**/*')
//     .pipe(cleanCSS({compatibility: 'ie8'}))
//     .pipe(gulp.dest('dist'));
// });


gulp.task( 'watch', function() {
	var watchers = [
		gulp.watch( gulpconfig.dirs.sass + '/**/*', [ 'sass' ] ),
		gulp.watch( gulpconfig.dirs.js + '/**/*.js', [ 'uglify' ] )
	];

	watchers.forEach(function( watcher ) {
		watcher.on( 'change', function( e ) {
			// Get just filename
			var filename = e.path.split( '/' ).pop();
			var bars = '\n================================================';

			console.log( ( bars + '\nFile ' + filename + ' was ' + e.type + ', runing tasks...' + bars ).toUpperCase() );
		});
	});
});



gulp.task( 'imagemin', function() {
	gulp.src( gulpconfig.dirs.images + '/**/*.{jpg, png, gif}' )
	.pipe(
		imagemin({
			optimizationLevel: 7,
			progressive: true
		})
	)
	.pipe( gulp.dest( gulpconfig.dirs.images ) );
});

gulp.task( 'clean', function() {
	var dirs = gulpconfig.dirs;

	gulp.src([
		dirs.css + '/*'
	], { read: false })
	.pipe( clean({ force: true }) );
});

gulp.task('clear', function () {
   cache.clearAll();
 });


/**
 * Execution Tasks
 */
gulp.task( 'default', [ 'jshint', 'sass', 'uglify' ] );
gulp.task( 'optimize', [ 'imagemin' ] );
