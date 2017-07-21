	$(function () {

		$("form").on("submit", function(e){
			e.preventDefault();
			alert("Mike");
			if($("#prependedtext").val()==""){
				console.log("Fail input");
				}
			if($("#textarea").val()=="delault text "){
				console.log("Fail input");
				}
			if($("#selectmultiple").val()== null "delault text "){
					console.log("Fail select");
		})






















		// A chaque s�lection de fichier
		$('#theForm').find('input[name="image"]').on('change', function (e) {
			var files = $(this)[0].files;

			if (files.length > 0) {
				// On part du principe qu'il n'y a qu'un seul fichier
				// �tant donn� que l'on a pas renseign� l'attribut "multiple"
				var file = files[0],
					$image_preview = $('#image_preview');

				// Ici on injecte les informations recolt�es sur le fichier pour l'utilisateur
				$image_preview.find('.thumbnail').removeClass('hidden');
				$image_preview.find('img').attr('src', window.URL.createObjectURL(file));
				$image_preview.find('h4').html(file.name);
				$image_preview.find('.caption p:first').html(file.size +' bytes');
			}
		});

		// Bouton "Annuler" pour vider le champ d'upload
		$('#image_preview').find('button[type="button"]').on('click', function (e) {
			e.preventDefault();

			$('#theForm').find('input[name="image"]').val('');
			$('#image_preview').find('.thumbnail').addClass('hidden');
		});
	});
