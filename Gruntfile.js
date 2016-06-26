module.exports = function(grunt)
{
    grunt.initConfig(
        {
            less: 
            {
                development: 
                {
                    options: 
                    {
                        //paths: ['public_html/styles/'],
                        compress: true
                    },
                    files: 
                    {
                        'public_html/styles/site.css': 'public_html/styles/site.less'
                    }
                }
            },
            uglify: 
            {
                my_target: 
                {
                    files: 
                    {
                        'public_html/scripts/site.min.js': ['public_html/scripts/maps.js', 'public_html/scripts/ready.js', 'public_html/scripts/addLocation.js']
                    }
                }
            },
            watch: 
            {
                css: 
                {
                    files: ['**/*.less'],
                    tasks: ['css'],
                    options: {
                    spawn: false,
                    },
                },
            },
    }); 

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.registerTask('css', ['less']); 
    grunt.registerTask('js', ['uglify']);
    grunt.registerTask('watchcss', ['watch:css']); 
};