<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
session_start();

if( !isset($_SESSION['ostatniRefresh']) ) //sprawdź czy istnieje taka zmienna w sesji
{
    $_SESSION['ostatniRefresh'] = time(); //jeżeli nie istnieje taka zmienna w sesji to zapisz obecny czas
    $_SESSION['skladDrewna'] = 0;
    $_SESSION['skladStali'] = 0;
    $_SESSION['skladDesek'] = 0;
  
}
else
{
    $staryCzas = date('H:i:s d.m.Y', $_SESSION['ostatniRefresh']); // czas pierwszego odświeżenia strony
    $nowyCzas = date('H:i:s d.m.Y'); // czas teraz
    $iloscSekund = time() - $_SESSION['ostatniRefresh'];
    echo "Od $staryCzas do teraz ($nowyCzas) minęło $iloscSekund sekund<br>";
    $produkcjaDrewna = 1000;
    $_SESSION['skladDrewna'] += $iloscSekund * ( $produkcjaDrewna / 3600 );
    echo "Skład drewna: ".floor($_SESSION['skladDrewna'])."<br>";
    $produkcjaStali = 300;
    $_SESSION['skladStali'] += $iloscSekund * ($produkcjaStali / 3600);
    echo "Skład stali: ".floor($_SESSION['skladStali'])."<br>";
    

    $_SESSION['ostatniRefresh'] = time();
}

?>
<BUTTON type='submit' name='deski' method='post'>Przemień 5 drewna w 10 desek</BUTTON>
<?php
if ($_POST['deski']) {
$skladDrewna-=5;
$skladDesek+=10;
echo "Skład Desek wynosi:".floor($_SESSION['skladDesek'])."<br>";
}
?>

</body>
</html>