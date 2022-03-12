<?php

class View
{
    //fichier vue
    private $_file;

    //titre de la page
    private $_pageTitle;

    function __construct($action)
    {
        $this->_file = 'views/view'.$action.'.php';   
    }

    //function qui vas générer et afficher la vue

    public function generate($data){
        //definir le contenu à envoyer
        $content = $this->generateFile($this->_file, $data);

        //template
        $view = $this->generateFile('views/template.php', array('pageTitle'=> $this->_pageTitle, 'content' => $content));
        echo $view;
    }

    private function generateFile($file, $data){
        if (file_exists($file)){
            extract($data);

            //temporisation
            ob_start();

            require $file;

            //arreter la temporisation
            return ob_get_clean();
        } else {
            throw new \Exception("Fichier ".$file." introuvable");
        }
    }
}