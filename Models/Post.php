<?php
    class Post{
        var $id;
        var $author;
        var $title;
        var $body;
        var $datePosted;
        var $removed;
        
        function __construct($id, $author, $title, $body, $rawDate, $removed){
            $this->id = $id;
            $this->author = $author;
            $this->title = $title;
            $this->body = $body;
            $this->datePosted = date("Y-m-d H:i:s", strtotime($rawDate));
            $this->removed = $removed;
        }
    }
?>