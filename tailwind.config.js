module.exports = {
    mode: 'jit',
    purge: {
        enabled: true,
        content: [
            './**/*.html',
            './**/*.php',
            './src/*.js',
            './img/**/*.svg'
        ],
    },
}