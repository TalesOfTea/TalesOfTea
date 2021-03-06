<?php
# *** LICENSE ***
# This file is part of BlogoText.
# http://lehollandaisvolant.net/blogotext/
#
# 2006      Frederic Nassar.
# 2010-2015 Timo Van Neerden <timo@neerden.eu>
#
# BlogoText is free software.
# You can redistribute it under the terms of the MIT / X11 Licence.
#
# *** LICENSE ***


function afficher_html_head($titre) {
	if (isset($GLOBALS['lang']['id'])) {
		$lang_id = $GLOBALS['lang']['id'];
	} else {
		$lang_id = 'fr';
	}
	$txt = '<!DOCTYPE html>'."\n";
	$txt .= '<html>'."\n";
	$txt .= '<head>'."\n";
	$txt .= "\t".'<meta charset="UTF-8" />'."\n";
	$txt .= "\t".'<link type="text/css" rel="stylesheet" href="style/style.css.php" />'."\n";
	$txt .= "\t".'<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />'."\n";
	$txt .= "\t".'<title>'.$titre.' | '.$GLOBALS['nom_application'].'</title>'."\n";
	$txt .= '</head>'."\n";
	$txt .= '<body id="body">'."\n\n";
	echo $txt;
}

function footer($index='', $begin_time='') {
	if ($index != '') {
		$file = '../config/ip.php';
		if (file_exists($file) and is_readable($file)) {
			include($file);
			$new_ip = htmlspecialchars($_SERVER['REMOTE_ADDR']);
			$last_time = strtolower(date_formate($GLOBALS['old_time'])).', '.heure_formate($GLOBALS['old_time']);
			if ($new_ip == $GLOBALS['old_ip']) {
				$msg = '<br/>'.$GLOBALS['lang']['derniere_connexion_le'].' '.$GLOBALS['old_ip'].' ('.$GLOBALS['lang']['cet_ordi'].'), '.$last_time;
			} else {
				$msg = '<br/>'.$GLOBALS['lang']['derniere_connexion_le'].' '.$GLOBALS['old_ip'].' '.$last_time;
			}
		} else {
			$msg = '';
		}
	} else {
		$msg = '';
	}
	if ($begin_time != ''){
		$end = microtime(TRUE);
		$dt = round(($end - $begin_time),6);
		$msg2 = ' - '.$GLOBALS['lang']['rendered'].' '.$dt.' s '.$GLOBALS['lang']['using'].' '.$GLOBALS['sgdb'];
	} else {
		$msg2 = '';
	}

	echo '</div>'."\n";
	echo '</div>'."\n";
	echo '<p id="footer"><a href="'.$GLOBALS['appsite'].'">'.$GLOBALS['nom_application'].' '.$GLOBALS['version'].'</a>'.$msg2.$msg.'</p>'."\n";
	echo '</body>'."\n";
	echo '</html>'."\n";
}

