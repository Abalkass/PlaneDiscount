<?php
    $pagetitle='Accueil';
    require "header.php";
?>

    <div class="titre">
        <h1>Bienvenue sur la boutique Plane Discount</h1>
        <hr>
    </div>
    </div>
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/slide1.png" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Grosse promotion sur les avions de ligne</h1>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="images/slide2.png" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Nouveaux arrivages d'avion</h1>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="images/slide3.png" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Vente Flash</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Précédent</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Suivant</span>
        </a>
    </div><!-- /.carousel -->

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-lg btn-primary btn-block" href="index.php?controller=produit&amp;action=readAll" role="button">Afficher tous les produits du site</a>
            </div>
        </div>
        
        <div class="page-header"> <h1> Découvrer tous nos marques distributeurs </h1> </div>
        
        <div class="row marque">
            <div class="col-lg-4">
                <a href="index.php?controller=produit&amp;action=readAll&amp;constructeur=Boeing"> <img src="images/marques/boeing_logo.png" alt="Logo boeing"> </a>
            </div> <div class="col-lg-4">
                <a href="index.php?controller=produit&amp;action=readAll&amp;constructeur=Airbus"> <img src="images/marques/airbus_logo.png" alt="Logo Airbus"> </a>
            </div> <div class="col-lg-4">
                <a href="index.php?controller=produit&amp;action=readAll&amp;constructeur=Dassault%20Aviation"> <img src="images/marques/dassault_logo.png" alt="Logo Dassault Aviation"> </a>
            </div>
        </div><!-- /.row -->
        <div class="row marque">
            <div class="col-lg-4">
                <a href="index.php?controller=produit&amp;action=readAll&amp;constructeur=SAAB"> <img src="images/marques/saab_logo.png" alt="Logo SAAB"> </a>
            </div> <div class="col-lg-4">
                <a href="index.php?controller=produit&amp;action=readAll&amp;constructeur=Avic"> <img src="images/marques/avic_logo.png" alt="Logo Avic"> </a>
            </div> <div class="col-lg-4">
                <a href="index.php?controller=produit&amp;action=readAll&amp;constructeur=Bombardier%20Aviation"> <img src="images/marques/bombardier_logo.png" alt="Logo Bombardier Aviation"> </a>
            </div>
        </div><!-- /.row -->
        
    <!-- START THE FEATURETTES -->
        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Nos avions civils</h2>
                <p class="lead">Nous proposons toute une gamme d’avions civils. Que soit des grands avions de ligne pour le transport de passager ou de fret ou des avions d’affaires pour des usages personnels ou professionnels ou encore des avions de loisirs de type ULM pour vous amuser dans l’air.</p>
                <p><a class="btn btn-lg btn-primary" href="index.php?controller=produit&amp;action=readAll&amp;categorie=civils" role="button">Afficher tous les avions civils</a></p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-responsive center-block" src="images/jet_feature.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 col-md-push-5">
                <h2 class="featurette-heading">Nos avions militaires</h2>
                <p class="lead">Nous avons toute une armada d’avion militaire pour équiper votre armée, qui va du gros porteur le Transall à la plus performante qui est le Rafale.</p>
                <p><a class="btn btn-lg btn-primary" href="index.php?controller=produit&amp;action=readAll&amp;categorie=militaires" role="button">Afficher tous les avions militaires</a></p>
            </div>
            <div class="col-md-5 col-md-pull-7">
                <img class="featurette-image img-responsive center-block" src="images/military_feature.jpeg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Nos hélicoptères</h2>
                <p class="lead">Sur notre magasin, vous aurez un large choix d'hélicoptère quelque soit vos besoin.</p>
                <p><a class="btn btn-lg btn-primary" href="index.php?controller=produit&amp;action=readAll&amp;categorie=helico" role="button">Afficher tous les hélicoptères</a></p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-responsive center-block" src="images/h%C3%A9licopt%C3%A8re_feature.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->
    
<?php require "footer.php"; ?>
