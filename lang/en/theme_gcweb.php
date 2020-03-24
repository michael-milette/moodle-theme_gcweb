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
 * WET-BOEW GCWeb English language.
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
$string['pluginname'] = 'WET-BOEW-Moodle GCWeb';
$string['privacy:metadata'] = 'The WET-BOEW-Moodle GCWeb theme does not store any personal data about any user.';
$string['configtitle'] = 'WET-BOEW-GCWeb';

// Description shown in the Theme Selector.
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
 <h2><abbr title="Web Experience Toolkit for Moodle">WET-BOEW-MOODLE</abbr> GCWeb theme</h2>
 <p><img class="img-polaroid" src="gcweb/pix/screenshot.png" alt=""></p>
</div>
<div class="well">
 <h2>Credits</h2>
 <h3>About</h3>
 <p>WET-BOEW-MOODLE GCWeb, version [version], is a responsive Moodle theme based on the GCWeb <a href="http://www.tbs-sct.gc.ca/ws-nw/index-eng.asp">Web Standards for the Government of Canada</a> and the Moodle core Boost theme.</p>
 <p>Authors: Michael Milette, <a href="https://www.tngconsulting.ca">www.tngconsulting.ca</a></p>
 <h3>Bugs Report</h3>
 <p>You can report bugs using the GitHub Issue Tracker at <a href="https://github.com/wet-boew/wet-boew-moodle/issues">https://github.com/wet-boew/wet-boew-moodle/issues</a>.</p>
 <h3>Documentation</h3>
 <p>Documentation is available in <a href="https://github.com/wet-boew/wet-boew-moodle/">the project README file</a> and in <a href="https://github.com/wet-boew/wet-boew-moodle/wiki">the project Wiki</a></p>
 <h3>Demo</h3>
 <p>A working example of this theme can be found at <a href="https://wet-boew-moodle.tngconsulting.ca">wet-boew-moodle.tngconsulting.ca</a>.</p>
 <h3>Terms and conditions of use</h3>
 <p>Unless otherwise noted, the overall WET-BOEW-MOODLE project, wiki content, documentation and source code is Copyright © 2016 onwards by TNG Consulting Inc. Inc.</p>
 <p>WET-BOEW-MOODLE is provided freely as open source software, can be redistributed and/or modified it under the terms of the GNU General Public License (GPL) version 3.0. It is distributed in the hope that it will be useful. However, there is no warranty, implied or otherwise, of merchantability or fitness for any purpose. See the GNU General Public License for details.</p>
 <p>Moodle is Copyright © 1999 onwards, Martin Dougiamas with portions contributed/copyrighted by many others and all of it is provided under the terms of the GNU GPL 3.0</p>
 <p>If for any reason a copy of the GNU General Public License was not included with this project, you can view it online by going to: <a href="https://www.gnu.org/licenses/gpl-3.0.en.html">www.gnu.org/licenses/gpl-3.0.en.html</a></p>
 <p>The Web Experience Toolkit (WET) is covered under Crown Copyright, Government of Canada, and is distributed under the MIT License: <a href="https://wet-boew.github.io/v4.0-ci/License-en.html">wet-boew.github.io/v4.0-ci/License-en.html</a></p>
 <p>The Canada wordmark and related graphics associated with this distribution are protected under trademark law and copyright law. No permission is granted to use them outside the parameters of the Government of Canada\'s corporate identity program. For more information, see <a href="https://www.tbs-sct.gc.ca/fip-pcim/index-eng.asp">www.tbs-sct.gc.ca/fip-pcim/index-eng.asp</a>.</p>
 <p>Copyright title to all 3rd party software distributed with this theme is held by the respective copyright holders as noted in those files. You are asked to read the 3rd Party Licenses referenced with those assets.</p>
 <p>The above copyright notices and attributions shall be included in all copies or portions of the software.</p>
</div>
</div>';

// Block regions available in this theme.
$string['region-side-pre'] = 'Left';   // Actually top right.
$string['region-side-post'] = 'Right'; // Actually bottom right.
$string['region-content-pre'] = 'Top';
$string['region-content-post'] = 'Bottom';

/********************************************
 * WET-BOEW-Moodle GCWeb Theme Settings.
 ********************************************/