/// menu haut panneau admin /////////
function afficher_topnav($active, $titre) {
	if (strlen($titre) == 0) $titre = $GLOBALS['nom_application'];

	echo '<div id="nav">'."\n";
	echo "\t".'<ul>'."\n";
	echo "\t\t".'<li><a href="index.php" id="lien-index"', ($active == 'index.php') ? ' class="current"' : '', '>'.$GLOBALS['lang']['label_resume'].'</a></li>'."\n";
	echo "\t\t".'<li><a href="articles.php" id="lien-liste"', ($active == 'articles.php') ? ' class="current"' : '', '>'.$GLOBALS['lang']['mesarticles'].'</a></li>'."\n";
	echo "\t\t".'<li><a href="ecrire.php" id="lien-nouveau"', ($active == 'ecrire.php') ? ' class="current"' : '', '>'.$GLOBALS['lang']['nouveau'].'</a></li>'."\n";
	echo "\t\t".'<li><a href="commentaires.php" id="lien-lscom"', ($active == 'commentaires.php') ? ' class="current"' : '', '>'.$GLOBALS['lang']['titre_commentaires'].'</a></li>'."\n";
	echo "\t\t".'<li><a href="fichiers.php" id="lien-fichiers"', ($active == 'fichiers.php') ? ' class="current"' : '', '>'.ucfirst($GLOBALS['lang']['label_fichiers']).'</a></li>'."\n";
	if ($GLOBALS['onglet_liens'])
	echo "\t\t".'<li><a href="links.php" id="lien-links"', ($active == 'links.php') ? ' class="current"' : '', '>'.ucfirst($GLOBALS['lang']['label_links']).'</a></li>'."\n";
	if ($GLOBALS['onglet_rss'])
	echo "\t\t".'<li><a href="feed.php" id="lien-rss"', ($active == 'feed.php') ? ' class="current"' : '', '>'.ucfirst($GLOBALS['lang']['label_feeds']).'</a></li>'."\n";
	echo "\t".'</ul>'."\n";
	echo '</div>'."\n";
	echo '<h1>'.$titre.'</h1>'."\n";

	echo '<div id="nav-acc">'."\n";
	echo "\t".'<ul>'."\n";
	echo "\t\t".'<li><a href="preferences.php" id="lien-preferences">'.$GLOBALS['lang']['preferences'].'</a></li>'."\n";
	echo "\t\t".'<li><a href="'.$GLOBALS['racine'].'" id="lien-site">'.$GLOBALS['lang']['lien_blog'].'</a></li>'."\n";
	echo "\t\t".'<li><a href="logout.php" id="lien-deconnexion">'.$GLOBALS['lang']['deconnexion'].'</a></li>'."\n";
	echo "\t".'</ul>'."\n";
	echo '</div>'."\n";
}

function confirmation($message) {
	echo '<div class="confirmation">'.$message.'</div>'."\n";
}

function no_confirmation($message) {
	echo '<div class="no_confirmation">'.$message.'</div>'."\n";
}

function legend($legend, $class='') {
	return '<legend class="'.$class.'">'.$legend.'</legend>'."\n";
}

function label($for, $txt) {
	return '<label for="'.$for.'">'.$txt.'</label>'."\n";
}

function info($message) {
	return '<p class="info">'.$message.'</p>'."\n";
}

function erreurs($erreurs) {
	if ($erreurs) {
		$texte_erreur = '<div id="erreurs">'.'<strong>'.$GLOBALS['lang']['erreurs'].'</strong> :' ;
		$texte_erreur .= '<ul><li>';
		$texte_erreur .= implode('</li><li>', $erreurs);
		$texte_erreur .= '</li></ul></div>'."\n";
	} else {
		$texte_erreur = '';
	}
	return $texte_erreur;
}

function erreur($message) {
	  echo '<p class="erreurs">'.$message.'</p>'."\n";
}

function question($message) {
	  echo '<p id="question">'.$message.'</p>';
}

function afficher_msg() {
	// message vert
	if (isset($_GET['msg'])) {
		if (array_key_exists(htmlspecialchars($_GET['msg']), $GLOBALS['lang'])) {
			$suffix = (isset($_GET['nbnew'])) ? htmlspecialchars($_GET['nbnew']).' '.$GLOBALS['lang']['rss_nouveau_flux'] : ''; // nb new RSS
			confirmation($GLOBALS['lang'][$_GET['msg']].$suffix);
		}
	}
	// message rouge
	if (isset($_GET['errmsg'])) {
		if (array_key_exists($_GET['errmsg'], $GLOBALS['lang'])) {
			no_confirmation($GLOBALS['lang'][$_GET['errmsg']]);
		}
	}
}

function apercu($article) {
	if (isset($article)) {
		$apercu = '<h2>'.$article['bt_title'].'</h2>'."\n";
		$apercu .= '<div><strong>'.$article['bt_abstract'].'</strong></div>'."\n";
		$apercu .= '<div>'.rel2abs_admin($article['bt_content']).'</div>'."\n";
		echo '<div id="apercu">'."\n".$apercu.'</div>'."\n\n";
	}
}

