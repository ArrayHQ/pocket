module.exports = function(grunt) {

    // Configure tasks
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {
            css: {
                files: ['**/*.scss'],
                tasks: ['autoprefixer', 'csscomb'],
                options: {
                    spawn: false,
                    livereload: true,
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1', 'ie 9']
            },
            single_file: {
                src: 'style.css',
                dest: 'style.css'
            }
        },

        csscomb: {
            options: {
                config: '.csscomb.json'
            },
            files: {
                'style.css': ['style.css'],
            }
        },

        // Generate RTL stylesheet
        cssjanus: {
            theme: {
                options: {
                    swapLtrRtlInUrl: false
                },
                files: [
                    {
                        src: 'style.css',
                        dest: 'rtl.css'
                    }
                ]
            }
        },

        // Generate POT
        makepot: {
            theme: {
                options: {
                    type: 'wp-theme'
                }
            }
        },

        shell: {
            makeDir: {
                command: 'zip -r ../pocket.zip ../pocket -x@../exclude.lst'
            }
        }
    });

    // Watch
    grunt.loadNpmTasks('grunt-contrib-watch');

    // CSSComb
    grunt.loadNpmTasks('grunt-csscomb');

    // Autoprefixer
    grunt.loadNpmTasks('grunt-autoprefixer');

    // Replace
    grunt.loadNpmTasks('grunt-string-replace');

    // Shell
    grunt.loadNpmTasks('grunt-shell');

    // Generate RTL
    grunt.loadNpmTasks('grunt-cssjanus');

    // Generate POT
    grunt.loadNpmTasks('grunt-wp-i18n');

    // Register tasks
    grunt.registerTask('default', [
        'watch',
        'autoprefixer',
        'csscomb',
        'string-replace',
        'shell',
        'cssjanus'
    ]);

    // Build for Creative Market
    grunt.registerTask('creative', ['shell', 'string-replace' ])

};
