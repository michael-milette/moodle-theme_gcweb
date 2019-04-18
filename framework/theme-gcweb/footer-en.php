<?php echo $_PAGE['beforefooter']; ?>
        <div class="pagedetails">
            <dl id="wb-dtmd">
                <dt><?php echo $_STRINGS['datemodified']; ?>&#32;</dt>
                <dd><time property="dateModified"><?php echo $_PAGE['lastmodified']; ?></time></dd>
            </dl>
            <div class="row">
                <?php if($_SITE['showproblembutton']) include 'problembutton-' . $_SITE['lang'] . '.php'; ?>
                <?php if($_SITE['showsharebutton']) include 'sharebutton.php'; ?>
            </div>
        </div>
    </main>
    
    <footer role="contentinfo" id="wb-info">
        <nav role="navigation" class="container wb-navcurr">
            <h2 class="wb-inv">About government</h2>
            <ul class="list-unstyled colcount-sm-2 colcount-md-3">
                <li><a href="https://www.canada.ca/en/contact.html">Contact us</a></li>
                <li><a href="https://www.canada.ca/en/government/dept.html">Departments and agencies</a></li>
                <li><a href="https://www.canada.ca/en/government/publicservice.html">Public service and military</a></li>
                <li><a href="https://www.canada.ca/en/news.html">News</a></li>
                <li><a href="https://www.canada.ca/en/government/system/laws.html">Treaties, laws and regulations</a></li>
                <li><a href="https://www.canada.ca/en/transparency/reporting.html">Government-wide reporting</a></li>
                <li><a href="https://pm.gc.ca/eng">Prime Minister</a></li>
                <li><a href="https://www.canada.ca/en/government/system.html">How government works</a></li>
                <li><a href="https://open.canada.ca/en/">Open government</a></li>
            </ul>
        </nav>
        <div class="brand">
            <div class="container">
                <div class="row">
                    <nav class="col-md-9 col-lg-10 ftr-urlt-lnk">
                        <h2 class="wb-inv">About this site</h2>
                        <ul>
                            <li><a href="https://www.canada.ca/en/social.html">Social media</a></li>
                            <li><a href="https://www.canada.ca/en/mobile.html">Mobile applications</a></li>
                            <li><a href="https://www1.canada.ca/en/newsite.html">About Canada.ca</a></li>
                            <li><a href="https://www.canada.ca/en/transparency/terms.html">Terms and conditions</a></li>
                            <li><a href="https://www.canada.ca/en/transparency/privacy.html">Privacy</a></li>
                        </ul>
                    </nav>
                    <div class="col-xs-6 visible-sm visible-xs tofpg">
                        <a href="#wb-cont">Top of Page <span class="glyphicon glyphicon-chevron-up"></span></a>
                    </div>
                    <div class="col-xs-6 col-md-3 col-lg-2 text-right">
                        <img src="<?php echo $_SITE['wet-boew']; ?>/GCWeb/assets/wmms-blk.svg" alt="Symbol of the Government of Canada">
                    </div>
                </div>
            </div>
        </div>
        <?php echo $_PAGE['extrafooter']; ?>
    </footer>
    <!--[if gte IE 9 | !IE ]><!-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="<?php echo $_SITE['wet-boew']; ?>/wet-boew/js/wet-boew.min.js"></script>
    <!--<![endif]-->
    <!--[if lt IE 9]>
    <script src="<?php echo $_SITE['wet-boew']; ?>/wet-boew/js/ie8-wet-boew2.min.js"></script>
    <![endif]-->
    <script src="<?php echo $_SITE['wet-boew']; ?>/GCWeb/js/theme.min.js"></script>

<!-- Latest compiled and minified CSS -->
<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" -->
<!-- jQuery library -->
<!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script -->
<!-- Popper JS -->
<!-- script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <?php echo $_PAGE['beforeendofbody'] ?>
</body>
</html>