<?php
class Controller {
    
    public $model;
    public $view;
    public $model_a;
    public $model_c;
    public $model_t;
    
    function __construct()
    {
        include "application/models/model_comments.php";
        include "application/models/model_tags.php";
        $this->view = new View();
        $this->model = new Model();
        $this->model_a = new Model_articles();
        $this->model_c = new Model_comments();
        $this->model_t = new Model_tags();

    }

   } 
    ?>