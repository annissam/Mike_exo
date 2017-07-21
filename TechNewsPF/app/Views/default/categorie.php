<?php
use Model\Shortcut;
$this->layout('layout', ['title' => 'TechNews | '.ucfirst($categorie), 'current' => ucfirst($categorie)]);
?>

<!-- Pour inclure du CSS -->
<?php $this->start('css') ?>
	<!-- Tout ce qui sera inclut ici, viendra se placer dans la section "css" du layout. -->
<?php $this->stop('css') ?>

<!-- Pour inclure le Contenu -->
<?php $this->start('contenu') ?>
<?php 
    #debug($articles);
?>
	<div class="row">
        <!--colleft-->
        <div class="col-md-8 col-sm-12">
            <div class="box-caption">
                <span><?= $categorie; ?></span>
            </div>
            <!--list-news-cate-->
            <div class="list-news-cate">
                  <?php foreach ($articles as $article) : ?>      
                        <article class="news-cate-item">
                            <div class="row">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <a href="<?= $this->url('default_article', [
            						    'categorie' => strtolower($article->LIBELLECATEGORIE),
            						    'id'        => $article->IDARTICLE,
            						    'slug'      => Shortcut::generateSlug($article->TITREARTICLE)
            						]); ?>">
                                        <img alt="<?= $article->TITREARTICLE; ?>" src="<?= $this->assetUrl('images/product/'.$article->FEATUREDIMAGEARTICLE); ?>">
                                    </a>
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <h3><a href="<?= $this->url('default_article', [
            						    'categorie' => strtolower($article->LIBELLECATEGORIE),
            						    'id'        => $article->IDARTICLE,
            						    'slug'      => Shortcut::generateSlug($article->TITREARTICLE)
            						]); ?>"><?= $article->TITREARTICLE; ?></a></h3>
                                    <div class="meta-post">
                                        <a href="#">
                                            <?= $article->PRENOMAUTEUR; ?> <?= $article->NOMAUTEUR; ?>
                                        </a>
                                        <em></em>
                                        <span>
                                            <?= $article->DATECREATIONARTICLE; ?>
                                        </span>
                                    </div>
                                    <p><?= Shortcut::getAccroche($article->CONTENUARTICLE); ?></p>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>    
            </div>
    
        </div>
<?php $this->stop('contenu') ?>

<!-- Pour inclure des scripts -->
<?php $this->start('script') ?>
	<!-- Tout ce qui sera inclut ici, viendra se placer dans la section "script" du layout. -->
<?php $this->stop('script') ?>













