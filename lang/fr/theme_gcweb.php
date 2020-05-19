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
$string['pluginname'] = 'WET-BOEW-Moodle&nbsp;: GCWeb';
$string['privacy:metadata'] = 'Le thème WET-BOEW-Moodle&nbsp;: GCWeb ne sauvegarde aucune donnée personnelle des utilisateurs.';
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
    <p>WET-BOEW-MOODLE&nbsp;: GCWeb, version [version], est un thème réactif de Moodle basé sur les  normes <a href="http://www.tbs-sct.gc.ca/ws-nw/index-eng.asp">Web pour le gouvernement du Canada</a> GCWeb et le thème de base Moodle Boost.</p>
    <p>Auteurs&nbsp;: Michael Milette, <a href="https://www.tngconsulting.ca">www.tngconsulting.ca</a></p>
    <h3>Rapport de bugs</h3>
    <p>Vous pouvez signaler des bogues à l\'aide de GitHub Gestionnaire d\'incident à <a href="https://github.com/wet-boew/wet-boew-moodle/issues">github.com/wet-boew/wet-boew-moodle/issues</a>.</p>
    <h3>Documentation</h3>
    <p>La documentation est disponible dans <a href="https://github.com/wet-boew/wet-boew-moodle/">le fichier README du projet</a> et dans le in <a href="https://github.com/wet-boew/wet-boew-moodle/wiki">Wiki du projet</a>.</p>
    <h3>Démonstration</h3>
    <p>Un site Web de démonstration est disponible au <a href="https://wet-boew-moodle.tngconsulting.ca">wet-boew-moodle.tngconsulting.ca</a>. </p>
    <h3>Termes et conditions d\'utilisation</h3>
    <p>Sauf indication contraire, le projet WET-BOEW-MOODLE dans son ensemble, le contenu du wiki, la documentation, le site de démonstration, le cours <span lang="en">WET-BOEW-Moodle Widgets : Working Examples</span> et le code source sont protégés par Copyright © 2016 par TNG Consulting Inc.</p>
    <p>WET-BOEW-MOODLE est fourni gratuitement en tant que logiciel <span lang="en">open-source</span> et peut être redistribué et / ou modifié selon les termes de la licence publique générale (LPG) GNU version 3.0 ou ultérieure. Il est distribué dans l\'espoir qu\'il vous sera utile. Cependant, il n\'y a aucune garantie, implicite ou autre, de qualité marchande ou d\'adéquation à un usage quelconque. Voir la licence publique générale GNU pour plus de détails.</p>
    <p>Moodle est copyright © à partir de 1999, Martin Dougiamas avec des parties pouvant faire l\'objet d\'une contribution / protégées par le droit d\'auteur selon les termes de la GNU GPL 3.0</p>
    <p>Si, pour une raison quelconque, une copie de la licence publique générale GNU n\'était pas incluse dans ce projet, vous pouvez la visualiser en ligne à l\'adresse suivante: <a href="https://www.gnu.org/licenses/gpl-3.0.fr.html">www.gnu.org/licenses/gpl-3.0.fr.html</a></p>
    <p>La boîte à outils de l\'expérience Web (BOEW) est protégé par le droit d\'auteur de la Couronne du gouvernement du Canada et distribué sous la licence MIT : <a href="https://wet-boew.github.io/v4.0-ci/Licence-fr.html">wet-boew.github.io/v4.0-ci/Licence-fr.html</a></p>
    <p>Le mot-symbole « Canada » et les éléments graphiques connexes liés à cette distribution sont protégés en vertu des lois portant sur les marques de commerce et le droit d\'auteur. Aucune autorisation n\'est accordée pour leur utilisation à l\'extérieur des paramètres du programme de coordination de l\'image de marque du gouvernement du Canada. Pour obtenir davantage de renseignements à ce sujet, veuillez consulter <a href="https://www.tbs-sct.gc.ca/fip-pcim/index-fra.asp">www.tbs-sct.gc.ca/fip-pcim/index-fra.asp</a></p>
    <p>La propriété du droit d\'auteur de tout logiciel tiers distribué avec ce thème est conservée par les détenteurs du droit d\'auteur mentionnés dans ces fichiers. Nous demandons aux utilisateurs de lire les licences des tiers indiqués à titre de référence dans ces logiciels.</p>
    <p>Les avis et attributions ci-dessus doivent être inclus dans toutes les copies ou parties du logiciel.</p>
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
$string['hidelocallogin'] = 'Masquer la connexion locale';
// $string['hidelocallogin_desc'] = '';
$string['confirmlogout'] = 'Confirmer fin de session';
// $string['confirmlogout_desc'] = '';
// $string['showhometitle'] = '';
// $string['showhometitle_desc'] = '';
// $string['showaccountsettings'] = '';
// $string['showaccountsettings_desc'] = '';
// $string['hometitle'] = '';
// $string['hometitle_desc'] = '';
// $string['hidefrontpagelinkstopages'] = '';
// $string['hidefrontpagelinkstopages_desc'] = '';
$string['hideconditionallyhidden'] = 'Masquer les activités cachées sur la page d\'accueil';
$string['hideconditionallyhidden_desc'] = 'Les activités sur la page d\'accueil masquées de manière conditionnelle ne seront pas visibles sauf si la mode de modification et cette option sont activée.';
$string['titlesitename'] = 'Ajouter le nom du site titre';
$string['titlesitename_desc'] = 'Ajouter le nom du site au balise HTML <em lang="en">title</em> de chaque page.';
// $string['shownavdrawer'] = '';
// $string['shownavdrawer_desc'] = '';
// $string['navdraweropen'] = '';
// $string['navdraweropen_desc'] = '';
$string['courselistsettings'] = 'Listes des cours';
// $string['courselistsettings_desc'] = '';
// Note: If you modify the list of layouts, you must change the language file, settings/general.php,
// wet-boew-moodle.css, wet-boew-moodle-min.css and classes/output/course_renderer.php.
$string['courselistlayout'] = 'Disposition';
$string['courselistlayout_desc'] = 'Choisissez le style de mise en page pour les listes de cours.';
$string['courselistlayout-3'] = 'Liste extensible (nom/détails)';
$string['courselistlayout-2'] = 'Format de table';
$string['courselistlayout-1'] = 'Maçonnerie';
$string['courselistlayout0'] = 'Moodle par défaut (amélioré)';
$string['courselistlayout1'] = 'Cartes';
$string['courselistlayout2'] = 'Superposition (en haut)';
$string['courselistlayout3'] = 'Superposition (en bas)';
$string['courselistlayout4'] = 'Minimal avec la flèche au-dessus de l’image';
$string['courselistlayout5'] = 'Minimal avec flèche à gauche du nom de cours';
$string['courselistcolumns'] = 'Colonnes';
// $string['courselistcolumns_desc'] = '';
$string['cardheader'] = 'Image de cours';
// $string['cardheader_desc'] = '';
$string['cardheaderopt0'] = 'Aucun';
$string['cardheaderopt1'] = 'Catégorie';
$string['cardheaderopt2'] = 'Nom du cours';
$string['cardfooter'] = 'Bas de carte';
$string['cardfooter_desc'] = '';
$string['cardfooteropt0'] = 'Aucune';
$string['cardfooteropt1'] = 'Bouton d\'inscription';
$string['cardfooteropt2'] = 'Champs de cours personnalisés';
$string['cardfooteropt3'] = 'Contacts';
$string['cardfooteropt4'] = 'Barre de progression';
$string['cardaspect'] = 'Rapport hauteur/largeur';
// $string['cardaspect_desc'] = '';
$string['cardimage'] = 'Image de cours';
// $string['cardimage_desc'] = '';
$string['cardscroll'] = 'Défiler';
// $string['cardscroll_desc'] = '';
$string['cardcategory'] = 'Catégorie';
// $string['cardcategory_desc'] = '';
$string['cardsummary'] = 'Résumé';
// $string['cardsummary_desc'] = '';
$string['cardcustomfields'] = 'Champs personnalisés';
// $string['cardcustomfields_desc'] = '';
$string['cardcontacts'] = 'Contacts de cours';
// $string['cardcontacts_desc'] = '';
$string['cardprogress'] = 'Barre de progression';
// $string['cardprogress_desc'] = '';
$string['cardbutton'] = 'Bouton';
// $string['cardbutton_desc'] = '';
$string['filtercoursesbytag'] = 'Filtrer les cours par étiquette';
$string['filtercoursesbytag_desc'] = '';
$string['filtercoursesbylang'] = 'Filtrer les cours par langue imposée';
$string['filtercoursesbylang_desc'] = 'Les cours dont la langue est imposée, si définie, ne correspondent pas à la langue actuelle seront supprimés des listes de cours et des résultats de recherche.';
//
// Advanced Settings tab (none yet. Uses strings from Boost theme).
//
//
// User Profile Fields tab (the rest are all built into Moodle).
//
// $string['showprofile_heading'] = '';
// $string['showprofilesection_desc'] = '';
//
// Header tab.
//
$string['header'] = 'En-tête ';
$string['showumprofilelink'] = 'Afficher le lien de profil ';
$string['showumprofilelink_desc'] = 'Afficher ou masquer le lien de profil dans le menu utilisateur ';
$string['showumlogoutlink'] = 'Afficher le lien de déconnexion';
// $string['showumlogoutlink_desc'] = '';
$string['showsignon'] = 'Afficher le bouton <em>Se connecter</em>';
// $string['showsignon_desc'] = '';
$string['showregister'] = 'Afficher le bouton <em>S\'inscrire</em>';
// $string['showregister_desc'] = '';
$string['alternatelogouturl'] = 'URL de déconnexion alternative';
// $string['alternatelogouturl_desc'] = '';
$string['showsearch'] = 'Afficher la recherche de cours ';
// $string['showsearch_desc'] = '';
$string['wraprecentlyaccessedcourses'] = 'Sur le tableau de bord. ';
// $string['wraprecentlyaccessedcourses_desc'] = '';
$string['showhomebreadcrumbs'] = 'Fil d\'ariane sur la page principale';
// $string['showhomebreadcrumbs_desc'] = '';
$string['prebreadcrumbs'] = 'Débût du fil d\'ariane';
// $string['prebreadcrumbs_desc'] = '';
//
// Footer tab.
//
$string['footer'] = 'Bas de page';
// $string['showproblem'] = '';
// $string['showproblem_desc'] = '';
// $string['problembuttonurl'] = '';
// $string['problembuttonurl_desc'] = '';
// $string['footershowmoodlelogo'] = '';
// $string['footershowmoodlelogo_desc'] = '';
// $string['footershowmoodledocs'] = '';
// $string['footershowmoodledocs_desc'] = '';
$string['footershowhomelink'] = 'Lien d’accueil ';
// $string['footershowhomelink_desc'] = '';
// $string['footershowlogininfo'] = '';
// $string['footershowlogininfo_desc'] = '';
// $string['footershowresetusertours'] = '';
// $string['footershowresetusertours_desc'] = '';
$string['footnote'] = 'Note de bas de page';
// $string['footnote_desc'] = '';
//
// About This Theme tab.
//
$string['abouttheme'] = 'À propos du theme ';
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
$string['coursecontinue'] = 'Continuer<span class="sr-only"> le cours&nbsp;:</span>';
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

