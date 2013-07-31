module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      styleguide: {
        files: ['*php', '*php', 'assets/sass/**/*.scss', 'assets/sass/*.scss'],
        tasks: ['compass:styleguide'],
        options: {
          livereload: true
        }
      }
    },
    compass: {
      styleguide: {
        options: {
          basePath: 'assets/',
          sassDir: 'sass',
          cssDir: 'stylesheets'
        }
      }
    },
    "sftp-deploy": {
      build: {
          auth: {
            host: "socd.wpengine.com",
            port: 22,
            authKey: "socd"
          },
          src: "./",
          dest: "./wp-content/themes/socd/",
          exclusions: [
            './.DS_Store',
            './.git*',
            './node_modules',
            './.ftppass',
            './assets/.sass-cache',
          ]
      }
    }
  });

  grunt.loadNpmTasks("grunt-contrib-compass");
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-sftp-deploy");
}