<?php
// This file is part of the WET-BOEW-Moodle (GCWeb) theme for Moodle - http://moodle.org/
//
// WET-BOEW-Moodle (GCWeb) is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// WET-BOEW-Moodle (GCWeb) is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * WET-BOEW GCWeb French language.
 *
 * @package   theme_gcweb
 * @copyright 2016-2020 TNG Consulting Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

/*******************************
 * Plugin specific.
 *******************************/

// The name of this plugin.
$string['pluginname'] = 'WET-BOEW-Moodle: GCWeb';
$string['privacy:metadata'] = 'Le thème WET-BOEW-Moodle: GCWeb ne saufegarde aucun données personel des utilisateurs.';
$string['configtitle'] = 'WET-BOEW-GCWeb';

// Description shown in the Theme Selector.
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
 <h2>Thème GCWeb <abbr title="boîte à outils de l’expérience Web pour Moodle">WET-BOEW-MOODLE</abbr></h2>
 <p><img class="img-polaroid" src="gcweb/pix/screenshot.png"></p>
</div>
<div class="well">
 <h2>Credits</h2>
 <h3>À propos</h3>
 <p>WET-BOEW-MOODLE GCWeb, version [version], est un th&egrave;me réactif de Moodle basé sur les derni&egrave;res normes Web pour le gouvernement du Canada et le th&egrave;me Boost de Moodle.</p>
 <p>Ce th&egrave;me est distribué sous licence GPL (GNU General Public License). Vous pouvez trouver une copie compl&egrave;te de la licence sur: http://www.gnu.org/licenses/</p>
 <p>Auteurs&nbsp;: Michael Milette, <a href="https://www.tngconsulting.ca">www.tngconsulting.ca</a></p>
 <h3>Rapport de bugs</h3>
 <p>Vous pouvez signaler des bogues &agrave; l\'aide de GitHub Gestionnaire d\'incident &agrave; l\'adresse https://github.com/wet-boew/wet-boew-moodle/issues.</p>
 <h3>Documentation</h3>
 <p>La documentation est disponible dans le fichier README du projet et dans le projet Wiki</p>
 <h3>Démo</h3>
 <p>Un site Web de démonstration est prévue dans le future.</p>
 <h3>Termes et conditions d\'utilisation</h3>
 <p>Sauf indication contraire, le projet WET-BOEW-MOODLE dans son ensemble, le contenu du wiki, la documentation et le code source sont protégés par Copyright &copy; 2016 par TNG Consulting Inc., avec des parties pouvant faire l\'objet d\'une contribution / protégées par le droit d\'auteur. WET-BOEW-MOODLE est fourni gratuitement en tant que logiciel open source, peut &ecirc;tre redistribué et / ou modifié selon les termes de la licence publique générale GNU version 3.0 ou ultérieure.</p>
 <p>Il est distribué dans l\'espoir qu\'il vous sera utile. Cependant, il n&rsquo;ya aucune garantie, implicite ou autre, de qualité marchande ou d&rsquo;adéquation &agrave; un usage quelconque. Voir la licence publique générale GNU pour plus de détails.</p>
 <p>Si pour une raison quelconque une copie de la licence publique générale GNU n\'était pas incluse dans ce projet, vous pouvez la visualiser en ligne &agrave; l\'adresse suivante: https://www.gnu.org/licenses/gpl-3.0.fr.html</p>
</div>
</div>';

// Block regions available in this theme.
$string['region-side-pre'] = 'Gauche'; // Actually top right.
$string['region-side-post'] = 'Droit'; // Actually bottom right.
$string['region-content-pre'] = 'Haut';
$string['region-content-post'] = 'Bas';

/********************************************
 * WET-BOEW-Moodle GCWeb Theme Settings.
 ********************************************/

//
// General Settings tab.
//
$string['filtercoursesbylang'] = 'Filtrer les cours par langue imposée';
$string['filtercoursesbylang_desc'] = 'Les cours dont la langue est imposée, si définie, ne correspondent pas à la langue actuelle seront supprimés des listes de cours et des résultats de recherche.';

$string['hideconditionallyhidden'] = 'Masquer les activités cachées sur la page d\'accueil';
$string['hideconditionallyhidden_desc'] = 'Les activités sur la page d\'accueil masquées de manière conditionnelle ne seront pas visibles sauf si la mode de modification et cette option sont activée.';

//
// Advanced Settings tab (none yet. Uses strings from Boost theme).
//

//
// User Profile Fields tab (the rest are all built into Moodle).
//

//
// Header tab.
//

//
// Footer tab.
//

//
// About This Theme tab.
//
$string['abouttheme'] = 'A propos du theme';

/**************************************
 * Visible to everyone.
 **************************************/
// Accessibility links
$string['skiptomain'] = 'Passer au contenu principal';
$string['skiptoabout'] = 'Passer à «&nbsp;À propos&nbsp;»';
$string['skiptosectnav'] = 'Passer au menu de la section';

// Language toggle.
$string['languageselection'] = 'Sélection de la langue';

