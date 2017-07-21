<?php 
    # Définition du Layout et de ses paramètres
    $this->layout('fulllayout', [
        'title'     => 'Ajouter un Article',
        'current'   =>  ''
    ]);
?>

<!-- Pour inclure du CSS -->
<?php $this->start('css') ?>
	<!-- Tout ce qui sera inclut ici, viendra se placer dans la section "css" du layout. -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha256-AWdeVMUYtwLH09F6ZHxNgvJI37p+te8hJuSMo44NVm0=" crossorigin="anonymous" />
<?php $this->stop('css') ?>

<!-- Pour inclure le Contenu -->
<?php $this->start('contenu') ?>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1">
			<form class="form-horizontal" enctype="multipart/form-data" method="POST">
				
				<h3>Ajouter un Article</h3>
				
				<!-- Titre de l'Article -->
				<div class="form-group">
					<label class="col-md-3 control-label">Titre de l'Article</label>
					<div class="col-md-7">
						<input type="text" name="TITREARTICLE"
							placeholder="Titre de l'Article" class="form-control">
					</div>
				</div>
				
				<!-- Auteur -->
				<div class="form-group">
					<label class="col-md-3 control-label">Auteur</label>
					<div class="col-md-7">
						<select name="IDAUTEUR" class="form-control" required>
							<?php foreach ($auteurs as $auteur) : ?>
								<option value="<?= $auteur->IDAUTEUR ?>">
									<?= $auteur->PRENOMAUTEUR ?> <?= $auteur->NOMAUTEUR ?>
								</option>
							<?php endforeach; ?>							
						</select>
					</div>
				</div>
				
				<!-- Catégorie -->
				<div class="form-group">
					<label class="col-md-3 control-label">Catégorie</label>
					<div class="col-md-7">
						<select name="IDCATEGORIE" class="form-control" required>
							<?php foreach ($categories as $categorie) : ?>
								<option value="<?= $categorie->IDCATEGORIE ?>">
									<?= $categorie->LIBELLECATEGORIE ?>
								</option>
							<?php endforeach; ?>							
						</select>
					</div>
				</div>
				
				<!-- Contenu -->
				<div class="form-group">
					<label class="col-md-3 control-label">Description</label>
					<div class="col-md-7">
						<textarea name="CONTENUARTICLE" class="form-control"></textarea>
					</div>
				</div>
				
				<!-- Featured Image (File) -->
				<div class="form-group">
					<label class="col-md-3 control-label">
						Featured Image <em>(Image à la Une)</em></label>
					<div class="col-md-7">
						<input type="file" name="FEATUREDIMAGEARTICLE"
							class="dropify" data-max-file-size="2M">
					</div>
				</div>
				
				<!-- Options (SPECIAL et SPOTLIGHT) -->
				<div class="form-group">
					<label class="col-md-3 control-label">Options</label>
					<div class="col-md-7">
						<div class="checkbox">
							<label>
								<input type="hidden" name="SPECIALARTICLE" value="0">
								<input type="checkbox" name="SPECIALARTICLE" value="1">
								Sp&eacute;cial
							</label>
							<label>
								<input type="hidden" name="SPOTLIGHTARTICLE" value="0">
								<input type="checkbox" name="SPOTLIGHTARTICLE" value="1">
								Spotlight
							</label>
						</div>
					</div>
				</div>
				
				<!-- Submit -->
				<div class="form-group">
					<div class="col-xs-7 col-xs-offset-3">
						<button type="submit" class="btn btn-primary" value="Publier">
							Publier</button>
					</div>
				</div>
			</form>
		</div>
	
<?php $this->stop('contenu') ?>

<!-- Pour inclure des scripts -->
<?php $this->start('script') ?>
	<!-- Tout ce qui sera inclut ici, viendra se placer dans la section "script" du layout. -->
	<script src="//cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha256-SUaao5Q7ifr2twwET0iyXVy0OVnuFJhGVi5E/dqEiLU=" crossorigin="anonymous"></script>
	<script>
        CKEDITOR.replace( 'CONTENUARTICLE' );
        $('.dropify').dropify({
			messages: {
				default: 'Glissez-d&eacute;posez un fichier ici ou cliquez',
            	replace: 'Glissez-d&eacute;posez un fichier ou cliquez pour remplacer',
            	remove:  'Supprimer',
            	error:   'D&eacute;sol&eacute;, le fichier trop volumineux'
			}	
        });
    </script>
    
    
<?php $this->stop('script') ?>

















