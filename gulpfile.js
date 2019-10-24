const { src, dest, watch, series, parallel } = require("gulp");
const sourcemaps = require("gulp-sourcemaps");
const babel = require("gulp-babel");
const browserSync = require("browser-sync").create(); /* Live reload */
const concat = require("gulp-concat"); /* Slå samman */
const uglify = require("gulp-uglify-es").default; /* Minimera js */
const sass = require("gulp-sass");
sass.compiler = require("node-sass");

/* Sökväg */
const files = {
  phpPrivate: "src/private/**/*.php",
  phpPublic: "src/public/**/*.php",
  jsPath: "src/public/js/**/*.js",
  scssPath: "src/public/scss/*.scss",
  imgPath:
    "src/images/**/*" /* Samtliga filer oavsett filtyp och underkataloger */,
  flPath: "src/public/featherlight/*"
};

/* Task: kopiera php i public foldern */
function copyPhpPrivate() {
  return src(files.phpPrivate)
    .pipe(dest("build/private"))
    .pipe(browserSync.stream()); /* browserSync läggs i slutet för initiering */
}

/* Task: kopiera php i public foldern */
function copyPhpPublic() {
  return src(files.phpPublic)
    .pipe(dest("build/public"))
    .pipe(browserSync.stream()); /* browserSync läggs i slutet för initiering */
}

/* Task: sammanslå js-filer, minifiera filer */
function jsTask() {
  return src(files.jsPath)
    .pipe(sourcemaps.init())
    .pipe(
      babel({
        presets: ["@babel/preset-env"]
      })
    )
    .pipe(sourcemaps.write("."))
    .pipe(dest("build/public/js"))
    .pipe(browserSync.stream());
}

/* Task: kopiera css och gör den ful */
function scssTask() {
  return src(files.scssPath)
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    .pipe(dest("build/public/css"))
    .pipe(browserSync.stream());
}

/* Task: kopiera img  */
function imgTask() {
  return src(files.imgPath)
    .pipe(dest("build/public/images"))
    .pipe(browserSync.stream());
}

/* Task: kopiera featherlight */
function copyFeatherlight() {
  return src(files.flPath)
    .pipe(dest("build/public/featherlight"))
    .pipe(browserSync.stream());
}

/* Task: watcher */
function watchTask() {
  /* Livereload med extra plugins */
  browserSync.init({
    proxy: "http://localhost/DT173G%20-%20Projekt/build/public",
    /* Tillåter andra enheter (mobiler ex.) på samma nätverk att ansluta till hemsidan */
    online: true,
    tunnel: true,
    logLevel: "debug"
  });

  watch(
    [
      files.phpPrivate,
      files.phpPublic,
      files.jsPath,
      files.scssPath,
      files.imgPath,
      files.flPath /* Featherlight */
    ],
    parallel(
      copyPhpPrivate,
      copyPhpPublic,
      jsTask,
      scssTask,
      imgTask,
      copyFeatherlight /* Featherlight */
    )
  ).on("change", browserSync.reload);
}

exports.default = series(
  parallel(
    copyPhpPrivate,
    copyPhpPublic,
    jsTask,
    scssTask,
    imgTask,
    copyFeatherlight /* Featherlight */
  ),
  watchTask
);
