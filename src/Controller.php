<?php

declare(strict_types=1);
namespace App;
require_once("View.php");


class Controller 
{
    private View $view;
    private array $request; 

    function __construct(array $request)
    {
        //przekazanie parametru z indeksu - tablic get i post
        $this->request = $request;
        //var_dump($request);
        $this->view = new View();        
    }

    //główna funkcja przetwarzająca przed przekazaniem parametów do layoutu
    public function run() : void
    {
        //tabklica parametrów rok, miesiac i ktora strona wyswietlana
        $viewParams = [];
        //tablica z dniami i pustymi polami do przekazania
        $tableDays = [];
        //check get and post and create parameters table 
        $viewParams= $this->checkRequest();       
        
        //ustawienie strony ktora ma byc aktywna
        $page = $viewParams['page'];
        //create table of day from year and mon
        //generowanie tablicy do wyswietlenia w kalendarzu
        if($page === "tableChoose")
        $tableDays = $this->createTableDay($viewParams);

        //przekazanie parametrów do View
        $this->view->render($page, $viewParams, $tableDays);
    }



    private function checkRequest() : array
    {
        $params = [];
        //Drawing a calendar when we change the date in it (month or year)        
        //sprawdzenie czy sa dane z get, czyli dane do wyswietlenia kalendarza
        if(isset($this->request['get']['year']) && isset($this->request['get']['mon'])) {           
            //validation of the date 
            if(preg_match('/^(19[0-9][0-9]|20[0-9][0-9])$/', $this->request['get']['year']) && preg_match('/^([1-9]|1[012])$/', $this->request['get']['mon']))  {
                $params['year'] = (int) $this->request['get']['year'];
                $params['mon'] = (int) $this->request['get']['mon'];           
            } else {
                $date = getdate();
                $params['year'] = $date['year'];
                $params['mon'] = $date['mon'];           
            } 
            $params['page'] = "tableChoose";          
            return $params;        
        } else {
            //Start and end of the application. Display label and button
            //There are no variables $_GET (Start)
            //There are variables $_POST when we choose date        
            //Setting variables at the starting of the program               
            if(!isset($this->request['post']['year']) && !isset($this->request['post']['mon'])) {            
                $date = getdate();
                $params['year'] = $date['year'];
                $params['mon'] = $date['mon'];
                $params['day'] = $date['mday'];
                $params['page'] = "buttonSearch";
            //read variables after date selection
            } else { 
                $params['day'] = $this->request['post']['dayPost'];
                $params['mon'] = $this->request['post']['monPost'];
                $params['year'] = $this->request['post']['yearPost'];      
                $params['page'] = "buttonSearch";
            } 
            return $params;
        }        
    }

    //create table of day from year and mon
    private function createTableDay(array $params) : array
    {
        
        $forYear = $params['year'];
        $forMon = $params['mon'];
        $tableOfDays = [];
        //sprawdzenie ktory dniem tygodnia bedzie 1 dzień miesiąca dla generowania pustych pól
        $noDayOfWeek = $this->getNoDayWeek($forYear, $forMon, 1);
        for ($i=1; $i < $noDayOfWeek; $i++) { 
            $tableDays[] = 0; 
        }

            //tworzenie tablizy z dniami po sprawdzeniu czy data istnieje
        for ($i=1; $i < 32; $i++) { 
            if($this->checkDateExist($forYear, $forMon, $i))
            {
                $tableDays[] = $i;               
            }
        }              
        return $tableDays;        
    }

    //check if the date exist
    public function checkDateExist(int $yearChDt, int $monChDt, int $dayChDt) : bool {
        $check = checkdate($monChDt, $dayChDt, $yearChDt);
        return $check;     
    }

    //pobranie numeru dnia tygodnia, zeby wiedziec ile wolnych 
    //nienumerowanych pól jest na początku w kalendarzu
    //check the weekday number
    public function getNoDayWeek($yearNoDa, $monNoDa, $dayNoDa) {
        $dayWeek = date('N', strtotime($yearNoDa."-".$monNoDa."-".$dayNoDa));
        return $dayWeek;
    } 



       
      


























}