<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" > 
		<title>Acheter d'occasion - la référence pour acheter d'occasion sur internet</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" media="screen" >
		<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" >
		<link href='http://fonts.googleapis.com/css?family=Nobile:400,700|Kreon:400,700|Rouge+Script|Cookie' rel='stylesheet' type='text/css'>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-29246435-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	</head>
	
	<body>
	
		<?php
		
			ini_set('memory_limit', '32M');
		
			//on note les mots clé 
			$kwords = fopen('kwords.txt','a');
			$words = $_POST['words'];
			fputs($kwords,date("Y-m-d H:i",time()));
			fputs($kwords,"//");
			fputs($kwords,$words);
			fputs($kwords,";");
			fputs($kwords,"\r\n");
			fclose($kwords);
			
			
			include_once('simplehtmldom/simple_html_dom.php');
			//on récupère les mots clé
			$words = $_POST['words'];
			$words_ok = str_replace(" ","+",$words);
			
			//Le bon coin
			$url_lbc = "http://www.leboncoin.fr/annonces/offres/ile_de_france/occasions/?f=a&th=1&q={$words_ok}";
			$html_lbc = file_get_html($url_lbc);
			$data_lbc =  $html_lbc->find('li.tab_all strong',1);	
			
			//Vivastreet
			$url_vs = "http://search.vivastreet.fr/search+ile-de-france?lb=new&search=1&start_field=1&keywords={$words_ok}&cat_1=&end_field=";
			$html_vs = file_get_html($url_vs);
			$data_vs =  $html_vs->find('th.toolbar_tab_selected div strong',0);
			if (isset($data_vs)){
				preg_match('#[0-9]+#',$data_vs,$extract);
				$data_vs = $extract[0];}
				
			//Ebay petites annonces	
			$url_eb = "http://shop.ebay.fr/i.html?LH_CAds=1&rt=nc&_sacat=See-All-Categories&cmd=Blend&_nkw={$words_ok}&cmd=Blend";
			$html_eb = file_get_html($url_eb);
			$data_eb =  $html_eb->find('span[class=bc-rc]',0);
			$data_eb_ok = str_replace("Â"," ",$data_eb);
			
				
			//Priceminister
			$url_pm = "http://www.priceminister.com/s/{$words_ok}/ft/u";
			$html_pm = file_get_html($url_pm);
			$data_pm =  $html_pm->find('p.nb_results b',0);
			
			//2xmoinscher
			$url_2x = "http://www.2xmoinscher.com/acheter-vendre/recherche/?search={$words_ok}&categoryID=&send=Rechercher";
			$html_2x = file_get_html($url_2x);
			$data_2x =  $html_2x->find('p[class=SearchResult]',0);
			if (isset($data_2x)){
				preg_match('#[0-9]+#',$data_2x,$extract);
				$data_2x = $extract[0];}
				
		?>
		
			<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					    <a class="brand" href="index.html">Acheter-doccasion.fr</a>
						<ul class="nav">
							<li><a href="../index.html">Accueil</a></li>
							<li><a href="../pourquoi.html">Pourquoi ce site?</a></li>
							<li><a href="../guide.html">Guide d'achat d'occasion</a></li>
							<li><a href="mailto:contact@acheter-doccasion.fr">Contact</a></li>
						</ul>
				</div>
			</div>
		</div>
	
		<div id="tout">
			<div class="container">
									
				<div class="row">			
					<div class="span8">
						<div class="page-header">
							<h2> Recherche <small>Résultats pour "<?php echo $words;?>"</small></h2>
						</div>
						<p> Vous trouverez ci-dessous, pour chaque site, le nombre d'offres qui correspondent à votre recherche. En un clin d'oeil,
						vous visualisez l'ensemble des offres disponibles sur internet : vous n'avez plus qu'à fouiller chaque site pour trouver ce que vous cherchez !</p>
						<div class="alert">
							<strong>En construction</strong> Cette partie du site est encore en contruction et évolue en permanence !
							Le nombre de sites supportés augmentera au fur et à mesure, pour pouvoir répérer chaque bonne affaire en un clic, 
							où qu'elle soit postée !
						</div>
				
						
						<div class="row resultat">
							<div class="span2">
								<p class="site">Le bon coin</p>
							</div>
							<div class="span2">
								<p class="texte_r"><?php if (empty($data_lbc)) echo "Pas de résultat";else echo $data_lbc," offres"; ?> </p>
							</div>
							<div class="span4 push1">
								<p class="btn lien_r"><a href="<?php echo $url_lbc;?>" target="_blank">Voir les offres</a></p>
							</div>
						</div>
						
						<div class="row resultat">
							<div class="span2">
								<p class="site">Vivastreet</p>
							</div>
							<div class="span2">
								<p class="texte_r"><?php if (empty($data_vs)) echo "Pas de résultat";else echo $data_vs," offres"; ?> </p>
							</div>
							<div class="span4 push1">
								<p class="btn lien_r"><a href="<?php echo $url_vs;?>" target="_blank">Voir les offres</a></p>
							</div>
						</div>
						
						<div class="row resultat">
							<div class="span2">
								<p class="site">Ebay</p>
							</div>
							<div class="span2">
								<p class="texte_r"><?php if (empty($data_eb_ok)) echo "Pas de résultat";else echo $data_eb_ok," offres"; ?> </p>
							</div>
							<div class="span4 push1">
								<p class="btn lien_r"><a href="<?php echo $url_eb;?>" target="_blank">Voir les offres</a></p>
							</div>
						</div>
						
						
						<div class="row resultat">
							<div class="span2">
								<p class="site">Priceminister</p>
							</div>
							<div class="span2">
								<p class="texte_r"><?php if (empty($data_pm)) echo "Pas de résultat";else echo $data_pm," offres"; ?> </p>
							</div>
							<div class="span4 push1">
								<p class="btn lien_r"><a href="<?php echo $url_pm;?>" target="_blank">Voir les offres</a></p>
							</div>
						</div>
						
						<div class="row resultat">
							<div class="span2">
								<p class="site">2xmoinscher</p>
							</div>
							<div class="span2">
								<p class="texte_r"><?php if (empty($data_2x)) echo "Pas de résultat";else echo $data_2x," offres"; ?> </p>
							</div>
							<div class="span4 push1">
								<p class="btn lien_r"><a href="<?php echo $url_2x;?>" target="_blank">Voir les offres</a></p>
							</div>
						</div>
						
						
					</div>
					<div class="span4">
						<h2>Espace Recherche</h2>
						<p>Vous cherchez un produit en particulier ? Rechercher directement parmi des centaines de sites 
						de petites annonces et d'achat/vente en ligne.<p>
						<form action="recherche.php" method="post">
							<input type="text" name="words" placeholder="ex: iphone 4 blanc">
							<input type="submit" value="Recherche">
						</form>
					</div>
				</div>
			</div> <!-- end of container-->
		</div>
		
		<div class="footer">
			<p>Acheter-doccasion.fr | Copyright 2012</p>
		</div>
	</body>
</html>