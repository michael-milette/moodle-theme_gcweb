<?php
// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// A description shown in the admin theme selector.
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
 <h2><abbr title="Web Experience Toolkit for Moodle">WET-BOEW-MOODLE</abbr> GCWeb theme</h2>
 <p><img class="img-polaroid" src="gcweb/pix/screenshot.png" /></p>
</div>
<div class="well">
 <h2>Credits</h2>
 <h3>About</h3>
 <p>WET-BOEW-MOODLE GCWeb is a responsive Moodle theme based on the latest GCWeb <a href="http://www.tbs-sct.gc.ca/ws-nw/index-eng.asp">Web Standards for the Government of Canada</a> and the Moodle core Boost theme.</p>
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
$string['pluginname'] = 'WET-BOEW-Moodle GCWeb';
$string['privacy:metadata'] = 'The WET-BOEW-Moodle GCWeb theme does not store any personal data about any user.';
$string['configtitle'] = 'WET-BOEW-GCWeb';

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

$string['footnoteheading'] = 'About this Web application';

$string['symbol'] = 'Symbol of the Government of Canada';

//
// Configuration Settings
//

$string['abouttheme'] = 'About this theme';

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
$string['courselistlayout_desc'] = 'Affects lists of all courses on Front Page and All Courses page.';

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