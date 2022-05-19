import gulp from 'gulp';
import {
	stylesFront,
	stylesAdmin,
	scriptsFront,
	scriptsAdmin,
	isDeploy,
	// images,
	// fonts,
	cleanAssets,
} from './tasks.js';
import when from 'gulp-if';

// Watch

export const watch = () => {
	gulp.watch( 'styles/front/**/*.*', gulp.series( stylesFront ) );
	gulp.watch( 'styles/admin/**/*.*', gulp.series( stylesAdmin ) );
	gulp.watch( 'scripts/front/**/*.*', gulp.series( scriptsFront ) );
	gulp.watch( 'scripts/admin/**/*.*', gulp.series( scriptsAdmin ) );
	// gulp.watch( 'src/images/**/*.{jpg,jpeg,png,webp,svg,gif}', images );
	// gulp.watch( 'src/fonts/**/*.{woff,woff2}', fonts );
};

// Default

export default gulp.series(
	cleanAssets,
	gulp.parallel(
		stylesFront,
		stylesAdmin,
		scriptsFront,
		scriptsAdmin
		// images,
		// fonts
	),
	watch
);

// build

export const build = gulp.series(
	cleanAssets,
	gulp.parallel(
		stylesFront,
		stylesAdmin,
		scriptsFront,
		scriptsAdmin
		// images,
		// fonts
	)
);
