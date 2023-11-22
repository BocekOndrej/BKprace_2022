<!DOCTYPE HTML>
<html lang="cs">
  <head>
  <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
    <?php
      if(isset($title)){
        echo $title;
      }else{
        echo "Servisní Firma";
      }
    ?>
    </title>

    <link rel="stylesheet" href="<?=NAZEV_SLOZKY?>/style/styles.css" type="text/css">
    <link rel="shortcut icon" href="<?=NAZEV_SLOZKY?>/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=NAZEV_SLOZKY?>/node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="<?=NAZEV_SLOZKY?>/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?=NAZEV_SLOZKY?>/node_modules/jquery/dist/jquery.min.js"></script>
    </head>

    <body id="body">
      <nav class="navbar navbar-expand-lg navbar-light" id="navstyle">
        <div class="container-fluid">
        <a class="navbar-brand" href="<?=NAZEV_SLOZKY?>/index.php">
        <img src="<?=NAZEV_SLOZKY?>/img/logo_gray.png" alt="logo" height="65"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" 
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav me-auto">
            <?php
                if(isset($_SESSION["login"])){
                  $role = $_SESSION["role"];
                  if($role == 3){
                    echo('<li class="nav-item"><a class="nav-link"  href="'.NAZEV_SLOZKY.'/zakazky/zakazkyUser.php">Moje Objednávky</a></li>');
                    echo('<li class="nav-item"><a class="nav-link"  href="'.NAZEV_SLOZKY.'/kontakt.php">Kontakt</a></li>');
                  }else if($role == 2){
                    echo('<li class="nav-item"><a class="nav-link"  href="'.NAZEV_SLOZKY.'/zakazky/zakazky.php">Správa Objednávek</a></li>');
                    echo('<li class="nav-item"><a class="nav-link"  href="'.NAZEV_SLOZKY.'/zakaznici/zakaznici.php">Zákazníci</a></li>');
                    echo('<li class="nav-item"><a class="nav-link"  href="'.NAZEV_SLOZKY.'/sklad/sklad.php">Sklad</a></li>');
                  }
                }
                else
                {
                  echo('<li class="nav-item"><a class="nav-link" aria-current="page"
                   href="'.NAZEV_SLOZKY.'/zakazky/zakazkyGuest.php">Objednávky</a></li>');
                  echo('<li class="nav-item"><a class="nav-link"  href="'.NAZEV_SLOZKY.'/kontakt.php">Kontakt</a></li>');
                }
            ?>
            </ul>

            <ul class="navbar-nav">
            <li class="nav-item dropstart">        
              <?php
                echo '<img class="nav-link dropdown-toggle" id="user" data-bs-toggle="dropdown" href="#"
                 role="button" aria-expanded="false" src="'.NAZEV_SLOZKY.'/img/user.png" height="58">';
              
                if(isset($_SESSION["login"])){
                  $role = $_SESSION["role"];
                  echo "<ul class='dropdown-menu' id='logged'>";
                  echo '<li class="nav-item px-2 d-flex justify-content-center fw-bold">'.$_SESSION["jmeno"].'</li>
                        <li class="nav-item px-2"> Login: '.$_SESSION["login"].' </li>
                        <li class="nav-item px-2"> Role: '.$_SESSION["nazevRole"].'</li>';
                  echo '<li class="nav-item  d-flex justify-content-center py-2">
                        <a class="unlog btn fw-bold" href="'.NAZEV_SLOZKY.'/autentizace/logout.php" role="button">Odhlásit se</a></li>';

                }else{
                  echo "<ul class='dropdown-menu' id='unlogged'>";
                  echo '<form style="margin-bottom: 0 !important;" class="px-2 py-2"
                   action="'.NAZEV_SLOZKY.'/autentizace/login.php" method="post">';
                  echo '<li class="nav-item">Login: <input class="form-control" type="text" name="login"></li>';
                  echo '<li class="nav-item">Heslo: <input class="form-control" type="password" name="heslo"></li>';
                  echo '<li class="nav-item py-2"><input class="log-but form-control fw-bold btn" type="submit" value="Přihlásit"></li>';
                  echo '</form>';
                }
              ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>



<div class="toast-container p-3 top-4 start-50 translate-middle-x" id="toastPlacement" data-original-class="toast-container p-3">
  <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" data-bs-theme="dark"
   style="border-radius: 0.1rem !important; border-color: <?php if(isset($_SESSION['msg-good'])){echo "green";}
   else if(isset($_SESSION['msg-bad'])){echo "red";} ?> !important;">
    <div class="d-flex">
      <div class="toast-body">
      <?php echo isset($_SESSION['msg-good']) ? $_SESSION['msg-good'] : ''; ?>
      <?php echo isset($_SESSION['msg-bad']) ? $_SESSION['msg-bad'] : ''; ?>
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>  
</div>

<script>
      $(document).ready(function(){
        //skript zobrazí toast na 5 vteřin, pak vymaže zprávu
          <?php if(isset($_SESSION['msg-good']) || isset($_SESSION['msg-bad'])){ ?>
              $('.toast').toast('show');

              setTimeout(function(){
                  $('.toast').toast('hide');
              }, 5000);
              <?php unset($_SESSION['msg-bad']); ?>
              <?php unset($_SESSION['msg-good']); ?>
          <?php } ?>
      });
  </script>
  <?php
  include($nazev.".view.php");
  ?>
  <div class="overlay"></div>
</body>
</html>