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
          src: "/Users/Luke/Documents/Work/work13/013 SOCD:GDNM/03 Build/wp-content/themes/socd",
          dest: "/wp-content/themes/socd",
          exclusions: [
            '/Users/Luke/Documents/Work/work13/013 SOCD:GDNM/03 Build/wp-content/themes/socd/.DS_Store',
            '/Users/Luke/Documents/Work/work13/013 SOCD:GDNM/03 Build/wp-content/themes/socd/.git',
            '/Users/Luke/Documents/Work/work13/013 SOCD:GDNM/03 Build/wp-content/themes/socd/node_modules',
            '/Users/Luke/Documents/Work/work13/013 SOCD:GDNM/03 Build/wp-content/themes/socd/.ftppass',
            '/Users/Luke/Documents/Work/work13/013 SOCD:GDNM/03 Build/wp-content/themes/socd/assets/.sass-cache',
          ]
      }
    }
  });

  grunt.loadNpmTasks("grunt-contrib-compass");
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-sftp-deploy");
}