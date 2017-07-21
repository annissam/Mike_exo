<?php
namespace Model\News;

/**
 * Permet de g�rer les cat�gories
 * @author Hugo LIEGEARD
 */
class Categorie
{
    
    # D�claration des Variables
    private $IDCATEGORIE,
            $LIBELLECATEGORIE,
            $ROUTECATEGORIE;
    
    # D�claration du Constructeur
    /**
     * Cr�er un Objet de la Classe Cat�gorie
     * @param Entier $IDCATEGORIE
     * @param String $LIBELLECATEGORIE
     * @param String $ROUTECATEGORIE
     */
    public function __construct(
        $IDCATEGORIE,
        $LIBELLECATEGORIE,
        $ROUTECATEGORIE = null) {
        
            $this->IDCATEGORIE      = $IDCATEGORIE;
            $this->LIBELLECATEGORIE = $LIBELLECATEGORIE;
            $this->ROUTECATEGORIE   = $ROUTECATEGORIE;
    }
    
    # Les getters
            
    /**
     * @return the $IDCATEGORIE
     */
    public function getIDCATEGORIE()
    {
        return $this->IDCATEGORIE;
    }

    /**
     * @return the $LIBELLECATEGORIE
     */
    public function getLIBELLECATEGORIE()
    {
        return $this->LIBELLECATEGORIE;
    }

    /**
     * @return the $ROUTECATEGORIE
     */
    public function getROUTECATEGORIE()
    {
        return $this->ROUTECATEGORIE;
    }

    
    
    
    
}

