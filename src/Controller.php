<?php

declare(strict_types=1);

namespace App;

require_once("View.php");

class Controller
{
    //test
    private View $view;
    private array $request;

    function __construct(array $request)
    {
        //$_GET and $_POST from index.php
        $this->request = $request;
        $this->view = new View();
    }


    //main function - passing a parameter to layout
    public function run(): void
    {
        //an array of parameters for layout
        $viewParams = [];
        //array of the days of the month for layout
        $tableDays = [];
        //check (validate) get and post and create parameters table 
        $viewParams = $this->checkRequest();
        //active page
        $page = $viewParams['page'];
        //create table of days for year and month        
        if ($page === "tableChoose")
            $tableDays = $this->createTableDay($viewParams);

        //passing parameters to View
        $this->view->render($page, $viewParams, $tableDays);
    }


    private function checkRequest(): array
    {

        //an array with parameters
        $params = [];
        //if there are data from $_GET
        if (isset($this->request['get']['year']) && isset($this->request['get']['mon'])) {
            //data validation 
            if (preg_match('/^(19[0-9][0-9]|20[0-9][0-9])$/', $this->request['get']['year']) && preg_match('/^([0-9]|1[012])$/', $this->request['get']['mon'])) {
                $params['year'] = (int) $this->request['get']['year'];
                $params['mon'] = (int) $this->request['get']['mon'];
                $params['monTxt'] = (string) $this->getMonTxt($params['mon']);

                //change (set) of month and year when switching from December to January and vice versa
                if ($this->request['get']['mon'] === "12") {
                    $params['monAdd'] = "1";
                    $params['yearAdd'] = $this->request['get']['year'] + 1;
                } else {
                    $params['monAdd'] = $this->request['get']['mon'] + 1;
                    $params['yearAdd'] = $this->request['get']['year'];
                }

                if ($this->request['get']['mon'] === "1") {
                    $params['monSub'] = "12";
                    $params['yearSub'] = $this->request['get']['year'] - 1;
                } else {
                    $params['monSub'] = $this->request['get']['mon'] - 1;
                    $params['yearSub'] = $this->request['get']['year'];
                }

                $date = getdate();
                $params['mday'] = $date['mday'];
                $params['flagRingDay'] = $this->getRingDay();
                $params['page'] = "tableChoose";
            } else {
                //with wrong date format in $ _GET
                $date = getdate();
                $params['year'] = $date['year'];
                $params['mon'] = $date['mon'];
                $params['day'] = $date['mday'];
                $params['page'] = "buttonSearch";
                return $params;
            }
            return $params;
        } else {
            //Start and end of the application. Display label and button
            //There are no variables $_GET (Start)
            //There are variables $_POST when we choose date        

            //Setting variables at the starting of the program               
            if (!isset($this->request['post']['yearPost']) && !isset($this->request['post']['monPost'])) {
                $date = getdate();
                $params['year'] = $date['year'];
                $params['mon'] = $date['mon'];
                $params['day'] = $date['mday'];
                //read variables after date selection
            } else {
                $params['day'] = $this->request['post']['dayPost'];
                $params['mon'] = $this->request['post']['monPost'];
                $params['year'] = $this->request['post']['yearPost'];
            }
            $params['page'] = "buttonSearch";
            return $params;
        }
    }


    //create table of days for year and month
    private function createTableDay(): array
    {
        $forYear = (int)$this->request['get']['year'];
        $forMon = (int)$this->request['get']['mon'];
        $tableOfDays = [];
        //checking which day of the week will be the 1st of the month for generating empty fields
        $noDayOfWeek = $this->getNoDayWeek($forYear, $forMon, 1);
        for ($i = 1; $i < $noDayOfWeek; $i++) {
            $tableDays[] = 0;
        }
        //creating a table with days after checking if the date exists
        for ($i = 1; $i < 32; $i++) {
            if ($this->checkDateExist($forYear, $forMon, $i)) {
                $tableDays[] = $i;
            }
        }
        return $tableDays;
    }


    //check if the date exist
    private function checkDateExist(int $yearChDt, int $monChDt, int $dayChDt): bool
    {
        $check = checkdate($monChDt, $dayChDt, $yearChDt);
        return $check;
    }


    //check the weekday number - blank fields in the days table
    private function getNoDayWeek(int $yearNoDa, int $monNoDa, int $dayNoDa): int
    {
        $dayWeek = date('N', strtotime($yearNoDa . "-" . $monNoDa . "-" . $dayNoDa));
        return (int)$dayWeek;
    }


    // get the text value of the month
    private function getMonTxt(int $thMon): string
    {
        switch ($thMon) {
            case '1':
                $monTxt = "January";
                break;
            case '2':
                $monTxt = "February";
                break;
            case '3':
                $monTxt = "March";
                break;
            case '4':
                $monTxt = "April";
                break;
            case '5':
                $monTxt = "May";
                break;
            case '6':
                $monTxt = "June";
                break;
            case '7':
                $monTxt = "July";
                break;
            case '8':
                $monTxt = "August";
                break;
            case '9':
                $monTxt = "September";
                break;
            case '10':
                $monTxt = "October";
                break;
            case '11':
                $monTxt = "November";
                break;
            case '12':
                $monTxt = "December";
                break;
            default:
                $monTxt = "No month specified";
                break;
        }
        return $monTxt;
    }

    //flag for the current year and month
    //mark the current day
    private function getRingDay(): bool
    {
        $date = getdate();
        if ($this->request['get']['mon'] === (string)$date['mon'] &&  $this->request['get']['year'] === (string)$date['year']) {
            return true;
        } else {
            return false;
        }
    }
}
