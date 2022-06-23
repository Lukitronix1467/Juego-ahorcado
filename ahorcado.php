<!DOCTYPE html>

<html>

    <head>        

        <title>Juego Ahorcado</title>

    </head>

    <body bgcolor="lightblue">

        <form action="" method="post" name="formletra" id="formletra">

            <p align="center">letra: <input type="text" name="letra" id="letra" autofocus></p>

            

            <p align="center"><input type="submit" name="Verificar" id="Verificar" value="Verificar"></p>

        </form>

    </body>

</html>

<?php

    session_start();    

    

    if ($_SESSION['primeravez']){

        

        $_SESSION['intentos'] = -1;

        $_SESSION['palabraingresada'] = $_POST['palabra'];    

        $_SESSION['longitud'] = strlen($_SESSION['palabraingresada']);

        

        if ($_SESSION['palabraingresada'] == ''){

            $_SESSION['longitud'] = -1;

            echo '<script type = "text/javascript">

            alert("Debe ingresar una palabra");

            function redireccionar(){

                window.location="index.php";

            } 

            setTimeout ("redireccionar()", 1);

        </script>';

        }

        

        $_SESSION['permitidos'] = " -abcdefghijklmnopqrstuvwxyz";

        for ($i=0; $i<$_SESSION['longitud']; $i++){

           if (stripos($_SESSION['permitidos'], substr($_SESSION['palabraingresada'],$i,1)) === false){

              echo '<script type = "text/javascript">

            alert("La palabra no puede contener TILDES, NUMEROS o Caracteres Especiales");

            function redireccionar(){

                window.location="index.php";

            } 

            setTimeout ("redireccionar()", 1);

        </script>';

              $i = $_SESSION['longitud'] + 1;

           }

        }

        

        for ($i = 0; $i < $_SESSION['longitud']; $i++){

            $_SESSION['ahorcado'][$i] = '_';

        }

        $_POST['letra'] = ' ';

        $_SESSION['primeravez'] = false;

    }       

    $_SESSION['letra'] = $_POST['letra'];

    

    $letraVacia = false;

    if ($_SESSION['letra'] == ''){

        $letraVacia = true;

        $_SESSION['letra'] = '-';

        echo '<script type = "text/javascript">

            alert("DEBE INGRESAR UNA LETRA");            

        </script>';

    }

    

    $indicadorLetraPermitida = true;

    if (stripos($_SESSION['permitidos'], $_SESSION['letra']) === false){

        echo '<script type = "text/javascript">

            alert("La letra no es valida");            

        </script>';

        $indicadorLetraPermitida = false;

    }

    

    if ($indicadorLetraPermitida == true && $_SESSION['letra'] != '-'){

        $_SESSION['LetraIngresada'][] = $_SESSION['letra'];

    }

    

    $indicadorIntentos = false;

    for ($i = 0; $i < $_SESSION['longitud']; $i++){

        if ($_SESSION['palabraingresada'][$i] == $_SESSION['letra']){

            $_SESSION['ahorcado'][$i] = $_SESSION['letra'];

            $indicadorIntentos = true;

        }

    }

    

    $contadorLetras = 0;   

    $indicadorLetraIn = false;

    if ($_SESSION['letra'] != ' '){

        for ($i=0; $i<count($_SESSION['LetraIngresada']); $i++){

            if ($_SESSION['LetraIngresada'][$i] == $_SESSION['letra']){            

//                $i = count($_SESSION['LetraIngresada']) + 1;

                $contadorLetras ++;                

            }

        }        

        if ($contadorLetras >= 2){

            echo '<script type = "text/javascript">

            alert("La letra ya ha sido ingresada");            

        </script>';

            $indicadorLetraIn = true;

        }

    }

    

    if ($indicadorIntentos == false && $indicadorLetraPermitida == true && $indicadorLetraIn == false && $letraVacia == false){

        $_SESSION['intentos'] ++;

    }

    

    $aux = 0;

    for ($j=0; $j<$_SESSION['longitud']; $j++){

        if ($_SESSION['palabraingresada'][$j] == $_SESSION['ahorcado'][$j]){

            $aux++;

        }

    }    

    if ($aux == $_SESSION['longitud']){

        echo '<br>';

        ?>

        <html>

            <p align="center">

                <?php 

                    for ($k=0; $k<$_SESSION['longitud']; $k++){        

                        echo $_SESSION['ahorcado'][$k] . ' ';

                    }

                ?>

            </p>

        </html>

        <?php

        echo '<script type = "text/javascript">

            alert("FELICIDADES!! HA GANADO!!");

        </script>';

        mensajeJugarNuevamente();

    }

    

    if ($_SESSION['intentos'] == 9){

        echo '<img src="imagenes/9.png">';

        sleep(0.2);

        echo '<br>';

        ?>

        <html>

            <p align="center">

                <?php 

                    for ($k=0; $k<$_SESSION['longitud']; $k++){        

                        echo $_SESSION['palabraingresada'][$k] . ' ';

                    }

                ?>

            </p>

        </html>

<?php

    echo '<script type = "text/javascript">

        alert("SORRY, HA PERDIDO");;

    </script>';

    mensajeJugarNuevamente();

    }else{

        echo '<p align="center">Lleva ' . $_SESSION['intentos'] . '  intentos fallidos</p>';

    }

?>

<html>

    <p align="center">

        <?php 

            for ($k=0; $k<$_SESSION['longitud']; $k++){        

                echo $_SESSION['ahorcado'][$k] . ' ';

            }

        ?>

    </p>

</html>    

<?php

    switch ($_SESSION['intentos']){

        case 0:

            echo '<p align="center"><img src="imagenes/0.png"></p>';

            break;

        case 1:

            echo '<p align="center"><img src="imagenes/1.png"></p>';

            break;

        case 2:

            echo '<p align="center"><img src="imagenes/2.png"></p>';

            break;

        case 3:

            echo '<p align="center"><img src="imagenes/3.png"></p>';

            break;

        case 4:

            echo '<p align="center"><img src="imagenes/4.png"></p>';

            break;

        case 5:

            echo '<p align="center"><img src="imagenes/5.png"></p>';

            break;

        case 6:

            echo '<p align="center"><img src="imagenes/6.png"></p>';

            break;

        case 7:

            echo '<p align="center"><img src="imagenes/7.png"></p>';

            break;

        case 8:

            echo '<p align="center"><img src="imagenes/8.png"></p>';

            break;

//        case 9:

//            echo '<img src="imagenes/9.png">';

//            break;

        default:

            echo '';

    }

    function mensajeJugarNuevamente(){

        session_destroy();

        echo '<script type="text/javascript">            

            if (confirm("DESEA JUGAR DE NUEVO?") == true) {

                window.location = "index.php";

            }else{

                window.location = "http://www.google.com";

            }

        </script>';

    }  

?>