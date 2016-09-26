module.exports = function(grunt) {

  // configure the tasks
  grunt.initConfig({
    
    //Copy all content for dist folder
    copy: {
      main: {
        src: ['**/*',  '!**/node_modules/**',  '!**/public/sass/**',  '!**/dist/**',  '!**/bin/**',  '!**/temp/**', '!**/templates/**','!.gitgnore','!package.json','!package.js','!bower.json','!Gruntfile.js'],
        expand: true,
        cwd: '',
        dest: 'dist',
      }
    },

    //SASS Compile css
    sass: {
      main: {
        options: {
          outputStyle: 'expanded',
          sourcemap: false,
        },
        files: {
          'public/assets/css/materialize.css': 'public/sass/materialize.scss',
          'public/assets/css/style.css': 'public/sass/style.scss',
          'public/assets/css/layouts/style-fullscreen.css': 'public/sass/theme-components/layouts/style-fullscreen.scss',
          'public/assets/css/layouts/style-horizontal.css': 'public/sass/theme-components/layouts/style-horizontal.scss',
          'public/assets/css/custom/custom.css': 'public/sass/custom/custom.scss'
        }
      },

      dist: {
        options: {
          outputStyle: 'compressed',
          sourcemap: false
        },
        files: {
          'dist/css/materialize.min.css': 'public/sass/materialize.scss',
          'dist/css/style.min.css': 'public/sass/style.scss',
          'dist/css/layouts/layout-2.min.css': 'public/sass/theme-components/layouts/style-fullscreen.scss',
          'dist/css/layouts/layout-3.min.css': 'public/sass/theme-components/layouts/style-horizontal.scss',
          'public/assets/css/custom/custom.min.css': 'public/sass/custom/custom.scss'
        }
      },


      // Compile ghpages css
      bin: {
        options: {
          style: 'expanded',
          sourcemap: false
        },
        files: {
          'bin/materialize.css': 'public/sass/materialize.scss',
          'bin/style.css': 'public/sass/style.scss',
          'bin/layouts/style-fullscreen.css': 'public/sass/theme-components/layouts/style-fullscreen.scss',
          'bin/layouts/style-horizontal.css': 'public/sass/theme-components/layouts/style-horizontal.scss',
          'public/assets/css/custom/custom.css': 'public/sass/custom/custom.scss'
        }
      }
    },

    //Browser Sync integration
    browserSync: {
      bsFiles: ["bin/*.js", "bin/*.css", "!**/node_modules/**/*"],
      options: {
          server: {
              baseDir: "./" // make server from root dir
          },
          port: 8000,
          ui: {
              port: 8080,
              weinre: {
                  port: 9090
              }
          },
          open: false
      }
    },

    //Concat js
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        // the files to concatenate
        src: [
              "public/assets/js/materialize-plugins/jquery.easing.1.3.js",
              "public/assets/js/materialize-plugins/animation.js",
              "public/assets/js/materialize-plugins/velocity.min.js",
              "public/assets/js/materialize-plugins/hammer.min.js",
              "public/assets/js/materialize-plugins/jquery.hammer.js",
              "public/assets/js/materialize-plugins/global.js",
              "public/assets/js/materialize-plugins/collapsible.js",
              "public/assets/js/materialize-plugins/dropdown.js",
              "public/assets/js/materialize-plugins/leanModal.js",
              "public/assets/js/materialize-plugins/materialbox.js",
              "public/assets/js/materialize-plugins/parallax.js",
              "public/assets/js/materialize-plugins/tabs.js",
              "public/assets/js/materialize-plugins/tooltip.js",
              "public/assets/js/materialize-plugins/waves.js",
              "public/assets/js/materialize-plugins/toasts.js",
              "public/assets/js/materialize-plugins/sideNav.js",
              "public/assets/js/materialize-plugins/scrollspy.js",
              "public/assets/js/materialize-plugins/forms.js",
              "public/assets/js/materialize-plugins/slider.js",
              "public/assets/js/materialize-plugins/cards.js",
              "public/assets/js/materialize-plugins/chips.js",
              "public/assets/js/materialize-plugins/pushpin.js",
              "public/assets/js/materialize-plugins/buttons.js",
              "public/assets/js/materialize-plugins/transitions.js",
              "public/assets/js/materialize-plugins/scrollFire.js",
              "public/assets/js/materialize-plugins/date_picker/picker.js",
              "public/assets/js/materialize-plugins/date_picker/picker.date.js",
              "public/assets/js/materialize-plugins/character_counter.js",
             ],
        // the location of the resulting JS file
        dest: 'dist/js/materialize.js'
      },
      temp: {
        // the files to concatenate
        src: [
              "public/assets/js/materialize-plugins/jquery.easing.1.3.js",
              "public/assets/js/materialize-plugins/animation.js",
              "public/assets/js/materialize-plugins/velocity.min.js",
              "public/assets/js/materialize-plugins/hammer.min.js",
              "public/assets/js/materialize-plugins/jquery.hammer.js",
              "public/assets/js/materialize-plugins/global.js",
              "public/assets/js/materialize-plugins/collapsible.js",
              "public/assets/js/materialize-plugins/dropdown.js",
              "public/assets/js/materialize-plugins/leanModal.js",
              "public/assets/js/materialize-plugins/materialbox.js",
              "public/assets/js/materialize-plugins/parallax.js",
              "public/assets/js/materialize-plugins/tabs.js",
              "public/assets/js/materialize-plugins/tooltip.js",
              "public/assets/js/materialize-plugins/waves.js",
              "public/assets/js/materialize-plugins/toasts.js",
              "public/assets/js/materialize-plugins/sideNav.js",
              "public/assets/js/materialize-plugins/scrollspy.js",
              "public/assets/js/materialize-plugins/forms.js",
              "public/assets/js/materialize-plugins/slider.js",
              "public/assets/js/materialize-plugins/cards.js",
              "public/assets/js/materialize-plugins/chips.js",
              "public/assets/js/materialize-plugins/pushpin.js",
              "public/assets/js/materialize-plugins/buttons.js",
              "public/assets/js/materialize-plugins/transitions.js",
              "public/assets/js/materialize-plugins/scrollFire.js",
              "public/assets/js/materialize-plugins/date_picker/picker.js",
              "public/assets/js/materialize-plugins/date_picker/picker.date.js",
              "public/assets/js/materialize-plugins/character_counter.js",
             ],
        // the location of the resulting JS file
        dest: 'temp/js/materialize.js'
      },
    },

    //Uglify js
    uglify: {
      
      dist: {
        options: {
          compress: true,
        },
        files: {
          'dist/js/materialize.min.js': ['dist/js/materialize.js'],
          'dist/js/plugins.min.js': ['dist/js/plugins.js']
        }
      },
      
      main: {
        options: {
          beautify: true,
        },
        files: {
          'public/assets/js/materialize.js': ['dist/js/materialize.js']
        }
      },
      
      bin: {
        files: {
          'bin/materialize.js': ['temp/js/materialize.js']
        }
      }
    },
    
    //Replace min css
    replace: {
    min: {
      src: ['*.html'],             // source files array (supports minimatch)
      dest: 'dist/',             // destination directory or file
      replacements: [{
        from: '/materialize.css',                   // string replacement
        to: '/materialize.min.css'
      },{
        from: '/style.css',                   
        to: '/style.min.css'
      },{
        from: '/custom.css',                   
        to: '/custom.min.css'
      },{
        from: '/materialize.js',                   
        to: '/materialize.min.js'
      },{
        from: '/plugins.js',                   
        to: '/plugins.min.js'
      }]
    }
  },

    //Clean folder 
    clean: {
    dist: {
       src: [ 'dist/' ]
     },
     temp: {
       src: [ 'temp/' ]
     },
   },


    //Watch for any files changes
    watch: {
      js: {
        files: [ "public/assets/js/**/*", "!public/assets/js/init.js"],
        tasks: ['js_compile'],
        options: {
          interrupt: false,
          spawn: false,
        },
      },

      sass: {
        files: ['public/sass/**/*'],
        tasks: ['sass_compile'],
        options: {
          interrupt: false,
          spawn: false,
        },
      }
    },


    //Concurrent
    concurrent: {
      options: {
        logConcurrentOutput: true,
        limit: 10,
      },
      monitor: {
        tasks: ["watch:js", "watch:sass", "notify:watching", 'server']
      },
    },


    //Notifications for task complition
    notify: {
      watching: {
        options: {
          enabled: true,
          message: 'Watching Files!',
          title: "Materialize", // defaults to the name in package.json, or will use project directory's name
          success: true, // whether successful grunt executions should be notified automatically
          duration: 1 // the duration of notification in seconds, for `notify-send only
        }
      },

      sass_compile: {
        options: {
          enabled: true,
          message: 'Sass Compiled!',
          title: "Materialize",
          success: true,
          duration: 1
        }
      },

      js_compile: {
        options: {
          enabled: true,
          message: 'JS Compiled!',
          title: "Materialize",
          success: true,
          duration: 1
        }
      },

      server: {
        options: {
          enabled: true,
          message: 'Server Running!',
          title: "Materialize",
          success: true,
          duration: 1
        }
      }
    },

  });

  // load the tasks  
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-clean');  
  grunt.loadNpmTasks('grunt-concurrent');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-text-replace');  
  grunt.loadNpmTasks('grunt-browser-sync');  
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  
  // define the tasks
  grunt.registerTask(
    'build',[
      'clean:dist',
      'sass:dist',
      'concat:temp',
      'concat:dist',
      'uglify:bin',
      'copy',
      'uglify:dist',
      'replace:min',
    ]
  );
  
  grunt.registerTask('js_compile', ['concat:temp', 'uglify:main', 'uglify:bin', 'notify:js_compile', 'clean:temp']);
  grunt.registerTask('sass_compile', ['sass:main', 'sass:bin', 'notify:sass_compile']);
  grunt.registerTask('server', ['browserSync', 'notify:server']);
  grunt.registerTask("monitor", ["concurrent:monitor"]);
};