function moteur_recherche($placeholder) {
	$requete='';
	if (isset($_GET['q'])) {
		$requete = htmlspecialchars(stripslashes($_GET['q']));
	}
	if (empty($placeholder)) $placeholder = $GLOBALS['lang']['rechercher'];
	$return = '<form action="'.basename($_SERVER['PHP_SELF']).'" method="get" id="search">'."\n";
	$return .= '<input id="q" name="q" type="search" size="20" value="'.$requete.'" placeholder="'.$placeholder.'" accesskey="f" />'."\n";
	if (isset($_GET['mode'])) {
		$return .= '<input id="mode" name="mode" type="hidden" value="'.htmlspecialchars(stripslashes($_GET['mode'])).'"/>'."\n";
	}
	$return .= '<input class="silver-square" id="input-rechercher" type="submit" value="'.$GLOBALS['lang']['rechercher'].'" />'."\n";
	$return .= '</form>'."\n\n";
	return $return;
}

// returns HTML <table> calender
function afficher_calendrier() {
	// article
	if ( isset($_GET['d']) and preg_match('#^\d{4}(/\d{2}){5}#', $_GET['d'])) {
		$id = substr(str_replace('/', '', $_GET['d']), 0, 14);
		$date = substr(get_entry($GLOBALS['db_handle'], 'articles', 'bt_date', $id, 'return'), 0, 8);
		$date = (preg_match('#^\d{4}(/\d{2}){5}#', $date) and $date <= date('Y/m/d/H/i/s')) ? $date : date('Ym');
	} elseif ( isset($_GET['d']) and preg_match('#^\d{4}/\d{2}(/\d{2})?#', $_GET['d']) ) {
		$date = str_replace('/', '', $_GET['d']);
		$date = (preg_match('#^\d{6}\d{2}#', $date)) ? substr($date, 0, 8) : substr($date, 0, 6); // avec jour ?
	} elseif (isset($_GET['id']) and preg_match('#^\d{14}#', $_GET['id']) ) {
		$date = substr($_GET['id'], 0, 8);
	} else {
		$date = date('Ym');
	}

	$annee = substr($date, 0, 4);
	$ce_mois = substr($date, 4, 2);
	$ce_jour = (strlen(substr($date, 6, 2)) == 2) ? substr($date, 6, 2) : '';

	$qstring = (isset($_GET['mode']) and !empty($_GET['mode'])) ? 'mode='.htmlspecialchars($_GET['mode']).'&amp;' : '';

	$jours_semaine = array(
		$GLOBALS['lang']['lu'],
		$GLOBALS['lang']['ma'],
		$GLOBALS['lang']['me'],
		$GLOBALS['lang']['je'],
		$GLOBALS['lang']['ve'],
		$GLOBALS['lang']['sa'],
		$GLOBALS['lang']['di']
	);
	$premier_jour = mktime('0', '0', '0', $ce_mois, '1', $annee);
	$jours_dans_mois = date('t', $premier_jour);
	$decalage_jour = date('w', $premier_jour-'1');
	$prev_mois =      basename($_SERVER['PHP_SELF']).'?'.$qstring.'d='.$annee.'/'.str2($ce_mois-1);
	if ($prev_mois == basename($_SERVER['PHP_SELF']).'?'.$qstring.'d='.$annee.'/'.'00') {
		$prev_mois =   basename($_SERVER['PHP_SELF']).'?'.$qstring.'d='.($annee-'1').'/'.'12';
	}
	$next_mois =      basename($_SERVER['PHP_SELF']).'?'.$qstring.'d='.$annee.'/'.str2($ce_mois+1);
	if ($next_mois == basename($_SERVER['PHP_SELF']).'?'.$qstring.'d='.$annee.'/'.'13') {
		$next_mois =   basename($_SERVER['PHP_SELF']).'?'.$qstring.'d='.($annee+'1').'/'.'01';
	}

	// On verifie si il y a un ou des articles/liens/commentaire du jour dans le mois courant
	$tableau = array();
	$mode = ( !empty($_GET['mode']) ) ? $_GET['mode'] : 'blog';
	switch($mode) {
		case 'comments':
			$where = 'commentaires'; break;
		case 'links':
			$where = 'links'; break;
		case 'blog':
		default:
			$where = 'articles'; break;
	}

	$tableau = table_list_date($annee.$ce_mois, 1, $where);

	$html = '<table id="calendrier">'."\n";
	$html .= '<caption>';
	if ( $annee.$ce_mois > $GLOBALS['date_premier_message_blog']) {
		$html .= '<a href="'.$prev_mois.'">&#171;</a>&nbsp;';
	}

	// Si on affiche un jour on ajoute le lien sur le mois
	$html .= '<a href="'.basename($_SERVER['PHP_SELF']).'?'.$qstring.'d='.$annee.'/'.$ce_mois.'">'.mois_en_lettres($ce_mois).' '.$annee.'</a>';
	// On ne peut pas aller dans le futur
	if ( ($ce_mois != date('m')) || ($annee != date('Y')) ) {
		$html .= '&nbsp;<a href="'.$next_mois.'">&#187;</a>';
	}
	$html .= '</caption>'."\n".'<tr>'."\n";
	if ($decalage_jour > 0) {
		for ($i = 0; $i < $decalage_jour; $i++) {
			$html .=  '<td></td>';
		}
	}
	// Indique le jour consulte
	for ($jour = 1; $jour <= $jours_dans_mois; $jour++) {
		if ($jour == $ce_jour) {
			$class = ' class="active"';
		} else {
			$class = '';
		}
		if ( in_array($jour, $tableau) ) {
			$lien = '<a href="'.basename($_SERVER['PHP_SELF']).'?'.$qstring.'d='.$annee.'/'.$ce_mois.'/'.str2($jour).'">'.$jour.'</a>';
		} else {
			$lien = $jour;
		}
		$html .= '<td'.$class.'>';
		$html .= $lien;
		$html .= '</td>';
		$decalage_jour++;
		if ($decalage_jour == 7) {
			$decalage_jour = 0;
			$html .=  '</tr>';
			if ($jour < $jours_dans_mois) {
				$html .= '<tr>';
			}
		}
	}
	if ($decalage_jour > 0) {
		for ($i = $decalage_jour; $i < 7; $i++) {
			$html .= '<td> </td>';
		}
		$html .= '</tr>'."\n";
	}
	$html .= '</table>'."\n";
	return $html;
}

