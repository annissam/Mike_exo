$(function(){
    /*
    "#form" => Id Form
    ".form" => Class Form"
    "form" => Balise Form
    */
    $("form") .submit(function(e){
        e.preventDefault();
        $.ajax({
            url:"classe.php",
            method:"POST",
            data:{
                marque: $("#marque").val(),
                modele: $("#modele").val(),
                annee: $("#annee").val(),
                couleur: $("#couleur").val(),
                nbPlace: $("#nbPlace").val(),
                nbPorte: $("#nbPorte").val(),
            }
        });
    });

})
