<?php
use Model\Shortcut;
$this->layout('layout', ['title' => $article->TITREARTICLE, 'current' => ucfirst($categorie)]);
?>

<!-- Pour inclure du CSS -->
<?php $this->start('css') ?>
	<!-- Tout ce qui sera inclut ici, viendra se placer dans la section "css" du layout. -->
<?php $this->stop('css') ?>

<!-- Pour inclure le Contenu -->
<?php $this->start('contenu') ?>
    <div class="row">
        <!--colleft-->
        <div class="col-md-8 col-sm-12">
            <!--post-detail-->
            <article class="post-detail">
                <h1><?= $article->TITREARTICLE; ?></h1>
                <div class="meta-post">
                    <a href="#">
                        <?= $article->PRENOMAUTEUR; ?>	<?= $article->NOMAUTEUR; ?>
                    </a>
                    <em></em>
                    <span>
                        <?= $article->DATECREATIONARTICLE; ?>
                    </span>
                </div>
    
                <?= $article->CONTENUARTICLE; ?>
    
                <h5 class="text-right font-heading">
                	<strong>
                		<?= $article->PRENOMAUTEUR; ?>	<?= $article->NOMAUTEUR; ?>
                	</strong>
                </h5>
    
            </article>
            <!--social-detail-->
            <div class="social-detail">
                <span>   Partager notre article</span>
    
                <ul class="list-social-icon">
                    <li>
                        <a href="#" class="facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="google">
                            <i class="fa fa-google"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="youtube">
                            <i class="fa fa-youtube-play"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="pinterest">
                            <i class="fa fa-pinterest-p"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="rss">
                            <i class="fa fa-rss"></i>
                        </a>
                    </li>
    
                </ul>
            </div>
    
            <!--related post-->
            <div class="detail-caption">
                <span>  DANS LA MEME CATEGORIE</span>
            </div>
            <section class="spotlight-thumbs spotlight-thumbs-related">
                <div class="row">
                	<?php foreach ($suggestions as $suggestion) : ?>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="spotlight-item-thumb">
                                <div class="spotlight-item-thumb-img">
                                    <a href="<?= $this->url('default_article', [
            						    'categorie' => strtolower($suggestion->LIBELLECATEGORIE),
            						    'id'        => $suggestion->IDARTICLE,
            						    'slug'      => Shortcut::generateSlug($suggestion->TITREARTICLE)
            						]); ?>">
                                        <img alt="" src="<?= $this->assetUrl('images/product/'.$suggestion->FEATUREDIMAGEARTICLE); ?>">
                                    </a>
                                    <a href="#" class="cate-tag"><?= $suggestion->LIBELLECATEGORIE; ?></a>
                                </div>
                                <h3><a href="<?= $this->url('default_article', [
            						    'categorie' => strtolower($suggestion->LIBELLECATEGORIE),
            						    'id'        => $suggestion->IDARTICLE,
            						    'slug'      => Shortcut::generateSlug($suggestion->TITREARTICLE)
            						]); ?>"><?= $suggestion->TITREARTICLE; ?></a></h3>
                                <div class="meta-post">
                                    <a href="#">
                                        <?= $suggestion->PRENOMAUTEUR; ?> <?= $suggestion->NOMAUTEUR; ?>
                                    </a>
                                    <em></em>
                                    <span>
                                        <?= $suggestion->DATECREATIONARTICLE; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
<?php $this->stop('contenu') ?>

<!-- Pour inclure des scripts -->
<?php $this->start('script') ?>
	<!-- Tout ce qui sera inclut ici, viendra se placer dans la section "script" du layout. -->
<?php $this->stop('script') ?>













