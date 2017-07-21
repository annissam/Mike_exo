<?php
namespace Model\News;

/**
 * Permet de gérer les catégories
 * @author Hugo LIEGEARD
 */
class Categorie
{
    
    # Déclaration des Variables
    private $IDCATEGORIE,
            $LIBELLECATEGORIE,
            $ROUTECATEGORIE;
    
    # Déclaration du Constructeur
    /**
     * Créer un Objet de la Classe Catégorie
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

