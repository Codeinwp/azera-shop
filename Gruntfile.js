// jshint node:true

module.exports = function( grunt ) {
    'use strict';

    var loader = require( 'load-project-config' ),
        config = require( 'grunt-theme-fleet' );
    config = config();
    config.files.php.push( [ '!inc/admin/**/*.php', '!class-tgm-plugin-activation.php', '!ti-customizer-notify/**/*.php' ] );
    config.files.js.push( [ '!inc/admin/**/*.js', '!js/bootstrap.js', '!js/bootstrap.min.js', '!js/html5shiv.js', '!js/html5shiv.min.js', '!js/skip-link-focus-fix.js', '!js/plugin.home.js', '!ti-customizer-notify/**/*.js' ] );
    config.files.css.push( [ '!ti-customizer-notify/**/*.css' ] );
    loader( grunt, config ).init();
};