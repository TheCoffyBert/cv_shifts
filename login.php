<!DOCTYPE html>
<html lang="it">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta name="description" content="Test description">
  <meta name="author" content="Paolo Bertinelli">

  <title>Login | CVShifts</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/sticky_footer.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
  <link rel="apple-touch-icon" href="/img/green-cross-bullet-150x150.png">

  <meta name="theme-color" content="#4CAF50"/>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

 </head>

 <body>
  <main>
   <nav class="green" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">CVShifts</a></div>
   </nav>

   <div class="section no-pad-bot" id="index-banner">
    <div class="container">
     <h1 class="header center light-blue-text">CVShifts</h1>
     <div class="row center">
      <h5 class="header col s12 light">Un sito fatto completamente a caso per tenere traccia dei miei turni alla Croce Verde</h5>
     </div>
    </div>
   </div>
   <br>
   <div class="container">
  	<div class="row">
     <div class="col s12 m4 l3"></div>
      <div class="col s12 m4 l6">
       <div class="card-panel z-depth-3">
        <div class="container">
         <div class="center-align">
          <i class="large material-icons">account_circle</i>
         </div>
         <h5 class="center-align">Login</h5>
         <br>
    	 <form class="form-signin" action="includes/login_inc.php" method="post">
          <input type="email" name="email" class="form-control" placeholder="E-Mail">
          <input type="password" name="pwd" class="form-control" placeholder="Password">
          <div class="row center">
        	<br>
        	<button class="btn-large waves-effect waves-light light-blue" type="submit" name="login-submit">Accedi</button>
          </div>
      	 </form>
    	</div>
    	<br>
       </div>
      </div>
      <div class="col s12 m4 l3"></div>
    </div>
   </div>
   <br>
  </main>

  <footer class="page-footer green">
   <div class="container">
    <div class="row">
     <div class="col l6 s12">
      <h5 class="white-text">Su questo sito</h5>
      <p class="grey-text text-lighten-4">Questo sito &egrave; stato realizzato autonomamete da uno studente universitario come esercizio personale.<br>In caso di dubbi o per mandare un feedback clicca pure <a href="mailto:paolo.bertinelli@gmail.com">qui</a>.</p>
     </div>
     <div class="col l3 s12">
      <h5 class="white-text">Altri progetti</h5>
      <ul>
       <li><a class="white-text" href="#!">Devo</a></li>
       <li><a class="white-text" href="#!">Ancora</a></li>
       <li><a class="white-text" href="#!">Iniziarli</a></li>
       <li><a class="white-text" href="#!">Tutti</a></li>
      </ul>
     </div>
     <div class="col l3 s12">
      <h5 class="white-text">Social</h5>
      <ul>
       <li><a class="white-text" href="https://github.com/TheCoffyBert"><i class="fab fa-github-square"></i> GitHub</a></li>
       <li><a class="white-text" href="https://www.instagram.com/thecoffybert/"><i class="fab fa-instagram"></i> Instagram</a></li>
       <li><a class="white-text" href="https://t.me/TheCoffyBert"><i class="fab fa-telegram"></i> Telegram</a></li>
       <li><a class="white-text" href="https://twitter.com/TheCoffyBert"><i class="fab fa-twitter-square"></i> Twitter</a></li>
      </ul>
     </div>
    </div>
   </div>
   <div class="footer-copyright">
    <div class="container">Made by <a class="light-blue-text text-lighten-3" href="http://about.me/paolobertinelli">Paolo Bertinelli</a></div>
   </div>
  </footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>

 </body>
</html>
