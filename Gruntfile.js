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
            host: "unknowndomain.wpengine.com",
            port: 22,
            authKey: "wpengine-unknowndomain"
          },
          src: "./",
          dest: "./",
          exclusions: [
            './.DS_Store',
            './.git',
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