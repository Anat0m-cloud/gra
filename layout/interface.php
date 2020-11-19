<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="hud.css">
</head>
<body>
    <div id="lewo">
        <div id="gora"><?php
session_start();

if( !isset($_SESSION['ostatniRefresh']) ) //sprawdź czy istnieje taka zmienna w sesji
{
    $_SESSION['ostatniRefresh'] = time(); //jeżeli nie istnieje taka zmienna w sesji to zapisz obecny czas
    $_SESSION['skladDrewna'] = 0;
    $_SESSION['skladStali'] = 0;
    $_SESSION['skladKamieni'] = 0;
}
else
{
    $staryCzas = date('H:i:s d.m.Y', $_SESSION['ostatniRefresh']); // czas pierwszego odświeżenia strony
    $nowyCzas = date('H:i:s d.m.Y'); // czas teraz
    $iloscSekund = time() - $_SESSION['ostatniRefresh'];
   
    $produkcjaDrewna = 1000;
    $_SESSION['skladDrewna'] += $iloscSekund * ( $produkcjaDrewna / 3600 );
    echo "Skład drewna: ".floor($_SESSION['skladDrewna'])."<br>";
    
    $produkcjaStali = 300;
    $_SESSION['skladStali'] += $iloscSekund * ($produkcjaStali / 3600);
    echo "Skład stali: ".floor($_SESSION['skladStali'])."<br>";
    
    $produkcjaKamieni = 600;
    $_SESSION['skladKamieni'] += $iloscSekund * ($produkcjaKamieni / 3600);
    echo "Skład kamieni: ".floor($_SESSION['skladKamieni'])."<br>";
    
    $_SESSION['ostatniRefresh'] = time();
}

?></div>
        <div id="dol">
            <p>
                <a class="button" href="www.google.com">XD?</a>
                <a class="button" href="www.google.com">XD?</a>
                <a class="button" href="www.google.com">XD?</a>
                <a class="button" href="www.google.com">XD?</a>
                <a class="button" href="www.google.com">XD?</a>
                <a class="button" href="www.google.com">XD?</a>
                <a class="button" href="www.google.com">XD?</a>
                <a class="button" href="www.google.com">XD?</a>
            </p>
        </div>
    </div>
    <div id="prawo"></div>
    <div></div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>