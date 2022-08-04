const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,

    // proxy API requests to Valet during development
    devServer: {
        proxy: 'http://localhost'
    },

    // output built static files to Laravel's public dir.
    // note the "build" script in package.json needs to be modified as well.
    outputDir: __dirname+'/public',

    // modify the location of the generated HTML file.
    // make sure to do this only in production.
    indexPath: process.env.NODE_ENV === 'production'
        ? __dirname+'/resources/views/test.blade.php'
        : 'index.html'
})
