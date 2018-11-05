<?php

class Router {

    public static function basename() {
        if ( (! empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') ||
            (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ||
            (! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') ) {
            $server_request_scheme = 'https';
        } else {
            $server_request_scheme = 'http';
        }
        $string = $server_request_scheme.'://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
        return str_replace('index.php', '', $string);
    }

    /**
     * This function returns an app-internal URL, without preceeding webroot folder!
     *
     * @param null $url     the URL relative to the application/webroot folder
     * @return string
     */
    public static function url($url = null) {
        return rtrim(str_replace('webroot/', '', self::basename() . $url), '/');
    }

    /**
     * This function returns an URL relative to the application entry point,
     * either / or /webroot
     *
     * @param null $url     the URL relative to the webroot folder
     * @return string
     */
    public static function asset($url = null) {
        return rtrim(self::basename() . $url, '/');
    }
}
?>