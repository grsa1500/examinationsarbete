module.exports = {
    root: true,
    env: {
        browser: true,
        jquery: true,
    },
    plugins: ['jquery'],
    extends: [
        'airbnb-base',
        'plugin:jquery/deprecated',
    ],
    rules: {
        'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'indent': [2, 4],
    },
    globals: {},
    parserOptions: {
        parser: 'babel-eslint',
    },
};
