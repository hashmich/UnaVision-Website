<?php



class Request {
    private $accept_languages = array('de','en');
    private $default_lang = 'en';

    private $browser_lang;
    private $language;

    public $title = 'UnaVision';
    private $request = 'vision';
    private $crumbs = array();
    private $content_path;



    public function __construct() {
        // determine the user language, use default if not accepted language
        $this->browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $this->language = in_array($this->browser_lang, $this->accept_languages)
            ? $this->browser_lang
            : $this->default_lang;
        if(!empty($_COOKIE['language']) AND in_array($_COOKIE['language'], $this->accept_languages)) {
            $this->language = $_COOKIE['language'];
        }

        // go for the query parameter defined in .htaccess
        if(!empty($_GET['q'])) {
            $string = rtrim($_GET['q'], '/');
            $expl = explode('/', $string);
            $this->request = implode(DS, $expl);
            foreach($expl as $part) {
                $crumbs[$part] = ucfirst(str_replace(array('_','-'), ' ', $part));
            }
            $this->title = $this->title.' - '.ucfirst(str_replace(array('_','-'), ' ', end($expl)));
            $content_path = 'content'.DS.$this->language.DS.$this->request.'.php';
        }

        $this->content_path = 'content'.DS.$this->language.DS.$this->request.'.php';
    }



    public function getUserLanguage() {
        return $this->language;
    }

    public function getRequest() {
        return $this->request;
    }



    function getLanguageContent() {
        ob_start();
        // check availability of the file in preferred language, use available language if not
        if(!file_exists('..'.DS.'webroot'.DS.$this->content_path)) {
            echo $this->getMessage();
            foreach($this->accept_languages as $al) {
                $this->content_path = 'content'.DS.$al.DS.$this->request.'.php';
                if(file_exists('..'.DS.'webroot'.DS.$this->content_path)) {
                    $this->language = $al;
                    break;
                }
            }
        }
        // render error page if no file exists
        if(!file_exists('..'.DS.'webroot'.DS.$this->content_path)) {
            $this->content_path = 'content'.DS.'error.php';
            $title = 'Error';
        }

        require $this->content_path;
        return ob_get_contents();
    }

    private function getMessage() {
        switch($this->language) {
            case 'de':
                return '<p class="no-lang">Leider ist dieser Inhalt nicht auf Deutsch verfügbar.</p>';
            case 'en':
                return '<p class="no-lang">Sorry, this content not available in English.</p>';
            default:
                return '<p class="no-lang">Sorry, content not available in language: ' . $this->language . '</p>';
        }
    }
}

?>