/*
 * grunt-assets
 * 
 *
 * Copyright (c) 2013 Luke Watts
 * Licensed under the MIT license.
 */

'use strict';

var crypto = require('crypto');

module.exports = function(grunt) {

  // Please see the Grunt documentation for more information regarding task
  // creation: http://gruntjs.com/creating-tasks
  grunt.registerTask( 'assets', 'Cache busting generated CSS', function() {
    
    // Merge task-specific and/or target-specific options with these defaults.
    
    var options = this.options({
      enqueued_in: 'inc/assets.php'
    });

    var files = [
      'assets/build/screen.css',
      'assets/build/ie.css',
    ];

    cleanStart();

    var phpString = grunt.file.read( options.enqueued_in );

    for (var i = 0; i < files.length; i++) {
      var file = files[i],
          hash = md5(file);

      if (!grunt.file.exists(file)) continue;
      
      var filename = file.split('/').pop().split('.').shift();
      var filetype = file.split('/').pop().split('.').pop();

      grunt.file.copy( file, 'assets/dist/' + hash + '.' + filetype );

      var regexp = new RegExp( '(\\$' + filename + '_' + filetype + '\\s?=\\s?)(\'|\")[\\w\\/\\.]+\\2' , 'g');
      phpString = phpString.replace( regexp, '\$1\$2' + 'dist/' + hash + '.' + filetype + '\$2');
    };

    grunt.file.write(options.enqueued_in, phpString );
  
    cleanEnd();

  });


  var md5 = function(filepath) {
    var hash = crypto.createHash('md5'),
        output = hash.update(grunt.file.read(filepath)).digest('hex');

    grunt.log.write('Versioning ' + filepath + '...').ok(output + ".css");
    return output;
  };

  function cleanStart() {
      var del = grunt.file.expand( 'assets/dist/**.css' );
      for (var i = 0; i < del.length; i++) {
        grunt.file.delete( del[i] );
      };
  }

  function cleanEnd() {
    console.log("Clean up")
    grunt.file.delete( 'assets/build' );
  }
};