function encart_commentaires() {
	mb_internal_encoding('UTF-8');
	$query = "SELECT c.bt_author, c.bt_id, c.bt_article_id, c.bt_content, a.bt_title FROM commentaires c LEFT JOIN articles a ON a.bt_id=c.bt_article_id WHERE c.bt_statut=1 AND a.bt_statut=1 ORDER BY c.bt_id DESC LIMIT 5";
	$tableau = liste_elements($query, array(), 'commentaires');

	if (isset($tableau)) {
		$listeLastComments = '<ul class="encart_lastcom">'."\n";
		foreach ($tableau as $i => $comment) {
			$comment['contenu_abbr'] = strip_tags($comment['bt_content']);
			// limits length of comment abbreviation and name
			if (strlen($comment['contenu_abbr']) >= 60) {
				$comment['contenu_abbr'] = mb_substr($comment['contenu_abbr'], 0, 59).'…';
			}
			if (strlen($comment['bt_author']) >= 30) {
				$comment['bt_author'] = mb_substr($comment['bt_author'], 0, 29).'…';
			}
			$listeLastComments .= '<li title="'.date_formate($comment['bt_id']).'"><b>'.$comment['bt_author'].'</b> '.$GLOBALS['lang']['sur'].' <b>'.$comment['bt_title'].'</b><br/><a href="'.$comment['bt_link'].'">'.$comment['contenu_abbr'].'</a>'.'</li>'."\n";
		}
		$listeLastComments .= '</ul>'."\n";
		return $listeLastComments;
	} else {
		return $GLOBALS['lang']['no_comments'];
	}
}

