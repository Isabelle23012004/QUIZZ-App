<?php

class HomeController {
    protected $model;

    public function __construct() {
        $this->model = new HomeModel();
    }

    public function index() {
        $data = $this->model->getData();
        include '../app/Views/home.php';
    }
}