//
// General Settings tab.
//
$string['hidelocallogin'] = 'Hide local login';
$string['hidelocallogin_desc'] = 'Hide the local login on login page. NOTE: Only enable this if all users are using an external authentication service such as Oauth2 or SAML or you have an alternate method of logging in.';

$string['confirmlogout'] = 'Confirm logout';
$string['confirmlogout_desc'] = 'Enable if you want users to be prompted when they attempt to logout.';

$string['showhometitle'] = 'Show title on Front page';
$string['showhometitle_desc'] = 'Show the page title on the Front page. If unchecked, title will be hidden.';

$string['showaccountsettings'] = 'Show <em>Account Settings</em> button';
$string['showaccountsettings_desc'] = 'Show or hide the Account Settings button in the header.';

$string['hometitle'] = 'Custom heading on Front Page';
$string['hometitle_desc'] = 'Specify a custom heading for the Front Page. Does not affect the page title tag.';

$string['hidefrontpagelinkstopages'] = 'Hide links to pages on Front Page';
$string['hidefrontpagelinkstopages_desc'] = 'If enabled, links to pages on the Front Page will be hidden.';

$string['titlesitename'] = 'Add site name to title';
$string['titlesitename_desc'] = 'Add site name to title tag on each page.';

$string['shownavdrawer'] = 'Show nav drawer to students';
$string['shownavdrawer_desc'] = 'Show or hide the Moodle nav drawer button and drawer to students. Non-editing teachers roles and above will always see it.';

$string['navdraweropen'] = 'Nav Drawer Default';
$string['navdraweropen_desc'] = 'Nav Drawer should be open or close by default on each page when logged in. User preference overrides this.';

$string['courselistsettings'] = 'Course lists';
$string['courselistsettings_desc'] = 'When viewing course listings on the Front Page, All Courses, Categories and search results, you can choose what information to include, the layout of how it is going to look, and filter courses based on language and tags.';

// Note: If you modify the list of layouts, you must change the language file, settings/general.php,
// wet-boew-moodle.css, wet-boew-moodle-min.css and classes/output/course_renderer.php.
$string['courselistlayout'] = 'Layout';
$string['courselistlayout_desc'] = 'Choose a styles to display courses</a>.';
$string['courselistlayout-3'] = 'Expandable list (name/details)';
$string['courselistlayout-2'] = 'Table list';
$string['courselistlayout-1'] = 'Cards - Masonry';
$string['courselistlayout0'] = 'Default Moodle course list (enhanced)';
$string['courselistlayout1'] = 'Cards';
$string['courselistlayout2'] = 'Cards - Overlay (bottom)';
$string['courselistlayout3'] = 'Cards - Overlay (top)';
$string['courselistlayout4'] = 'Cards - Minimal with arrow over image';
$string['courselistlayout5'] = 'Cards - Minimal with arrow to the left of course name';

$string['courselistcolumns'] = 'Columns';
$string['courselistcolumns_desc'] = 'Number of columns used to display course listings. Not applicable to Expandable list, Table list and Default Moodle course list layouts';

$string['cardheader'] = 'Card header';
$string['cardheader_desc'] = 'Add a course header. The information you select will appear in the header instead of in the body of the card but you must still enable the field.';
$string['cardheaderopt0'] = 'None';
$string['cardheaderopt1'] = 'Category';
$string['cardheaderopt2'] = 'Course name';

$string['cardfooter'] = 'Card footer';
$string['cardfooter_desc'] = 'Add a course footer. The information you select will appear in the footer instead of in the body of the card but you must still enable the field.';
$string['cardfooteropt0'] = 'None';
$string['cardfooteropt1'] = 'Enrolment button';
$string['cardfooteropt2'] = 'Custom course fields';
$string['cardfooteropt3'] = 'Contacts';
$string['cardfooteropt4'] = 'Progress bar';

$string['cardimage'] = 'Course image';
$string['cardimage_desc'] = 'Show course\'s image when displaying course listings. Not applicable to all layout formats.';

$string['cardscroll'] = 'Scroll';
$string['cardscroll_desc'] = 'Make card content scrollable if there its content is too long.';

$string['cardcategory'] = 'Category';
$string['cardcategory_desc'] = 'Show course\'s category. Not applicable to all layout formats.';

$string['cardsummary'] = 'Summary';
$string['cardsummary_desc'] = 'Show course\'s summary. Not applicable to all layout formats.';

