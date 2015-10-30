var elixir = require('laravel-elixir');

elixir(function (mix) {
    mix.sass('app.scss', 'public/css');

    mix.styles([
        'bootstrap/dist/css/bootstrap.min.css',
        'bootstrap-social/bootstrap-social.css',
        'fontawesome/css/font-awesome.min.css',
        'sweetalert/dist/sweetalert.css',
        'select2/dist/css/select2.min.css'
    ], 'public/css/vendor.css', 'vendor/bower-components');

    mix.styles([
        'vendor.css',
        'app.css'
    ], null, 'public/css');

    mix.coffee('app.coffee', 'public/js');

    mix.scripts([
        'jquery/dist/jquery.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'sweetalert/dist/sweetalert.min.js',
        'select2/dist/js/select2.min.js',
        'jquery.countdown/dist/jquery.countdown.min.js'
    ], 'public/js/vendor.js', 'vendor/bower-components');

    mix.scripts([
        'vendor.js',
        'app.js'
    ], null, 'public/js');

    mix.version([
        'public/css/all.css',
        'public/js/all.js'
    ]);
});
