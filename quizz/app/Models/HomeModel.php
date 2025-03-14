<?php

class HomeModel {
    public function getData() {
        // This method would typically interact with a database to fetch data.
        // For now, we'll return a sample array of data.
        return [
            'title' => 'Welcome to My PHP MVC App',
            'content' => 'This is a simple MVC application built with PHP.'
        ];
    }
}