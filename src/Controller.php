<?php

declare(strict_types=1);
namespace App;
require_once("src\\View.php");


class Controller 
{
    private View $view;
    private array $request; 

    function __construct(array $request)
    {
        $this->request = $request;
        $this->view = new View();
    }

    public function run() : void
    {
        $viewParams = [];
        $page = "";

        $this->view->render($page, $viewParams);
    }
}