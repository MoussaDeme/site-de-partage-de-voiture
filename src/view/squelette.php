<!DOCTYPE html>
<html lang="fr">
<head>
  <title> <?php echo $this->title; ?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <!--<link rel="stylesheet" href="bootstrap/bootstrap.css">-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
     <?php echo $this->menu; ?>
  </ul>
</nav>

<section class="sec1 box">
      <div class="container">
      <h1 class="text-center"><?php echo $this->title; ?></h1> 
      <p class="text-center"><?php echo $this->content; ?></p>  
    </div>
</section>
<section class="sec2 box">
   <div class="container">
   
  </div>
</section>

</body>
<footer class="bg-secondary">
     <div class="container">
       <div class="row">
         <div class="col text-center">
                 <h1 class="text-white text-capitalize font-weight-light">
                 <p>&copy; 2020 Tous droits réservés<p>
                 </h1>
                 
         </div>
       </div>
     </div>
</footer>
</html>