$string['cardcustomfields'] = 'Custom fields';
$string['cardcustomfields_desc'] = 'Show course\'s custom fields. Not applicable to all layout formats and only appears if custom fields exist.';

$string['cardcontacts'] = 'Course contacts';
$string['cardcontacts_desc'] = 'Show course\'s contacts (e.g. teachers). Not applicable to all layout formats and only appears if teachers have been assigned to the course.';

$string['cardprogress'] = 'Progress';
$string['cardprogress_desc'] = 'Show the progress bar if completion tracking is enabled and user is enrolled in the course. Not applicable to all layout formats.';

$string['cardbutton'] = 'Button';
$string['cardbutton_desc'] = 'Show enter/more info button. Not applicable to all layout formats.';

$string['filtercoursesbytag'] = 'Filter courses by tag';
$string['filtercoursesbytag_desc'] = 'Filer course listings by this tag. Example, this can be used to only display <em>featured</em> courses. Only applicable to the <strong>front page</strong>';

$string['filtercoursesbylang'] = 'Filter courses by language';
$string['filtercoursesbylang_desc'] = 'Courses whose forced language, if set, does not match the current language will be filtered out from course listings and search results.';

//
// Advanced Settings tab (none yet. Uses strings from Boost theme).
//

//
// User Profile Fields tab (the rest are all built into Moodle).
//
$string['showprofile_heading'] = 'Select the sections and fields to be displayed when user\'s edit their profile.';
$string['showprofilesection_desc'] = 'Show the whole section.';

//
// Header tab.
//
$string['header'] = 'Header';

$string['showumprofilelink'] = 'Show Profile link';
$string['showumprofilelink_desc'] = 'Show or hide the Profile link in the User Menu';

$string['showumlogoutlink'] = 'Show Log Out link';
$string['showumlogoutlink_desc'] = 'Show or hide the Log Out link in the User Menu';

$string['showsignon'] = 'Show <em>Sign in</em> button';
$string['showsignon_desc'] = 'Show or hide the Sign In button in the header.';

$string['showregister'] = 'Show <em>Register</em> button';
$string['showregister_desc'] = 'Show or hide the Register button in the header. Note that hidding the Register button will not prevent users from creating new accounts. It just hides the button. If you want to disable new account creation completely, be sure to disable <strong>Email-based self-registration</strong> AND enable <strong>Prevent account creation when authenticating</strong>.';

$string['alternatelogouturl'] = 'Alternate Logout URL';
$string['alternatelogouturl_desc'] = 'Alternate Logout URL will only be used for users logged-in using non-Manual or email-based self-registration accounts.<br>Example: https://www.example.com/logout';

$string['showsearch'] = 'Show course search';
$string['showsearch_desc'] = 'Show or hide the course search field in the header.';

$string['wraprecentlyaccessedcourses'] = 'Wrap Recently Accessed Courses list';
$string['wraprecentlyaccessedcourses_desc'] = 'On the Dashboard.';

$string['showhomebreadcrumbs'] = 'Breadcrumbs on Front Page';
$string['showhomebreadcrumbs_desc'] = 'Enable breadcrumbs on the Front Page.';

$string['prebreadcrumbs'] = 'Pre-breadcrumbs';
$string['prebreadcrumbs_desc'] = 'Add optional breadcrumbs before the site breadcrumbs. Useful if this is a sub-section of a website.<br>Example: &lt;li&gt;&lt;a href="https://example.com/"&gt;Example&lt;/a&gt;&lt;/li&gt;';

//
// Footer tab.
//
$string['footer'] = 'Footer';

$string['showproblem'] = 'Show Report a problem on this page button';
$string['showproblem_desc'] = 'Show or hide the Report a problem on this page button.';

$string['problembuttonurl'] = 'Report a problem URL';
$string['problembuttonurl_desc'] = 'URL for the Report a problem button link. If Report a problem button is enable and there is no link, the default embedded form will be used.<br>Example: https://example.com/problem/ .';

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

//
// About This Theme tab.
//
$string['abouttheme'] = 'About this theme';

/**************************************
 * Visible to everyone.
 **************************************/
// Accessibility links
$string['skiptomain'] = 'Skip to main content';
$string['skiptoabout'] = 'Skip to "About"';
$string['skiptosectnav'] = 'Skip to section menu';

// Language toggle.
$string['languageselection'] = 'Language selection';

