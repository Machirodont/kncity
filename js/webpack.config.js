const path = require('path');

module.exports = {
    entry: './app.js',
    output: {
        filename: './bundle.js',
        library: 'knCity',
        path: path.resolve(__dirname, '../web/js'),
    },
    mode: 'development'
};