$string['styleguide'] = 'Style guide';

$string['styleguidehtml'] = '
<div class="alert alert-warning">
   <p>This page is still in development. Content is not rendered accurately.</p>
</div>
<section>
    <h2>Heading 2 (<code>h2</code>)</h2>
    <section>
        <h3>Heading 3 (<code>h3</code>)</h3>
        <section>
            <h4>Heading 4 (<code>h4</code>)</h4>
            <section>
                <h5>Heading 5 (<code>h5</code>)</h5>
                <section>
                    <h6>Heading 6 (<code>h6</code>)</h6>
                    <p>Paragraph - default appearance</p>
                </section>
            </section>
        </section>
    </section>
</section>
<p><a href="#">Link</a></p>
<ul>
    <li>
        unordered list (<code>ul</code>) - level 1
        <ul>
            <li>
                unordered list (<code>ul</code>) - level 2
                <ul>
                    <li>unordered list (<code>ul</code>) - level 3</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<ol>
    <li>ordered list (<code>ol</code>) - level 1</li>
    <li>
        ordered list (<code>ol</code>) - level 1
        <ol>
            <li>ordered list (<code>ol</code>) - level 2</li>
            <li>
                ordered list (<code>ol</code>) - level 2
                <ol>
                    <li>ordered list (<code>ol</code>) - level 3</li>
                    <li>ordered list (<code>ol</code>) - level 3</li>
                </ol>
            </li>
        </ol>
    </li>