function encart_articles() {
	mb_internal_encoding('UTF-8');
	// Ne récupère pas les "articles statiques"
	$tags =  $GLOBALS['static_tags']['articles'];
	foreach ($tags as $key => $value) {
		$tags[$key] = "bt_categories NOT LIKE '%".$value."%'";
	}
	$tags = implode(" AND ", $tags);

	// $query = "SELECT c.bt_author, c.bt_id, c.bt_article_id, c.bt_content, a.bt_title FROM commentaires c LEFT JOIN articles a ON a.bt_id=c.bt_article_id WHERE c.bt_statut=1 AND a.bt_statut=1 ORDER BY c.bt_id DESC LIMIT 5";
	$query = "SELECT a.bt_id, a.bt_date, a.bt_title, a.bt_content, a.bt_link, a.bt_statut FROM articles a WHERE a.bt_statut=1  AND ".$tags." ORDER BY a.bt_date DESC LIMIT 5";
	$tableau = liste_elements($query, array(), 'articles');

	if (isset($tableau)) {
		$listeLastArticles = '<ul class="encart_lastarticles">'."\n";
		foreach ($tableau as $i => $article) {
			$article['contenu_abbr'] = strip_tags($article['bt_content']);
			$article['title_abbr'] = strip_tags($article['bt_title']);
			// limits length of comment abbreviation and name
			if (strlen($article['contenu_abbr']) >= 60) {
				$article['contenu_abbr'] = mb_substr($article['contenu_abbr'], 0, 59).'…';
			}
			if (strlen($article['title_abbr']) >= 60) {
				$article['title_abbr'] = mb_substr($article['title_abbr'], 0, 59).'…';
			}
			$listeLastArticles .= '<b title="'.date_formate($article['bt_id']).'">'.$article['title_abbr'].'</b><br/><a href="'.$article['bt_link'].'">'.$article['contenu_abbr'].'</a>'.'<br>'."\n";
		}
		$listeLastArticles .= '</ul>'."\n";
		return $listeLastArticles;
	} else {
		return $GLOBALS['lang']['no_articles'];
	}
}

function encart_links() {
	mb_internal_encoding('UTF-8');
	// $query = "SELECT c.bt_author, c.bt_id, c.bt_article_id, c.bt_content, a.bt_title FROM commentaires c LEFT JOIN articles a ON a.bt_id=c.bt_article_id WHERE c.bt_statut=1 AND a.bt_statut=1 ORDER BY c.bt_id DESC LIMIT 5";
	$query = "SELECT l.bt_id, l.bt_title, l.bt_link, l.bt_content FROM links l ORDER BY l.bt_id DESC LIMIT 5";
	$tableau = liste_elements($query, array(), 'links');
	if (isset($tableau)) {
		$listeLastLinks = '<ul class="encart_lastlinks">'."\n";
		foreach ($tableau as $i => $link) {
			$link['contenu_abbr'] = strip_tags($link['bt_content']);
			$link['title_abbr'] = strip_tags($link['bt_title']);
			// limits length of comment abbreviation and name
			if (strlen($link['contenu_abbr']) >= 60) {
				$link['contenu_abbr'] = mb_substr($link['contenu_abbr'], 0, 59).'…';
			}
			if (strlen($link['title_abbr']) >= 60) {
				$link['title_abbr'] = mb_substr($link['title_abbr'], 0, 59).'…';
			}
			$listeLastLinks .= '<b title="'.date_formate($link['bt_id']).'">'.$link['title_abbr'].'</b><br/><a href="index.php?mode=links&amp;id='.$link['bt_id'].'">'.$link['contenu_abbr'].'</a>'.'<br>'."\n";
		}
		$listeLastLinks .= '</ul>'."\n";
		return $listeLastLinks;
	} else {
		return $GLOBALS['lang']['no_links'];
	}
}

