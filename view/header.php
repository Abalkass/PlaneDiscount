<?php
    require_once "$ROOT{$DS}config{$DS}Session.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset = "UTF-8" />
    <meta name="keywwords" content="Avion, Ecommerce, Plane shop" />
    <meta name="description" content="Plane Shop - Boutique en ligne où on vend n'importe quels types d'avions PAS CHERS." />
    <meta name="author" content="Abalkassim DJABIRI & Guilhaume Moraud" />
    
    <title>Plane Discount - <?= $pagetitle ?></title>
    <link rel="icon" href="images/title%20icon.jpg">

        <!-- Script JS Bootstrap et Jquery
    ============================================================================================================= -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <!-- Framwork Bootstrap pour le responsive
    ============================================================================================================= -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" >

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- Barre de navigation
    ============================================================================================================= -->
  <div class="row">
      <div class="col-md-12">
          <nav class="navbar navbar-inverse navbar-fixed-top">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                  <span class="glyphicon glyphicon-list"></span>
                </button>
                <a class="navbar-brand" href="index.php">Plane Discount</a>
              </div>
                 <form class="navbar-form navbar-left" method="post" action="./index.php?controller=produit&amp;action=search" >
                  <div class="form-group">
                    <div class="input-group">
                      <input class="form-control" type="text" name="search" placeholder="Rechercher un article" size="33">
                      <span class="input-group-btn">
                        <button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span></button>
                      </span>
                    </div>
                  </div>
                </form>
              <div class="collapse navbar-collapse" id="navbar-collapse-01">
                <ul class="nav navbar-nav navbar-left">
                  <li class="dropdown">
                    <a href="index.php?controller=produit&amp;action=readAll&amp;categorie=civils" class="dropdown-toggle" data-toggle="dropdown">Avions civils<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Avions%20de%20ligne">Avions de ligne</a></li>
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Avion-Cargo">Avion-Cargo</a></li>
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Avions%20d'affaire">Avions d'affaire</a></li>
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Avions%20légers">Avions légers</a></li>
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=ULM">Ultra légers motorisé (ULM)</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="index.php?controller=produit&amp;action=readAll&amp;categorie=militaires" class="dropdown-toggle" data-toggle="dropdown">Avions militaires<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Avions%20de%20chasse">Avions de chasse</a></li>
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Avions%20de%20transport%20militaire">Avions de transport militaire</a></li>
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Avions%20de%20reconnaissance">Avions de reconnaissance</a></li>
                    </ul>
                  </li><li class="dropdown">
                    <a href="index.php?controller=produit&amp;action=readAll&amp;categorie=helico" class="dropdown-toggle" data-toggle="dropdown">Hélicoptères<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Hélicoptères%20civils">Hélicoptères civils</a></li>
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Hélicoptères%20militaires">Hélicoptères militaires</a></li>
                      <li><a href="index.php?controller=produit&amp;action=readAll&amp;type=Hélicoptères%20de%20secourisme">Hélicoptères de secourisme</a></li>
                    </ul>
                  </li>
                 </ul>

                 <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a
                      <?php
                        if (!empty($_SESSION['idClient']) && Session::is_client($_SESSION['idClient']))
                          echo 'href="./index.php?controller=client&amp;action=read&amp;id=' .$_SESSION['idClient']. '"';
                        else if (Session::is_admin())
                          echo 'href="index.php?controller=client&amp;action=admin"';
                        else 
                          echo 'href="index.php?controller=client&amp;action=connect"';
                      ?>
                    ><span class="glyphicon glyphicon-user"></span> Mon compte</a>
                    <ul class="dropdown-menu">
                    <?php 
                        if (empty($_SESSION['idClient']) && empty($_SESSION['admin']) )
                          echo '<li><a href="./index.php?controller=client&amp;action=connect">Se connecter</a></li>';
                        else
                          echo '<li><a href="./index.php?controller=client&amp;action=deconnect">Se déconnecter</a></li>';
                    ?>
                    </ul>
                  </li>

                  <li><a href="index.php?controller=panier"><span class="glyphicon glyphicon-shopping-cart"></span> Mon panier
                    <!--Affichage du nombre d'article dans le panier -->
                      <span class="badge"> <?php
                        if ((!empty($_SESSION['panier'])) && (!empty($_SESSION['panier']['idProduit'])) )
                           echo count($_SESSION['panier']['idProduit']);
                        else echo "0"; ?>
                      </span></a></li>
                 </ul>
              </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->
      </div><!-- /col-md-12 -->
  </div><!-- /row -->
    <div class="container">
