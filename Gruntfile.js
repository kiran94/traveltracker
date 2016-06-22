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
            watch: {
                scripts: {
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

    grunt.registerTask('css', ['less']); 
    grunt.registerTask('watch_css', ['watch']); 
};