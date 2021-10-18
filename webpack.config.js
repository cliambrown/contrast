const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    output: {
        filename: 'contrast.js',
    },
    plugins: [new MiniCssExtractPlugin({
        filename: 'contrast.css',
    })],
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            url: false,
                            importLoaders: 1
                        }
                    },
                    'postcss-loader'
                ],
            },
        ]
    }
}