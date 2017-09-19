module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
      bowerInstall: {
 
  target: {
 
    // Point to the files that should be updated when 
    // you run `grunt bower-install` 
            src: [
            './resources/views/master.blade.php'   // .html support...
            ]
        }
        },
    pkg: grunt.file.readJSON('package.json'), 
    watch: {
            bower: {
                files: ['bower.json'],
                tasks: ['bowerInstall']
            }
   
    }
  });


        
  // Load the plugin that provides the "uglify" task.
grunt.loadNpmTasks('grunt-bower-install');

  // Default task(s).
  grunt.registerTask('default', ['uglify']);

};
