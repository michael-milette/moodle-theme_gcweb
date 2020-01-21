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
 * @copyright 2016-2019 TNG Consulting Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// A description shown in the admin theme selector.
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
 <h2>Thème GCWeb <abbr title="boîte à outils de l’expérience Web pour Moodle">WET-BOEW-MOODLE</abbr></h2>
 <p><img class="img-polaroid" src="gcweb/pix/screenshot.png" /></p>
</div>
<div class="well">
 <h2>Credits</h2>
 <h3>À propos</h3>
 <p>WET-BOEW-MOODLE est un th&egrave;me réactif de Moodle basé sur les derni&egrave;res normes Web pour le gouvernement du Canada et le th&egrave;me Boost de Moodle.</p>
 <p>Ce th&egrave;me est distribué sous licence GPL (GNU General Public License). Vous pouvez trouver une copie compl&egrave;te de la licence sur: http://www.gnu.org/licenses/</p>
 <p>Auteurs&nbsp;: Michael Milette<br />
 Contact&nbsp;: info@tngconsulting.ca<br>
 Site Web&nbsp;: www.tngconsulting.ca</p>
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

// The name of our plugin.
$string['pluginname'] = 'WET-BOEW-Moodle: GCWeb';
$string['privacy:metadata'] = 'Le thème WET-BOEW-Moodle: GCWeb ne saufegarde aucun données personel des utilisateurs.';
$string['configtitle'] = 'WET-BOEW-GCWeb';

// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Gauche';
$string['region-side-post'] = 'Droit';
$string['region-content-pre'] = 'Haut';
$string['region-content-post'] = 'Bas';

/* Theme specific strings. */
$string['skiptomain'] = 'Passer au contenu principal';
$string['skiptoabout'] = 'Passer à «&nbsp;À propos&nbsp;»';
$string['skiptosectnav'] = 'Passer au menu de la section';

$string['languageselection'] = 'Sélection de la langue';

$string['governmentofcanada'] = 'Gouvernement du Canada / <span lang="en">Government of Canada</span>';

$string['searchandmenus'] = 'Menu et recherche';
$string['searchwebsite'] = 'Rechercher le site Web';
$string['searchplaceholder'] = 'Rechercher les cours';
$string['search'] = 'Recherche';

$string['mainmenu'] = 'Menu de navigation principal';
$string['topicsmenu'] = 'Menu de la section';
$string['youarehere'] = 'Vous êtes ici&nbsp;:';
$string['menu'] = 'Menu';
$string['esckey'] = 'cléf échape';
$string['close'] = 'Fermer';

$string['accountmenu'] = 'Menu du compte';
$string['register'] = 'Inscription';
$string['signoninfo'] = 'Information de connexion';
$string['signedinas'] = 'Connectez en tant que';
$string['accountsettings'] = 'Menu des paramètres du compte';
$string['signon'] = 'Ouvrir une session';
$string['signout'] = 'Fermer la session';

$string['topofpage'] = 'Haut de la page';
$string['datemodified'] = 'Date de modification&nbsp;:';

/* Problem Button */
$string['reportaproblem'] = "Signaler un problème sur cette page";
$string['selectallthatapply'] = "Veuillez cocher toutes les réponses pertinentes :";
$string['somethingisbroken'] = "Quelque chose ne fonctionne pas";
$string['providemoredetail'] = "Fournir plus de détails (facultatif)&nbsp;:";
$string['spellinggrammarmistakes'] = "Il y a des erreurs d’orthographe ou de grammaire";
$string['informationwrong'] = "L'information est erronée";
$string['informationoutdated'] = "L'information n’est plus à jour";
$string['notwhatlookingfor'] = "Je ne trouve pas ce que je cherche";
$string['describewhatlookingfor'] = "Décrivez ce que vous recherchez (facultatif)&nbsp;:";
$string['other'] = "Autre";
$string['submit'] = "Soumettre";
$string['thankyou'] = "Merci pour votre aide!";
$string['enquiries'] = 'Vous ne recevrez pas de réponses. Pour des questions, veuillez <a href="https://www.canada.ca/en/contact.html">nous contactez</a>.';

$string['symbol'] = 'Symbole du gouvernement du Canada';

$string['footnoteheading'] = 'À propos de cette application Web';

$string['symbol'] = 'Symbole du Governement du Canada';

//
// Configuration Settings.
//

$string['abouttheme'] = 'A propos du theme';

$string['showsignon'] = 'Show <em>Sign in</em> button';
$string['showsignon_desc'] = 'Show or hide the Sign In button in the header.';

$string['showregister'] = 'Show <em>Register</em> button';
$string['showregister_desc'] = 'Show or hide the Register button in the header. Note that hidding the Register button will not prevent users from creating new accounts. It just hides the button. If you want to disable new account creation completely, be sure to disable <strong>Email-based self-registration</strong> AND enable <strong>Prevent account creation when authenticating</strong>.';

$string['registerurl'] = 'Alternate register URL';
$string['registerurl_desc'] = 'Alternative registration URL. Useful if you want users to register using an external authentication service such as Oauth2/SAML.';

$string['showaccountsettings'] = 'Show <em>Account Settings</em> button';
$string['showaccountsettings_desc'] = 'Show or hide the Account Settings button in the header.';

$string['showsearch'] = 'Show course search';
$string['showsearch_desc'] = 'Show or hide the course search field in the header.';

$string['showhomebreadcrumbs'] = 'Breadcrumbs on Front Page';
$string['showhomebreadcrumbs_desc'] = 'Enable breadcrumbs on the Front Page.';

$string['hometitle'] = 'Custom heading on Front Page';
$string['hometitle_desc'] = 'Specify a custom heading for the Front Page. Does not affect the page title tag.';

