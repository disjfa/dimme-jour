

module.exports = function(grunt) {

  var jsFiles = [
    "bower_components/html5shiv/dist/html5shiv.js",
    "bower_components/bootstrap/dist/js/bootstrap.js",
    "js/site-functions.js"
  ];

  grunt.initConfig({
    makepot: {
      target: {
        options: {
          type: 'wp-theme',
          domainPath: '/languages',
          language: ['nl', 'en'],
          updatePoFiles: true
        }
      }
    },
    po2mo: {
      files: {
        src: 'languages/*.po',
        expand: true
      }
    },
    less: {
      site: {
        options: {
          paths: ["."]
        },
        files: {
          "style.css": "less/style.less",
        }
      },
      editor: {
        options: {
          paths: ["."]
        },
        files: {
          "editor-style.css": "less/editor-style.less",
        }
      }
    },
    watch: {
      js: {
        files: "js/**.js",
        tasks: ['copy:js', "uglify"]
      },
      less: {
        files: "less/**.less",
        tasks: ['less']
      },
      cssmin: {
        files: ["style.css"],
        tasks: ['cssmin']
      }
    },
    cssmin: {
      dist: {
        files: {
          'style.min.css': "style.css",
        }
      }
    },
    uglify: {
      dist: {
        files: {
          'js/app.min.js': jsFiles,
        }
      }
    },
    copy: {
      js: {
        files: [
          {expand: true, flatten: true, src: jsFiles, dest: 'js/'},
        ]
      },
      fonts: {
        files: [
          {expand: true, flatten: true, src: ['bower_components/bootstrap/dist/fonts/*'], dest: 'fonts/'},
        ]
      }
    },
    compress: {
      main: {
        options: {
          archive: 'dimme-jour.zip'
        },
        files: [
          {
            src: ['**'],
            dest: '/',
            filter: function(path) {
              if (/^dimme-jour.zip$/.test(path) ||
                /^bower_components\b\/?/.test(path) ||
                /^node_modules\b\/?/.test(path)
                ) {
                return false;
              }
              return true;
            }
          }
        ]
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-wp-i18n');
  grunt.loadNpmTasks('grunt-po2mo');


  grunt.registerTask('make', ['less', 'copy:fonts', 'uglify']);
  grunt.registerTask('dist', ['make', 'makepot', 'po2mo', 'compress']);
  grunt.registerTask('watcher', ['make', 'watch']);

  grunt.registerTask('default', ['watcher']);

};
