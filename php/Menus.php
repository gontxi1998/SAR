
<div id='page-wrap'>
<header class='main' id='h1'>
  <span class="right" id="register"><a href="SignUp.php">Registro</a></span>
        <span class="right" id="login"><a href="LogIn.php">Login</a></span>
        <span class="right" id="logout" style="display:none;"><a href="LogOut.php">Logout</a></span>

</header>
<nav class='main' id='n1' role='navigation'>
    <span><a href='Layout.php'>Inicio</a></span>
    <span id="VerPreguntas" style="display:none"><a href='ShowPreguntas.php'>Ver preguntas</a>
    </span>
    <span id="InsertarPregunta" style="display:none"><a href='HandlingComments.php'>Insertar Preguntas</a>
    </span>
    <span id="gestionUsuarios" style="display:none"><a href='HandlingAccounts.php'>Gestionar usuarios</a>
    </span>
    <span><a href='Credits.php'>Créditos</a></span>
</nav>
    <script src="../js/jquery-3.4.1.min.js"></script>
<script>
    function inicioSesion(){
        $('#register').hide();
        $('#login').hide();
        $('#logout').show(); 
        $('#VerPreguntas').show();
        $('#InsertarPregunta').show();
        $('#h1').append('<p><?php echo $_SESSION['email'];  ?></p>');
        $("#h1").append("<img width=\"50\" height=\"60\" src=\"data:image/*;base64,<?php echo getImagenDeBD();?>\" alt=\"Imagen\"/>");

    }
    function inicioSesionA(){
        $('#gestionUsuarios').show();
        $('#register').hide();
        $('#login').hide();
        $('#logout').show();
         $('#h1').append('<p><?php echo $_SESSION['email'];  ?></p>');
         $("#h1").append("<img width=\"50\" height=\"60\" src=\"data:image/*;base64,<?php echo getImagenDeBD();?>\" alt=\"Imagen\"/>");
    }
    
    function cierreSesion(){
            $('#register').show();
            $('#login').show();
            $('#logout').hide();
    }
</script>
<?php
    
    if(isset($_SESSION['email'])){
        if($_SESSION['email']=="admin@ehu.es"){
            echo "<script>inicioSesionA();</script>";
        }else{
        echo "<script>inicioSesion();</script>";
        }
    }else{

        echo "<script>cierreSesion();</script>";
    }
    
    function getImagenDeBD(){
        if(isset($_SESSION['email'])){
            include 'DbConfig.php';
            $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
            if(!$mysqli){
                die("Error: ".mysqli_connect_error);
            }

            $sql = "SELECT foto FROM usuarios WHERE email=\"".$_SESSION['email']."\";";
            $resul = mysqli_query($mysqli,$sql, MYSQLI_USE_RESULT);
            if(!$resul){
                die("Error: ".mysqli_error($mysqli));
            }
            $img = mysqli_fetch_array($resul);
            return $img['foto'];
        }
        else{
            return "";
        }
    }
    ?>
    
    
    
    
    
