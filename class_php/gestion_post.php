<?php

    require "crud.php";

    class Post extends Crud{

        public $id;
        public $title;
        public $picture;
        public $shares;
        public $comments;
        public $likes;
        public $liked;
        public $description;
        public $date_create;

        //  Constructeur -> Id par default null. Si une valeur est entrer dans l'id, c'est qu'une modification ou une supression est prevu su le post sinon c'est qu'un affichage de tout les post ou la creation d'un post est prevu
        function __construct($newHost, $newUser, $newPassword, $newDatabase, $id = null){
            parent::__construct($newHost, $newUser, $newPassword, $newDatabase);
            $this->table = "post";
            if($id != null){
                $data = $this->read(array("*"), $this->table, array("id"=>$id));
                $this->id = $data[0]["id"];
                $this->title = $data[0]["title"];
                $this->picture = $data[0]["picture"];
                $this->shares = $data[0]["shares"];
                $this->comments = $data[0]["comments"];
                $this->likes = $data[0]["likes"];
                $this->liked = $data[0]["liked"];
                $this->description = $data[0]["description"];
                $this->date_create = $data[0]["date_create"];
            }
        }

        public function updateShares(){
            $this->update( array("shares"=>$this->shares++), $this->table, array("id"=>$this->id)  );
        }

        public function updateComments(){
            $this->update( array("comments"=>$this->comments++), $this->table, array("id"=>$this->id)  );
        }

        public function updateLikes(){
            $this->update( array("likes"=>$this->likes++), $this->table, array("id"=>$this->id)  );
        }

        public function updateLiked(){
            if($this->liked == 1)
                $this->update( array("liked"=>0), $this->table, array("id"=>$this->id)  );
            else
                $this->update( array("liked"=>1), $this->table, array("id"=>$this->id)  );
        }
    }
