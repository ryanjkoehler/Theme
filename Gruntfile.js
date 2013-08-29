module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      styleguide: {
        files: [ '*php', '*php', 'assets/sass/**.scss', 'assets/sass/**/**.scss', 'assets/javascript/**.js' ],
        tasks: [ 'compass:styleguide' ],
      },
      livereload: {
        options: {
          livereload: true
        },
        files: ['assets/stylesheets/**.css']
      },
      hogan: {
        files: [ 'assets/templates/**/*.html' ],
        tasks: [ 'hogan' ]
      },
      jshint: {
        files: ['assets/javascript/**.js'],
        tasks: 'jshint'
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
            './assets/sass',
            './package.json',
            './Gruntfile.js'
          ]
      }
    },
    hogan: {
      publish: {
        options: { 
          defaultName: function( file ) {
            // constructs a name for each template based on the 
            // path to the files
            var path = file.split('/');
            var name = '';
            if( path.length > 3 ){
              // if the file's in a sub directory of templates/ 
              // then use the directory name as a prefix for the template
              for( var i = 3; i < path.length - 1; i++ ){
                name += path[ i ];
                name += '--';
              }
            }
            // use the file name as part ( or all ) of the template name
            name += path[ path.length - 1 ].replace( '.html', '' );
            return name;
          }
        },
        files: {
          './assets/javascript/socd-hogan-templates.js': [ './assets/templates/**/*.html' ]
        }
      }
    },
    jshint: {
      files: ['Gruntfile.js', 'assets/javascript/maps.js'],
      options: {
        ignores: ['assets/javascript/socd-hogan-templates.js']
      }
    }
  });

  grunt.registerTask('build', ['compass']);

  grunt.loadNpmTasks('grunt-contrib-hogan');
  grunt.loadNpmTasks("grunt-contrib-compass");
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-contrib-jshint");
  grunt.loadNpmTasks("grunt-sftp-deploy");
};