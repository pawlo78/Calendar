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
            if(preg_match('/^(19[0-9][0-9]|20[0-9][0-9])$/', $this->request['get']['year']) && preg_match('/^([0-9]|1[0123])$/', $this->request['get']['mon']))  {
                 //warunek, istnieje data ale jest przejscie z grudnia na styczen
                //i odwrotnie - zmiana roku
                if( (int) $this->request['get']['mon'] === 0) {                    
                    $params['year'] = (int) $this->request['get']['year']-1;
                    $params['mon'] = (int) 12;
                    $params['monTxt'] = (string) $this->getMonTxt(12);                    
                }
                else if((int) $this->request['get']['mon'] === 13) {
                    $params['year'] = (int) $this->request['get']['year']+1;
                    $params['mon'] = (int) 1;
                    $params['monTxt'] = (string) $this->getMonTxt(1); 
                } else {                
                    $params['year'] = (int) $this->request['get']['year'];
                    $params['mon'] = (int) $this->request['get']['mon'];
                    $params['monTxt'] = (string) $this->getMonTxt($params['mon']);           
            } } else {               
                    //ar_dump($this->request['get']);
                    $date = getdate();
                    $params['year'] = $date['year'];
                    $params['mon'] = $date['mon'];
                    $params['monTxt'] = (string) $this->getMonTxt($params['mon']);           
                                      
            } 
            $params['page'] = "tableChoose";          
            return $params;        
        } else {
            //Start and end of the application. Display label and button
            //There are no variables $_GET (Start)
            //There are variables $_POST when we choose date        
            //Setting variables at the starting of the program               
            if(!isset($this->request['post']['yearPost']) && !isset($this->request['post']['monPost'])) {            
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
    public function getNoDayWeek(int $yearNoDa, int $monNoDa, int $dayNoDa) : int {
        $dayWeek = date('N', strtotime($yearNoDa."-".$monNoDa."-".$dayNoDa));
        return (int) $dayWeek;
    }
    

    // get the text value of the month
    public function getMonTxt(int $thMon) : string {              
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



       
      


























}