$string['showhometitle'] = 'Show title on Front page';
$string['showhometitle_desc'] = 'Show the page title on the Front page. If unchecked, title will be hidden.';

$string['titlesitename'] = 'Add site name to title';
$string['titlesitename_desc'] = 'Add site name to title tag on each page.';

$string['prebreadcrumbs'] = 'Pre-breadcrumbs';
$string['prebreadcrumbs_desc'] = 'Add optional breadcrumbs before the site breadcrumbs. Useful if this is a sub-section of a website.<br>Example: &lt;li&gt;&lt;a href="https://example.com/"&gt;Example&lt;/a&gt;&lt;/li&gt;';

$string['shownavdrawer'] = 'Show nav drawer to students';
$string['shownavdrawer_desc'] = 'Show or hide the Moodle nav drawer button and drawer to students. Non-editing teachers roles and above will always see it.';

$string['navdraweropen'] = 'Nav Drawer Default';
$string['navdraweropen_desc'] = 'Nav Drawer should be open or close by default on each page when logged in. User preference overrides this.';

$string['hidefrontpagelinkstopages'] = 'Hide links to pages on Front Page';
$string['hidefrontpagelinkstopages_desc'] = 'If enabled, links to pages on the Front Page will be hidden.';

$string['courselistlayout'] = 'Course list layout';
$string['courselistlayout_desc'] = 'When viewing course on the Front Page, All Courses and in Categories, you can choose from the following <a href="https://goo.gl/fMXzSo" target="_new">styles to display courses</a>.';
$string['courselistlayout0'] = '1-column, Default Moodle course list';
$string['courselistlayout1'] = '2-column, Horizontal Card: vertical image|title/summary';
$string['courselistlayout2'] = '2-column, Horizontal Card: image/title|summary';
$string['courselistlayout3'] = '2-column, Horizontal Card: title overlay image';
$string['courselistlayout4'] = '3-column, Horizontal Card: title overlay image w/buttons';
$string['courselistlayout5'] = '3-column, Vertical Card: image/title/summary';
$string['courselistlayout6'] = '3-column, Horizontal Card: top title overlay image';
$string['courselistlayout7'] = '3-column, Horizontal, Small image, icon with Title';
$string['courselistlayout8'] = '1-column, Enhanced Moodle course list';
$string['courselistlayout9'] = '3-column, Masonry';
$string['courselistlayout10'] = '1-column, Columns Moodle course list';
$string['courselistlayout11'] = 'Corporate Training - minimal with completion progressbar';
$string['courselistlayout12'] = 'Table list';
$string['courselistlayout13'] = 'Alt Card 1 (unfinished)';
$string['courselistlayout14'] = 'Alt Card 2 (unfinished)';
$string['courselistlayout15'] = 'Alt Card 3 (unfinished)';

$string['filtercoursesbylang'] = 'Filtrer les cours par langue imposée';
$string['filtercoursesbylang_desc'] = 'Les cours dont la langue est imposée, si définie, ne correspondent pas à la langue actuelle seront supprimés des listes de cours et des résultats de recherche.';

$string['wraprecentlyaccessedcourses'] = 'Wrap Recently Accessed Courses list';
$string['wraprecentlyaccessedcourses_desc'] = 'On the Dashboard.';

$string['showproblem'] = 'Show Report a problem on this page button';
$string['showproblem_desc'] = 'Show or hide the Report a problem on this page button.';

$string['problembuttonurl'] = 'Report a problem URL';
$string['problembuttonurl_desc'] = 'URL for the Report a problem button link. If Report a problem button is enable and there is no link, the default embedded form will be used.<br>Example: https://example.com/problem/ .';

$string['showshare'] = 'Show share button';
$string['showshare_desc'] = 'Show share button on pages when you users are not logged in.';

$string['confirmlogout'] = 'Confirm logout';
$string['confirmlogout_desc'] = 'Enable if you want users to be prompted when they attempt to logout.';
$string['alternatelogouturl'] = 'Alternate Logout URL';
$string['alternatelogouturl_desc'] = 'Alternate Logout URL will only be used for users logged-in using non-Manual or email-based self-registration accounts.<br>Example: https://www.example.com/logout';

$string['getstarted'] = 'Get started!';

$string['showprofile_heading'] = 'Select the sections and fields to be displayed when user\'s edit their profile.';
$string['showprofilesection_desc'] = 'Show the whole section.';

$string['header'] = 'Header';
$string['footer'] = 'Footer';

$string['footershowmoodledocs'] = 'Moodle Docs link';
$string['footershowmoodledocs_desc'] = 'Show the Moodle Docs link in the footer. Does not apply to students.';

$string['footershowhomelink'] = 'Home link';
$string['footershowhomelink_desc'] = 'Show the Home link in the footer .';

$string['footershowlogininfo'] = 'Login info link';
$string['footershowlogininfo_desc'] = 'Show the Login/Logout link in the footer .';

$string['footershowresetusertours'] = 'Reset user tours link';
$string['footershowresetusertours_desc'] = 'Show link to reset the user tours.';

$string['footnote'] = 'Footnote';
$string['footnote_desc'] = 'Displayed at the bottom of every page. Example: copyright, privacy policy, terms of use, phone number. Example: &lt;li&gt;&lt;a href="https://example.com/page?id="4"&gt;Terms and Conditions&lt;/a&gt;&lt;/li&gt;&lt;li&gt;Copyright 2001.&lt;/li&gt;.';

$string['hidelocallogin'] = 'Hide local login';
$string['hidelocallogin_desc'] = 'Hide the local login on login page. NOTE: Only enable this if all users are using an external authentication service such as Oauth2 or SAML or you have an alternate method of logging in.';

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