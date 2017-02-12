// Gruntfile.js
module.exports = function(grunt) {
    // Task Configuration

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        notify_hooks: {
            enabled: true,
            max_jshint_notification: 5,
            title: 'Less',
            success: false,
            duration: 1
        },

        watch: {
            less: {
                files: 'less/*.less',
                tasks: ['less', 'notify:less', 'cssmin']
            }
        },

        less: {
            compileCore: {
                options: {
                    strictMath: true,
                    sourceMap: true,
                    outputSourceFiles: true,
                    sourceMapURL: '<%= pkg.name %>.css.map',
                    sourceMapFilename: '<%= pkg.name %>.css.map'
                },
                src: 'less/bootstrap.less',
                dest: '<%= pkg.name %>.css'
            },
        },

        cssmin: {
            options: {
                compatibility: 'ie8',
                keepSpecialComments: '*',
                sourceMap: true,
                sourceMapInlineSources: true,
                advanced: false
            },
            minifyCore: {
                src: '<%= pkg.name %>.css',
                dest: '<%= pkg.name %>.min.css'
            },
        },

        notify: {
            less: {
                options: {
                    message: 'Evolution People - Compilation Less to CSS done! ',
                    title: 'Less'
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-notify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.task.run('notify_hooks');

    grunt.registerTask('start', ['watch']);
};