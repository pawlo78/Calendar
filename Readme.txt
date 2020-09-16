PHP 7.4.10

$request : array(2) 
{ 
    ["post"]=> array(0) { } 
    ["get"]=> array(2) {         
        ["year"]=> string(4) "2020" 
        ["mon"]=> string(1) "9" 
    } 
}

$params : array(10) 
{ 
    ["year"]=> int(2020) 
    ["mon"]=> int(5) 
    ["monTxt"]=> string(3) "May" 
    ["monAdd"]=> int(6) ##month increase button 
    ["yearAdd"]=> string(4) "2023" ##year next to the month increase button 
    ["monSub"]=> int(4) ##month decrease button 
    ["yearSub"]=> string(4) "2023" ##year next to the month decrease button
    ["mday"]=> int(16) ##current day to be marked on the calendar 
    ["flagRingDay"]=> bool(false) ##the flag of the current month and year 
    ["page"]=> string(11) "tableChoose" ##active page for the layout 
} 