<?php
	
	$w_routes = array(
	    # Accueil
		['GET', '/', 'Default#home', 'default_home'],
	    ['GET', '/accueil.html', 'Default#home', 'default_accueil'],
	    
	    # Route pour Afficher les Articles d'une Cat�gorie
	    ['GET', '/categorie/[:categorie]', 'Default#categorie', 'default_categorie'],
	    
	    # Route pour Afficher un Article
	    ['GET', '/[:categorie]/[i:id]-[:slug].html', 'Default#article', 'default_article'],
	    
	    # Route pour Ajouter un Article
	    ['GET|POST', '/article/ajouter-un-article.html', 'Article#add', 'article_add'],
	    
	    # Ajouter une Adresse Email dans la Newsletter
	    ['POST', '/newsletter/add', 'Default#newsletteradd', 'default_newsletteradd'],
	);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	