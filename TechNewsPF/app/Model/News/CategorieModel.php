<?php
namespace Model\News;

class CategorieModel extends \W\Model\Model
{
    
    /**
     * Récupère les catégories depuis la BDD
     * @return Array Objet de type Categorie
     */
    public function getCategories() {
        
        // -- Je récupère les catégories depuis la BDD
        #$categories = $this->findAll();
        
        // : SELECT IDCATEGORIE, DISTINCT(LIBELLECATEGORIE) FROM view_articles
        $categories = \ORM::for_table('view_articles')
                            ->distinct()
                            ->select_many('IDCATEGORIE','LIBELLECATEGORIE')
                            ->find_array();
        
        #print_r($categories);
        
        // -- Je cr�er un tableau vide pour stocker mes objets de categorie
        $data = [];
        
        // -- Je parcours mes cat�gories et pour chacune d'elle, je cr�er un nouvel objet.
        // -- Je place cette objet "Categorie" dans mon tableau "data"
        foreach ($categories as $categorie) {
            $data[] = new Categorie($categorie['IDCATEGORIE'], $categorie['LIBELLECATEGORIE']);
        }
        
        #print_r($data);
        
        // -- Ma fonction renvoi le tableau comprenant les objets de type Categorie
        return $data;
       
    }
    
}

















