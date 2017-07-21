<?php
namespace Model;

class Shortcut
{

    /**
     *
     * @param unknown $CONTENUARTICLE
     * @return string
     */
    public static function getAccroche($CONTENUARTICLE) {
    
        // : http://php.net/manual/fr/function.mb-strimwidth.php
    
        // strip tags to avoid breaking any html
        $string = strip_tags($CONTENUARTICLE);
    
        if (strlen($string) > 170) {
    
            // truncate string
            $stringCut = substr($string, 0, 170);
    
            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
        }
        return $string;
    }
    
    /**
     * Créer un SLUG à partir du Titre d'un Article
     * http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
     * @param String $titre
     * @return String $slug
     */
    public static function generateSlug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
    
        // trim
        $text = trim($text, '-');
    
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
    
        // lowercase
        $text = strtolower($text);
    
        if (empty($text)) {
            return 'n-a';
        }
    
        return $text;
    }
    
}



