// ALT text for Government of Canada logo.
$string['governmentofcanada'] = 'Gouvernement du Canada / <span lang="en">Government of Canada</span>';

// Search form.
$string['searchandmenus'] = 'Menu et recherche';
$string['searchwebsite'] = 'Rechercher le site Web';
$string['searchplaceholder'] = 'Rechercher les cours';
$string['search'] = 'Recherche';

// Custom menu.
$string['mainmenu'] = 'Menu de navigation principal';
$string['topicsmenu'] = 'Menu de la section';
$string['youarehere'] = 'Vous êtes ici&nbsp;:';
$string['menu'] = 'Menu';

// TODO: Identify.
$string['esckey'] = 'cléf échape';
$string['close'] = 'Fermer';

// User menu.
$string['accountmenu'] = 'Menu des paramètres du compte';

// Account buttons.
$string['register'] = 'Inscription';
$string['signoninfo'] = 'Information de connexion';
$string['signedinas'] = 'Connectez en tant que';
$string['accountsettings'] = 'Menu des paramètres du compte';
$string['signon'] = 'Ouvrir une session';
$string['signout'] = 'Fermer la session';

// Report a problem on the page.
$string['reportaproblem'] = 'Signaler un problème sur cette page';
$string['selectallthatapply'] = 'Veuillez cocher toutes les réponses pertinentes :';
$string['somethingisbroken'] = 'Quelque chose ne fonctionne pas';
$string['providemoredetail'] = 'Fournir plus de détails (facultatif)&nbsp;:';
$string['spellinggrammarmistakes'] = 'Il y a des erreurs d’orthographe ou de grammaire';
$string['informationwrong'] = 'L\'information est erronée';
$string['informationoutdated'] = 'L\'information n’est plus à jour';
$string['notwhatlookingfor'] = 'Je ne trouve pas ce que je cherche';
$string['describewhatlookingfor'] = 'Décrivez ce que vous recherchez (facultatif)&nbsp;:';
$string['other'] = 'Autre';
$string['submit'] = 'Soumettre';
$string['thankyou'] = 'Merci pour votre aide!';
$string['enquiries'] = 'Vous ne recevrez pas de réponses. Pour des questions, veuillez <a href="https://www.canada.ca/en/contact.html">nous contactez</a>.';

// Footer.
$string['topofpage'] = 'Haut de la page';
$string['datemodified'] = 'Date de modification&nbsp;:';
$string['symbol'] = 'Symbole du gouvernement du Canada';
$string['footnoteheading'] = 'À propos de cette application Web';

// Buttons for course listings.
$string['courseinfo'] = 'En savoir plus<span class="sr-only"> sur le cours&nbsp;:</span>';
$string['courseenter'] = 'Entrez<span class="sr-only"> dans le cours&nbsp;:</span>';
$string['coursereview'] = 'Reviser<span class="sr-only"> le cours complété&nbsp;:</span>';

// 404 Error: Page not found.
$string['err404title'] = 'Nous ne pouvons trouver cette page Web (Erreur 404) / We couldn&#x27;t find that Web page (Error 404)';
$string['err404body'] = '
<header role="banner" id="wb-bnr" class="container">
	<div class="row">
		<div class="col-sm-6">
			<img id="gcwu-sig" src="{$a}/theme/gcweb/framework/GCWeb/assets/sig-blk-fr.svg" alt="Gouvernement du Canada / Government of Canada">
		</div>
		<div class="col-sm-6">
			<img id="wmms" src="{$a}/theme/gcweb/framework/GCWeb/assets/wmms-blk.svg" alt="Symbole du gouvernement du Canada">
		</div>
	</div>
</header>
<main role="main" property="mainContentOfPage" typeof="WebPageElement" class="container">
	<div class="row mrgn-tp-lg">
		<h1 class="wb-inv">Nous ne pouvons trouver cette page Web (Erreur 404) / <span lang="en">We couldn\'t find that Web page (Error 404)</span></h1>
		<section class="col-md-6">
			<h2><span class="glyphicon glyphicon-warning-sign mrgn-rght-md"></span> Nous ne pouvons trouver cette page Web (Erreur 404)</h2>
			<p>Nous sommes désolés que vous ayez abouti ici. Il arrive parfois qu\'une page ait été déplacée ou supprimée. Heureusement, nous pouvons vous aider à trouver ce que vous cherchez.</p>
			<ul>
				<li>Retournez à la <a href="{$a}/?redirect=0&lang=fr">page d\'accueil</a></li>
			</ul>
        </section>
        <section class="col-md-6" lang="en">
			<h2><span class="glyphicon glyphicon-warning-sign mrgn-rght-md"></span> We couldn\'t find that Web page (Error 404)</h2>
			<p>We\'re sorry you ended up here. Sometimes a page gets moved or deleted, but hopefully we can help you find what you\'re looking for.</p>
			<ul>
				<li>Return to the <a href="{$a}/?redirect=0&lang=en">home page</a></li>
			</ul>
		</section>
	</div>
</main>
';
