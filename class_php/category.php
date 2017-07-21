<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
    <?php
        if(!empty($_POST)){
            if(empty($_POST["name"]))
                echo "Nom vide";
            elseif(empty($_POST["slug"]))
                echo "Slug vide";
            elseif(empty($_POST["image"]))
                echo "Image vide";
            else{
                require "crud.php";
                $mydb = new Crud("localhost", "root", "", "projetapp");
                $mydb->create($_POST, "category");
                echo '<ul class="list-group">
                    <li class="list-group-item list-group-item-success">Votre catégorie a été ajouter</li>
                </ul>';
            }
        }
    ?>
    <form class="form-horizontal" method="POST">
        <fieldset>

            <!-- Form Name -->
            <legend>Ajouter une categorie</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Name</label>  
                <div class="col-md-4">
                    <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required="">  
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="slug">Slug</label>  
                <div class="col-md-4">
                    <input id="slug" name="slug" type="text" placeholder="Slug" class="form-control input-md" required="">  
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="image">Image</label>  
                <div class="col-md-4">
                    <input id="image" name="image" type="text" placeholder="Image" class="form-control input-md" required=""> 
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="type">Type</label>
                <div class="col-md-4">
                    <select id="type" name="type" class="form-control">
                    <option value="category">Catégorie</option>
                    <option value="trend">Tendance</option>
                    </select>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">Validation</label>
                <div class="col-md-4">
                    <button id="singlebutton" class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </div>
        </fieldset>
    </form>

   </body>
</html>