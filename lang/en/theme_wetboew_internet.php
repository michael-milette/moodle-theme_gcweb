<?php
// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// A description shown in the admin theme selector.
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
 <h2><abbr title="Web Experience Toolkit for Moodle">WET-BOEW-MOODLE-Internet</abbr> theme</h2>
 <p><img class="img-polaroid" src="wetboew_internet/pix/screenshot.png" /></p>
</div>
<div class="well">
 <h2>Credits</h2>
 <h3>About</h3>
 <p>WET-BOEW-MOODLE-Internet is a responsive Moodle theme based on the latest GCWeb <a href="http://www.tbs-sct.gc.ca/ws-nw/index-eng.asp">Web Standards for the Government of Canada</a> and the Moodle core Boost theme.</p>
 <p>This theme is licensed under the GPL (GNU General Public License). You can find a complete licence copy in: <a href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a></p>
 <p>Authors: Michael Milette<br>
 Contact: <a href="mailto:info@tngconsulting.ca">info@tngconsulting.ca</a><br>
 Website: <a href="http://www.tngconsulting.ca">www.tngconsulting.ca</a></p>
 <h3>Bugs Report</h3>
 <p>You can report bugs using the GitHub Issue Tracker at <a href="https://github.com/wet-boew/wet-boew-moodle/issues">https://github.com/wet-boew/wet-boew-moodle/issues</a>.</p>
 <h3>Documentation</h3>
 <p>Documentation is available in <a href="https://github.com/wet-boew/wet-boew-moodle/">the project README file</a> and in <a href="https://github.com/wet-boew/wet-boew-moodle/wiki">the project Wiki</a></p>
 <h3>Demo</h3>
 <p>A demo instance is planned in the future.</p>
 <h3>Terms and conditions of use</h3>
 <p>Unless otherwise noted, the overall WET-BOEW-MOODLE project, wiki content, documentation and source code is Copyright © 2016 onwards by TNG Consulting Inc. Inc. with parts which may be contributed/copyrighted by others. WET-BOEW-MOODLE is provided freely as open source software, can be redistributed and/or modified it under the terms of the GNU General Public License version 3.0 or later.</p>
 <p>It is distributed in the hope that it will be useful. However, there is no warranty, implied or otherwise, of merchantability or fitness for any purpose. See the GNU General Public License for details.</p>
 <p>If for any reason a copy of the GNU General Public License was not included with this project, you can view it online by going to: https://www.gnu.org/licenses/gpl-3.0.en.html</p>
</div>
</div>';

// The name of our plugin.
$string['pluginname'] = 'WET-BOEW-Moodle Internet';
$string['privacy:metadata'] = 'The WET-BOEW-Moodle Internet theme does not store any personal data about any user.';
$string['configtitle'] = 'WET-BOEW-Internet';

// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Left';
$string['region-side-post'] = 'Right';
$string['region-content-pre'] = 'Top';
$string['region-content-post'] = 'Bottom';

/* Theme specific strings. */
$string['skiptomain'] = 'Skip to main content';
$string['skiptoabout'] = 'Skip to "About"';
$string['skiptosectnav'] = 'Skip to section menu';

$string['languageselection'] = 'Language selection';

$string['governmentofcanada'] = 'Government of Canada / <span lang="fr">Gouvernement du Canada</span>';

$string['searchandmenus'] = 'Menu and search';
$string['searchwebsite'] = 'Search website';
$string['searchplaceholder'] = 'Search courses';
$string['search'] = 'Search';

$string['mainmenu'] = 'Main navigation menu';
$string['topicsmenu'] = 'Topics menu';
$string['youarehere'] = 'You are here:';
$string['menu'] = 'Menu';
$string['esckey'] = 'escape key';
$string['close'] = 'Close';

$string['accountmenu'] = 'Account menu';
$string['register'] = 'Register';
$string['signoninfo'] = 'Sign-on information';
$string['signedinas'] = 'Signed in as';
$string['accountsettings'] = 'Account settings';
$string['signon'] = 'Sign in';
$string['signout'] = 'Sign out';

$string['topofpage'] = 'Top of Page';
$string['datemodified'] = 'Date modified:';

/* Problem Button */
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

$string['footerheading'] = 'About this Web application';
$string['footerlist'] = '<li><a href="https://www.canada.ca/en/contact.html">Contact information</a></li>
<li><a href="https://www.canada.ca/en/transparency/terms.html">Terms and conditions</a></li>
<li><a href="https://www.canada.ca/en/transparency/privacy.html">Privacy</a></li>';

$string['symbol'] = 'Symbol of the Government of Canada';

//
// Configuration Settings
//

$string['abouttheme'] = 'About this theme';

$string['showsignon'] = 'Show sign-on button';
$string['showsignon_desc'] = 'Show or hide the sign-on button in the header.';

$string['showregister'] = 'Show register button';
$string['showregister_desc'] = 'Show or hide the register button in the header.';

$string['showaccountsettings'] = 'Show account settings button';
$string['showaccountsettings_desc'] = 'Show or hide the account settings button in the header.';

$string['showsearch'] = 'Show course search';
$string['showsearch_desc'] = 'Show or hide the course search field in the header.';

$string['showhomebreadcrumbs'] = 'Breadcrumbs on Home page';
$string['showhomebreadcrumbs_desc'] = 'Enable breadcrumbs on the home page.';

$string['prebreadcrumbs'] = 'Pre-breadcrumbs';
$string['prebreadcrumbs_desc'] = 'Add optional breadcrumbs before the site breadcrumbs. Useful if this is a sub-section of a website.<br>Example: &lt;li&gt;&lt;a href="https://example.com/"&gt;Example&lt;/a&gt;&lt;/li&gt;';

$string['shownavdrawer'] = 'Show nav drawer to students';
$string['shownavdrawer_desc'] = 'Show or hide the Moodle nav drawer button and drawer to students. Non-editing teachers roles and above will always see it.';

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

$string['showprofile_heading'] = 'Select the sections and fields to be displayed when user\'s edit their profile.';
$string['showprofilesection_desc'] = 'Show the whole section.';