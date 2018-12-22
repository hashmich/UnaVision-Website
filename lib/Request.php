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
                $crumbs[$part] = ucwords(str_replace(array('_','-'), ' ', $part));
            }
            $this->title = $this->title.' - '.ucwords(str_replace(array('_','-'), ' ', end($expl)));
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
        $msg = null;
        ob_start();
        // check availability of the file in preferred language, use available language if not
        $msg = $this->_getLanguageContent($this->request);

        if(!empty($_SESSION['flash'])) {
            $msg = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        // render error message if no file exists, show homepage
        if(!file_exists('..'.DS.'webroot'.DS.$this->content_path)) {
            $msg = $this->getErrorMessage();
        }

        echo $msg;
        require $this->content_path;
        return ob_get_clean();
    }

    private function getErrorMessage() {
        $_SESSION['flash'] = '<div id="notification" style="display:none;"><div>'
            .'<p>The requested page does not exist.</p>'
            .'<p>Maybe you are using a link from the old website.</p>'
            .'</div></div>';
        header('Location: '.str_replace('webroot/index.php', '', $_SERVER['SCRIPT_NAME']));
        die();

    }

    private function _getLanguageContent($pageName = null) {
        if(!file_exists('..'.DS.'webroot'.DS.$this->content_path)) {
            foreach($this->accept_languages as $al) {
                $this->content_path = 'content'.DS.$al.DS.$pageName.'.php';
                if(file_exists('..'.DS.'webroot'.DS.$this->content_path)) {
                    return $this->getAlternativeLanguageMessage();
                    break;
                }
            }
        }
        return null;
    }

    private function getAlternativeLanguageMessage() {
        $alternatives = '[ <span class="lang-select' . ($this->language == 'en'?' active':'')
            . '" value="en">EN</span> |'
            .'<span class="lang-select' . ($this->language == 'de'?' active':'')
            . '" value="de">DE</span> ]';
        $msg = null;
        if($this->request != 'error') {
            switch($this->language) {
                case 'de':
                    $msg = '<p class="no-lang">Leider ist dieser Inhalt nicht auf Deutsch verfügbar.</p>'
                        . '<p class="language">Alternative Sprachen: ' . $alternatives . '</p>';
                    break;
                case 'en':
                    $msg = '<p class="no-lang">Sorry, this content is not available in English.</p>'
                        . '<p class="language">Alternative languages: ' . $alternatives . '</p>';
                    break;
                default:
                    $msg = '<p class="no-lang">Sorry, content not available in language: ' . $this->language . '</p>'
                        . '<p class="language">Alternative languages: ' . $alternatives . '</p>';
            }
            return '<div id="notification" style="display:none;"><div>'.$msg.'</div></div>';
        }
        return $msg;
    }



    public function getTheme() {
        switch($this->request) {
            case 'events':
            case 'unaversity':
            case 'vision-lab':
            case 'prototype':
                return 'unaversity';
            case 'unavillage':
            case 'locations':
            case 'cooperations':
                return 'unavillage';
            case 'vision':
            default:
                return 'unavision';
        }
    }


}

?>