function encart_categories($mode) {
	if ($GLOBALS['activer_categories'] == '1') {
		$where = ($mode == 'links') ? 'links' : 'articles';
		$ampmode = ($mode == 'links') ? '&amp;mode=links' : '';

		$liste = list_all_tags($where, '1');
		if ($mode == '') {
			$tmp = array_flip(array_merge($GLOBALS['static_tags']['links'], $GLOBALS['static_tags']['articles']));
			$liste = array_diff_key($liste, $tmp);
		}else{
			$liste = array_diff_key($liste, $GLOBALS['static_tags'][$mode]);
		}

		// attach non-diacritic versions of tag, so that "ééé" does not pass after "zzz" and re-indexes
		foreach ($liste as $tag => $nb) {
			$liste[$tag] = array(diacritique(trim($tag), FALSE, FALSE), $nb);
		}
		// sort tags according non-diacritics versions of tags
		$liste = array_reverse(tri_selon_sous_cle($liste, 0));
		$uliste = '<ul>'."\n";

		// remove diacritics: array is now (arr)liste { (str)tag=> (in)nb }
		foreach ($liste as $tag => $nb) {
			$liste[$tag] = $nb[1];
		}

		// create the <UL> with "tags (nb) "
		$i = 1;
		$total = count($liste);
		foreach($liste as $tag => $nb) {
			$tagurl = urlencode(trim($tag));
			$uliste .= "\t".'<a href="'.basename($_SERVER['PHP_SELF']).'?tag='.$tagurl.$ampmode.'" rel="tag">'.ucfirst($tag).'</a>';
			if($i % 3 == 0){
				$uliste .= "<br>";
			}else if($i < $total){
				$uliste .= " - ";
			}
			$i++;
		}
		$uliste .= '</ul>'."\n";
		return $uliste;
	}
}

function lien_pagination() {
	if (!isset($GLOBALS['param_pagination']) or isset($_GET['d']) or isset($_GET['liste']) or isset($_GET['id']) ) {
		return '';
	}
	else {
		$nb = $GLOBALS['param_pagination']['nb'];
		$nb_par_page = $GLOBALS['param_pagination']['nb_par_page'];
	}
	$page_courante = (isset($_GET['p']) and is_numeric($_GET['p'])) ? $_GET['p'] : 0;
	$qstring = remove_url_param('p');

	if ($page_courante <=0) {
		$lien_precede = '';
		$lien_suivant = '<a href="'.htmlspecialchars(basename($_SERVER['PHP_SELF'])).'?'.$qstring.'&amp;p=1" rel="next">'.$GLOBALS['lang']['label_suivant'].' &#187;</a>';
		if ($nb < $nb_par_page) { // évite de pouvoir aller dans la passé s’il y a moins de 10 posts
			$lien_suivant = '';
		}
	}
	elseif ($nb < $nb_par_page) { // évite de pouvoir aller dans l’infini en arrière dans les pages, nottament pour les robots.
		$lien_precede = '<a href="'.htmlspecialchars(basename($_SERVER['PHP_SELF'])).'?'.$qstring.'&amp;p='.($page_courante-1).'" rel="prev">&#171; '.$GLOBALS['lang']['label_precedent'].'</a>';
		$lien_suivant = '';
	} else {
		$lien_precede = '<a href="'.htmlspecialchars(basename($_SERVER['PHP_SELF'])).'?'.$qstring.'&amp;p='.($page_courante-1).'" rel="prev">&#171; '.$GLOBALS['lang']['label_precedent'].'</a>';
		$lien_suivant = '<a href="'.htmlspecialchars(basename($_SERVER['PHP_SELF'])).'?'.$qstring.'&amp;p='.($page_courante+1).'" rel="next">'.$GLOBALS['lang']['label_suivant'].' &#187;</a>';
	}

	$glue = ' – ';
	if (empty($lien_precede) or empty($lien_suivant)) $glue = ' ';

	return '<p class="pagination">'.$lien_precede.$glue.$lien_suivant.'</p>';
}


function liste_tags($billet, $html_link) {
	$tags = ($billet['bt_type'] == 'article') ? $billet['bt_categories'] : $billet['bt_tags'];
	$mode = ($billet['bt_type'] == 'article') ? '' : '&amp;mode=links';
	if (!empty($tags)) {
		$tag_list = explode(', ', $tags);
		// remove diacritics, so that "ééé" does not passe after "zzz" and re-indexes
		foreach ($tag_list as $i => $tag) {
			$tag_list[$i] = array('t' => trim($tag), 'tt' => diacritique(trim($tag), FALSE, FALSE));
		}
		$tag_list = array_reverse(tri_selon_sous_cle($tag_list, 'tt'));

		foreach ($tag_list as $i => $tag) {
			$tag_list[$i] = $tag['t'];
		}

		$nb_tags = sizeof($tag_list);
		$liste = '';
		if ($html_link == 1) {
			foreach($tag_list as $tag) {
				$tag = trim($tag);
				$tagurl = urlencode($tag);
				$liste .= '<a href="'.basename($_SERVER['PHP_SELF']).'?tag='.$tagurl.$mode.'" rel="tag">'.$tag.'</a>';
			}
		} else {
			foreach($tag_list as $tag) {
				$tag = trim($tag);
				$tag = diacritique($tag, 0, 0);
			}
		}
	} else {
		$liste = '';
	}
	return $liste;
}


