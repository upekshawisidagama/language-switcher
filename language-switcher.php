<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Lang Switcher WordPress Plugin
 *
 * This php script is a 'WordPress Plugin' to change the WordPress Lang 
 * (WP_LANG) according to the visitors browser language. Find the WordPress 
 * specific plugin description below.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   WordPressPlugin
 * @package    UW
 * @author     Upeksha Wisidagama <developer@bapml.com>
 * @copyright  2012-2013 BaPML Lab
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    1.0
 *
 * WordPress Specific Plugin header, to be parsed by WordPress.
 *
 * Plugin Name: Language Switcher
 * Plugin URI: http://upekshawisidagama.github.com/language-switcher
 * Description: Changes WordPress Language to the Browser Language.
 * Version: 1.0
 * Author: Upeksha Wisidagama 
 * Author URI: http://upekshawisidagama.github.com/language-switcher
 */

/* Forbid direct access to the file (i.e without WordPress). */
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

/**
 * Lang Switcher
 *
 * Switches WP_LANG according to the browser language.
 *
 * A class to be instantiated as a global variable during WordPress plugin
 * loading( Place this file in WP_PLUGIN_DIR ). Global variable, an instance
 * of this class, hooks methods to change WordPress language to the visitors 
 * browser language during instantiation.
 *
 * @access public
 * @todo Extra Features
 *  - manual change of language via select box or buttons.
 *  - admin bar dropdown box to change language.
 */
class Lang_Switcher
{
    /**
     * Construct the Language Switcher Object
     *
     * Hook, Filter and Return the desired locale
     * according to the visiting browser.
     *
     * @filter locale
     */
    function __construct(){
        add_filter('locale', array($this, 'browser_language'), 90);
    }

    /*
     * Extract and return visitor's browser language.
     *
     * Extract the visiting browser language with HTTP_ACCEPT_LANGUAGE
     * server var. Use it's first two letters to identify the browser
     * language. Return new language code.
     *
     * @global  $_SERVER 
     * @param   string $locale current locale of WordPress. Default locale set
     *          WP_LANG constant.
     * @return  string new locale
     */
    function browser_language($locale){

        /* Can we get an idea of visitors browser language. */
        if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])):

            /* Get the first two letters. */
            $locale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            /* Is that Spanish? */
            $locale = 'es' === $locale ? 'es_ES' : 'en_EN';

            /* Return new locale. */
            return $locale;

        endif;

        /* Return what we were given. */
        return $locale;
    }

}

/* Instantiate the Language Switcher. */
$lang_switcher = new Lang_Switcher();
?>
