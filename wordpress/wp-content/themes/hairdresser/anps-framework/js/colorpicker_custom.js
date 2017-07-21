jQuery(document).ready(function( $ ) {
    'use strict';
    var currentlyClickedElement = '';
  	
    $('.color-pick-color').bind("click", function(){ 
        currentlyClickedElement = this;
    });
  	
    /* Scheme Creator */

    /*var allColors = [];

    $('input[type="text"]').each(function() {
        allColors.push($(this).val());
    });

    console.log(allColors);*/

    $('.color-pick-color').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).css("background","#"+hex);
            $(el).attr("data-value", "#"+hex);
            $(el).parent().children(".color-pick").val("#"+hex);
            $(el).ColorPickerHide();
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor($(this).attr("data-value"));
        },
        onChange: function (hsb, hex, rgb) {
            $(currentlyClickedElement).css("background","#"+hex);
            $(currentlyClickedElement).attr("data-value", "#"+hex);
            $(currentlyClickedElement).parent().children(".color-pick").val("#"+hex);
        }
    })
    .on('keyup', function(){
        $(this).ColorPickerSetColor(this.value);
    });
	 
    $('.color-pick').on('keyup', function(){
        $(this).parent().children(".color-pick-color").css("background", $(this).val());
    });
    
    var default_val = new Array("#727272", "#940855", "#BD1470", "#000", "#000000", "#bf5a91", "#940855", "#141414", "#0d0d0d", "#adadad", "#fff", "#4a4a4a", "#fff", "#fff", "#000", "", "", "", "#940855", "#fff", "#BD1470", "#fff", "#940855", "#fff", "#BD1470", "#fff", "#940855", "#fff", "#BD1470", "#fff", "#940855", "#940855", "#ffffff", "#940855", "#940855", "#BD1470", "#940855", "#fff", "#BD1470", "#fff", "#c3c3c3", "#fff", "#737373", "#fff");
    var purple = new Array("#727272", "#292929", "#8249a1", "#000", "#000000", "#c1c1c1", "#f9f9f9", "#6c358c", "#401759", "#c4aad4", "#fff", "#8755a6", "#fff", "#fff", "#000", "", "", "", "#292929", "#fff", "#8249a1", "#fff", "#8249a1", "#fff", "#9e5fc2", "#fff", "#8249a1", "#ffffff", "#9e5fc2", "#ffffff", "#8249a1", "#8249a1", "#ffffff", "#8249a1", "#000", "#8249a1", "#8249a1", "#fff", "#aa6acf", "#fff", "#c3c3c3", "#fff", "#737373", "#fff");
    var blue = new Array("#727272", "#292929", "#1b9eb8", "#000", "#000000", "#c1c1c1", "#f9f9f9", "#13879c", "#074854", "#4bb2c4", "#fff", "#1f7787", "#fff", "#fff", "#000", "", "", "", "#292929", "#fff", "#1b9eb8", "#fff", "#1b9eb8", "#fff", "#29b6cf", "#fff", "#1b9eb8", "#ffffff", "#29b6cf", "#ffffff", "#1b9eb8", "#1b9eb8", "#ffffff", "#1b9eb8", "#000", "#1b9eb8", "#1b9eb8", "#fff", "#108296", "#fff", "#c3c3c3", "#fff", "#737373", "#fff");
    var green   = new Array("#727272", "#292929", "#76b81a", "#000", "#000000", "#c1c1c1", "#f9f9f9", "#4d6e1e", "#314710", "#8ba664", "#fff", "#6d824e", "#fff", "#fff", "#000", "", "", "", "#292929", "#fff", "#76b81a", "#fff", "#76b81a", "#fff", "#76b81a", "#fff", "#76b81a", "#ffffff", "#76b81a", "#ffffff", "#76b81a", "#76b81a", "#ffffff", "#76b81a", "#000", "#76b81a", "#76b81a", "#fff", "#54870c", "#fff", "#c3c3c3", "#fff", "#737373", "#fff");  

    $("#predefined_colors label").on("click", function(){ 
        var table; 	
        switch($('input', this).val()) {
            case "default" :
                table = default_val;
                break;
            case "purple" :
                table = purple;
                break;
            case "blue" :
                table = blue;
                break;
            case "green" :
                table = green;
                break;
        }

        $(".color-pick").each(function(index){
            $(".color-pick").eq(index).val(table[index]);
            $(".color-pick").eq(index).parent().children(".color-pick-color").css("background", table[index]);
            $(".color-pick").eq(index).parent().children(".color-pick-color").attr("data-value", table[index]);
        });
    });
    $(".input-type").on('change', function(){
        if($(this).val() == "dropdown") {
            $(this).parent().parent().children(".validation").hide();
            $(this).parent().parent().children(".label-place-val").children("label").html("Values");
        }
        else {
            $(this).parent().parent().children(".validation").show();
            $(this).parent().parent().children(".label-place-val").children("label").html("Placeholder");
        }
    });
});