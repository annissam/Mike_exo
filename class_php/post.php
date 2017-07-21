<?php
    require "gestion_post.php";
    $mydb = new Post("localhost", "root", "", "projetapp");
    $post = new Post("localhost", "root", "", "projetapp", 1);
?>
<html>
    <head>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
        <link rel="stylesheet" href="asset/css/bootstrap.css" crossorigin="anonymous">
    </head>
    <body>
        <?php
            if(!empty($_POST)){
                if(empty($_POST["title"]))
                    echo "Titre vide";
                elseif(empty($_POST["picture"]))
                    echo "Image vide";
                elseif(empty($_POST["description"]))
                    echo "Description vide";
                else{
                    $mydb->create($_POST, "post");
                    echo '<ul class="list-group">
                        <li class="list-group-item list-group-item-success">Votre post a été ajouter</li>
                    </ul>';
                }
            }
        ?>
        <div>
            <form class="form-horizontal" method="POST">
                <fieldset>

                <!-- Form Name -->
                <legend>Modifier Post</legend>
                <div class="">
                    <select id="id" name="id" class="form-control">
                        <option value='null'>Sélectionnez un post</option>
                        <?php
                            $posts = $mydb->read( array("id","title"), "post", array("1"=>"1"));
                            foreach($posts as $valeur)
                                echo "<option value='".$valeur["id"]."'>".$valeur["title"]."</option>";
                        ?>
                    </select><br/>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="title">Titre</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="title" name="title"><?= $post->title ?></textarea>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="picture">Image</label>
                    <div class="col-md-4">
                        <input id="picture" name="picture" type="text" placeholder="Url Image" class="form-control input-md" required="" valeu="<?= $post->picture ?>">
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="description">Description</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="description" name="description"><?= $post->title ?></textarea>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="category_id">Catégorie</label>
                    <div class="col-md-4">
                        <select id="category_id" name="category_id" class="form-control">
                            <?php
                                $category = $mydb->read( array("id","name"), "category", array("1"=>"1"));
                                foreach($category as $valeur)
                                    echo "<option value='".$valeur["id"]."'>".$valeur["name"]."</option>";
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="">Validation</label>
                    <div class="col-md-4">
                        <button id="" name="" class="btn btn-primary" type="submit">Envoyez</button>
                    </div>
                </div>

                </fieldset>
            </form>
        </div>
        <div>
            <form class="form-horizontal" method="POST">
                <fieldset>

                <!-- Form Name -->
                <legend>Ajouter Post</legend>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="title">Titre</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="title" name="title">default text</textarea>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="picture">Image</label>
                    <div class="col-md-4">
                        <input id="picture" name="picture" type="text" placeholder="Url Image" class="form-control input-md" required="">
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="description">Description</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="description" name="description">default text</textarea>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="category_id">Catégorie</label>
                    <div class="col-md-4">
                        <select id="category_id" name="category_id" class="form-control">
                            <?php
                                $category = $mydb->read( array("id","name"), "category", array("1"=>"1"));
                                foreach($category as $valeur)
                                    echo "<option value='".$valeur["id"]."'>".$valeur["name"]."</option>";
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="">Validation</label>
                    <div class="col-md-4">
                        <button id="" name="" class="btn btn-primary" type="submit">Envoyez</button>
                    </div>
                </div>

                </fieldset>
            </form>
        </div>
        <script src="asset/js/jquery-3.2.1.min.js"></script>
        <script src="asset/js/script.js"></script>
   </body>
</html>
