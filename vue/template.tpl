<!DOCTYPE html>
		<html lang="fr">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title><?=  $titretab;  ?></title>

			<link href="ratingStar/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
			<link rel="stylesheet" href="bootstrap/css/komidi_style.css">

			<style>
				#tabCoter{
					display: inline-block;
				}
			</style>
		</head>
		<body>
		<nav class="navbar navbar" id="ecole"></nav>

			<nav class="navbar navbar-default navbar-static-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php">Komidiscope</a>
					</div>
					<div id="navbar" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">

							<?= $menupage ?>

						</ul>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="jumbotron">
								<h1>
									<?= $titrepage ?>
									<img src="image/logo_scope.png" class="pull-right" height="115" width="118">
								</h1>
								<p>
									<?= $msgaccueilpage ?>
								</p>
							</div>
						</div>

						<div class="col-md-4">
							<div class="thumbnail">
								<a href="http://zeop.re" target="_blank">
									<img src="image/zeop.png" alt="Lights" style="width:100%">
									<div class="caption">
										<p>Zeop partenaire officielle du festival komidi.</p>
									</div>
								</a>
							</div>
						</div>
					</div>

					<div class="input-group">
						<form action="#" method="GET">
							<input type="search" name="recherche" placeholder="Rechercher" id="recherche">
							<span class="glyphicon glyphicon-search"></span>
							<div class="list-group" id="emplacementRecherche">

							</div>

						</form>
					</div>
					<?= $adherent ?>

				</div>
			</nav>

			<div class="container">		
				<div class="row">
					<div class="col-xs-12 col-sm-9">


						<hr>
						<!-- Contenu -->

								<?= $contenupage ?>

					</div>					
					<!-- Sidebar -->


								<?= $sidebarpage ?>

				</div><!-- .row -->

				<hr>

				<footer>
					<p>&copy; Lycée Pierre-Poivre  BTS-SIO 2016</p> 
				</footer>

			</div><!-- fin container -->


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script src="ratingStar/js/star-rating.js"></script>
            <script src="bootstrap/js/Vérif.js"></script>
            <script src="bootstrap/js/noter.js"></script>
			<script src="bootstrap/js/recherche.js"></script>
			<script src="bootstrap/js/ecole.js"></script>

</body>
</html>