// ALT text for Government of Canada logo.
$string['governmentofcanada'] = 'Government of Canada / <span lang="fr">Gouvernement du Canada</span>';

// Search form.
$string['searchandmenus'] = 'Menu and search';
$string['searchwebsite'] = 'Search website';
$string['searchplaceholder'] = 'Search courses';
$string['search'] = 'Search';

// Custom menu.
$string['mainmenu'] = 'Main navigation menu';
$string['topicsmenu'] = 'Topics menu';
$string['youarehere'] = 'You are here:';
$string['menu'] = 'Menu';

// TODO: Identify.
$string['esckey'] = 'escape key';
$string['close'] = 'Close';

// User menu.
$string['accountmenu'] = 'Account menu';

// Account buttons.
$string['register'] = 'Register';
$string['signoninfo'] = 'Sign-on information';
$string['signedinas'] = 'Signed in as';
$string['accountsettings'] = 'Account settings';
$string['signon'] = 'Sign in';
$string['signout'] = 'Sign out';

// Report a problem on the page.
$string['reportaproblem'] = "Report a problem on this page";
$string['selectallthatapply'] = "Please select all that apply:";
$string['somethingisbroken'] = "Something is broken";
$string['providemoredetail'] = "Provide more details (optional):";
$string['spellinggrammarmistakes'] = "The page has spelling or grammar mistakes";
$string['informationwrong'] = "The information is wrong";
$string['informationoutdated'] = "The information is outdated";
$string['notwhatlookingfor'] = "I can’t find what I’m looking for";
$string['describewhatlookingfor'] = "Describe what you’re looking for (optional):";
$string['other'] = "Other";
$string['submit'] = "Submit";
$string['thankyou'] = "Thank you for your help!";
$string['enquiries'] = 'You will not receive a reply. For enquiries, please <a href="https://www.canada.ca/en/contact.html">contact us</a>.';

// Footer.
$string['topofpage'] = 'Top of Page';
$string['datemodified'] = 'Date modified:';
$string['symbol'] = 'Symbol of the Government of Canada';
$string['footnoteheading'] = 'About this Web application';

// Buttons for course listings.
$string['courseinfo'] = 'Learn more <span class="sr-only">about course:</span>';
$string['courseenter'] = 'Enter<span class="sr-only"> the course:</span>';

// 404 Error: Page not found.
$string['err404title'] = 'We couldn&#x27;t find that Web page (Error 404) / Nous ne pouvons trouver cette page Web (Erreur 404)';
$string['err404body'] = '
<header role="banner" id="wb-bnr" class="container">
    <div class="row">
        <div class="col-sm-6">
            <img id="gcwu-sig" src="{$a}/theme/gcweb/framework/GCWeb/assets/sig-blk-en.svg" alt="Government of Canada / Gouvernement du Canada">
        </div>
        <div class="col-sm-6">
            <img id="wmms" src="{$a}/theme/gcweb/framework/GCWeb/assets/wmms-blk.svg" alt="Symbol of the Government of Canada">
        </div>
    </div>
</header>
<main role="main" property="mainContentOfPage" typeof="WebPageElement" class="container">
    <div class="row mrgn-tp-lg">
        <h1 class="wb-inv">We couldn\'t find that Web page (Error 404) / <span lang="fr">Nous ne pouvons trouver cette page Web (Erreur 404)</span></h1>
        <section class="col-md-6">
            <h2><span class="glyphicon glyphicon-warning-sign mrgn-rght-md"></span> We couldn\'t find that Web page (Error 404)</h2>
            <p>We\'re sorry you ended up here. Sometimes a page gets moved or deleted, but hopefully we can help you find what you\'re looking for.</p>
            <ul>
                <li>Return to the <a href="{$a}/?redirect=0&lang=en">home page</a></li>
            </ul>
        </section>
        <section class="col-md-6" lang="fr">
            <h2><span class="glyphicon glyphicon-warning-sign mrgn-rght-md"></span> Nous ne pouvons trouver cette page Web (Erreur 404)</h2>
            <p>Nous sommes désolés que vous ayez abouti ici. Il arrive parfois qu\'une page ait été déplacée ou supprimée. Heureusement, nous pouvons vous aider à trouver ce que vous cherchez.</p>
            <ul>
                <li>Retournez à la <a href="{$a}/?redirect=0&lang=fr">page d\'accueil</a></li>
            </ul>
        </section>
    </div>
</main>
';
