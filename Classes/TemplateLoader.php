<?php

require_once __dir__.'/../Config.php';
require_once $GLOBALS['TWIG_AUTOLOADER_PATH'];

class TemplateLoader {
    private $loader;
    private $twig;
    private $template = null;

    function __construct() {
        Twig_Autoloader::register();
        $this->loader = new Twig_Loader_Filesystem($GLOBALS['TEMPLATES_DIR']);
        $this->twig = new Twig_Environment(
                $this->loader,
                array(
                    'cache' => $GLOBALS['TWIG_CACHE_DIR']
                )
        );
    }

    function loadTemplate($pathToTemplate) {
        $this->template = $this->twig->loadTemplate($pathToTemplate);
    }

    function render($valuesArray) {
        if($this->template == null) {
            printf('Error: No template loaded\n');
            return null;
        }
        return $this->template->render($valuesArray);
    }
}
