<?php

class Article
{
    function getArticle()
    {
        $titre = $this->request->get('titre');
        $chapo = $this->request->get('chapo');
        $contenu = $this->request->get('contenu');
        $auteur = $this->request->get('auteur');
        $datePublication = $this->request->get('datePublication');
    }
}