/* From DB : returns a HTML list with the feeds (the left panel) */
function feed_list_html() {
	// First item : button with all feeds
	$html = "\t\t".'<li class="active-site"><button type="button" onclick="document.getElementById(\'markasread\').onclick=function(){markAsRead(\'all\',\'\');}; return rss_feedlist(Rss);">'.$GLOBALS['lang']['rss_label_all_feeds'].'</button><span id="global-count-posts" data-nbrun=""></span></li>'."\n";
	$feeds_nb = rss_count_feed();

	$feed_urls = array();
	foreach ($feeds_nb as $i => $feed) {
		$feed_urls[$feed['bt_feed']] = $feed;
	}

	// sort feeds by folder
	$folders = array();
	foreach ($GLOBALS['liste_flux'] as $i => $feed) {
		$folders[$feed['folder']][] = $feed;
	}
	krsort($folders);

	// creates html : lists RSS feeds without folder separately from feeds with a folder
	foreach ($folders as $i => $folder) {
		$li_html = "";
		$folder_count = 0;
		foreach ($folder as $j => $feed) {
			$js = 'onclick="document.getElementById(\'markasread\').onclick=function(){markAsRead(\'site\', \''.$feed['link'].'\');}; sortSite(this);"';
			if (array_key_exists($feed['link'], $feed_urls) and $feed_urls[$feed['link']]['nbrun'] != 0) {
				$li_html .= "\t\t".'<li class="feed-not-null" data-nbrun="'.$feed_urls[$feed['link']]['nbrun'].'" data-feedurl="'.$feed['link'].'" title="'.$feed['link'].'">';
				$li_html .= '<button type="button" '.(($feed['iserror'] > 2) ? 'class="feed-error" ': ' ' ).$js.'>'.$feed['title'].'</button>';
				$li_html .= '<span>('.$feed_urls[$feed['link']]['nbrun'].')</span>';
				$li_html .= '</li>'."\n";
				$folder_count += $feed_urls[$feed['link']]['nbrun'];
			} else {
				$li_html .= "\t\t".'<li data-nbrun="0" data-feedurl="'.$feed['link'].'" title="'.$feed['link'].'">';
				$li_html .= '<button type="button" '.(($feed['iserror'] > 2) ? 'class="feed-error" ': ' ' ).$js.'>'.$feed['title'].'</button>';
				$li_html .= '<span>(0)</span>';
				$li_html .= '</li>'."\n";
			}

		}

		if ($i != '') {
			$html .= "\t\t".'<li class="feed-folder'.(($folder_count > 0) ? ' feed-not-null' : '').'" data-nbrun="'.$folder_count.'" data-folder="'.$i.'">'."\n";
			$html .= "\t\t\t".'<span class="feedtitle">'."\n";
			$html .= "\t\t\t\t".'<button type="button" onclick="return hideFolder(this)" class="unfold">+</button>'."\n";
			$html .= "\t\t\t\t".'<button type="button" onclick="document.getElementById(\'markasread\').onclick=function(){markAsRead(\'folder\', \''.$i.'\');}; sortFolder(this);">'.$i.'</button><span>('.$folder_count.')</span>'."\n";
			$html .= "\t\t\t".'</span>'."\n";
			$html .= "\t\t\t".'<ul>'."\n\t\t";
		}
		$html .= $li_html;
		if ($i != '') {
			$html .= "\t\t\t".'</ul>'."\n";
			$html .= "\t\t".'</li>'."\n";
		}

	}

	return $html;
}