</ol>
<table class="table table-striped">
    <caption>Table caption</caption>
    <thead>
        <tr>
            <th scope="col">Table header (<code>th</code>)</th>
            <th scope="col">Table header (<code>th</code>)</th>
            <th scope="col">Table header (<code>th</code>)</th>
            <th scope="col">Table header (<code>th</code>)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
        </tr>
        <tr>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
        </tr>
        <tr>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
            <td>Table data (<code>td</code>)</td>
        </tr>
    </tbody>
</table>
<form method="post" action="#" class="form-horizontal">
    <div class="form-group">
        <label for="data1" class="col-sm-3 control-label">Form <code>input</code></label>
        <div class="col-sm-9">
            <input type="text" id="data1" name="data1" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="data2" class="col-sm-3 control-label">Form <code>textarea</code></label>
        <div class="col-sm-9">
            <textarea id="data2" rows="3" cols="15" name="data2" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="data4" class="col-sm-3 control-label">Form <code>select</code></label>
        <div class="col-sm-9">
            <select name="data4" id="data4" class="form-control">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
<blockquote>
    <p>"<code>blockquote</code>"</p>
    <footer><code>footer</code> <cite><code>cite</code></cite></footer>
</blockquote>
<h2 id="cnt-wdth-lmtd">Section with limited width content</h2>
<p>Add the CSS class name <code>.cnt-wdth-lmtd</code> to a sectioning element <code>&lt;section class="cnt-wdth-lmtd"&gt;...&lt;section&gt;</code> inside the main content of your page. More guidance are provided in the Content and IA specification.</p>
<section class="cnt-wdth-lmtd">
    <h3>Section example with limited width content</h3>
    <p>Different example text. Different example text. Different example text. Different example text. Different example text. Different example text. Different example text. Different example text.</p>
</section>
<h2 id="call-to-action">Call to action button</h2>
<p>Add the CSS class name <code>.btn-call-to-action</code> to a your button or link that define the main call for action for a page. For example the initiation button/link in a service initiation pages. More guidance are provided in the Content and IA specification.</p>
<div class="row">
    <div class="col-sm-6">
        <h3>Link</h3>
        <p class="mrgn-bttm-0"><a class="btn btn-call-to-action" href="#">[Call to action]</a></p>
        <pre><code>&lt;p&gt;&lt;a class="btn <strong>btn-call-to-action</strong>" href="#"&gt;[Call to action]&lt;/a&gt;&lt;/p&gt;</code></pre>
    </div>
    <div class="col-sm-6">
        <h3>Button</h3>
        <button class="btn btn-call-to-action" type="button">[Call to action]</button>
        <pre><code>&lt;button class="btn <strong>btn-call-to-action</strong>" type="button"&gt;[Call to action]&lt;/button&gt;</code></pre>
    </div>
</div>
';
