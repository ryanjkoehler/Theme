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
      },
      hogan: {
        files: [ './assets/templates/src/**/*.html' ],
        tasks: [ 'hogan' ]
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
            './package.json',
            './Gruntfile.js'
          ]
      }
    },
    hogan: {
      publish: {
        options: {
          defaultName: function( file ) {
            var path = file.split('/');
            var name = '';
            if( path.length > 4 ){
              name += path[ path.length - 2 ];
              name += '--';
            }
            name += path[ path.length - 1 ].replace( '.html', '' );
            return name;
          }
        },
        files: {
          './assets/javascript/socd-hogan-templates.js': ['./assets/templates/src/**/*.html']
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-hogan');
  grunt.loadNpmTasks("grunt-contrib-compass");
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-sftp-deploy");
}