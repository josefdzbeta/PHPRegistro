<?php
  ini_set('display_errors', 1);
  error_reporting(~0);
   REQUIRE ("config/configdb.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM Usuarios WHERE idUsuario = '$myusername' and passw = '$mypassword'";
      $result = $db->query($sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }

?>
<!DOCTYPE html>
<html lang=es>
  <head>
      <meta charset=UTF-8>
      <meta http-equiv=X-UA-Compatible content=IE=edge>
      <meta name=viewport content=width=device-width,initial-scale=1.0>
      <link rel=stylesheet href=css/style1.css>
      <link rel=stylesheet href=css/style.css>
      <title>Inicio de Sesión</title>
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form action="inicio.php" method="POST">
        <img class="mb-4" src="inicio.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Inicio de Sesión</h1>
    
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">Contraseña</label>
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Recuérdame
          </label>
        </div>
        <input type="submit" class="w-100 btn btn-lg btn-primary" value="Iniciar Sesión">
        <p class="mt-5 mb-3 ">¿Todavía no tienes una cuenta? <a href="registro.html">Regístrate aquí</a>.</p>
        <p class="mt-5 mb-3 text-muted">&copy DWES 2021</p>
      </form>
    </main>
  </body>
</html>