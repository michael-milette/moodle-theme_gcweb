<!DOCTYPE html><!--[if lt IE 9]>
<html class="no-js lt-ie9" <?php echo $_PAGE['htmlattributes']; ?>>
<![endif]--><!--[if gt IE 8]><!-->
<html class="no-js" <?php echo $_PAGE['htmlattributes']; ?>>
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!-- Web Experience Toolkit (WET) / wet-boew.github.io/wet-boew/License-en.html -->
    <!-- Boîte à outils de l'expérience Web (BOEW) / wet-boew.github.io/wet-boew/Licence-fr.html -->
    <title><?php echo $_PAGE['title'] . ' - ' . $_SITE['shortname']; ?></title>
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta name="description" content="<?php echo $_PAGE['description']; ?>">
    <!--[if gte IE 9 | !IE ]><!-->
    <link href="<?php echo $_SITE['wet-boew']; ?>/GCWeb/assets/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $_SITE['wet-boew']; ?>/GCWeb/css/theme.min.css">
    <!--<![endif]-->
    <!--[if lt IE 9]>
    <link href="<?php echo $_SITE['wet-boew']; ?>/GCWeb/assets/favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="<?php echo $_SITE['wet-boew']; ?>/GCWeb/css/ie8-theme.min.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $_SITE['wet-boew']; ?>/wet-boew/js/ie8-wet-boew.min.js"></script>
    <![endif]-->
    <!--[if lte IE 9]>
    <![endif]-->
    <noscript>
        <link rel="stylesheet" href="<?php echo $_SITE['wet-boew']; ?>/wet-boew/css/noscript.min.css" />
    </noscript>
    <!-- Google Tag Manager DO NOT REMOVE OR MODIFY - NE PAS SUPPRIMER OU MODIFIER -->
    <script>dataLayer1 = [];</script>
    <!-- End Google Tag Manager -->
    <?php echo $_PAGE['extrahead']; ?>
</head>
<body vocab="http://schema.org/" typeof="WebPage" <?php echo $_PAGE['bodyattributes']; ?>>
    <!-- Google Tag Manager DO NOT REMOVE OR MODIFY - NE PAS SUPPRIMER OU MODIFIER -->
    <noscript><iframe title="Google Tag Manager" src="//www.googletagmanager.com/ns.html?id=GTM-TLGQ9K" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer1'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer1','GTM-TLGQ9K');</script>
    <!-- End Google Tag Manager -->
    <ul id="wb-tphp">
        <li class="wb-slc"><a class="wb-sl" href="#wb-cont"><?php echo $_STRINGS['skiptomain']; ?></a></li>
        <li class="wb-slc"><a class="wb-sl" href="#wb-info"><?php echo $_STRINGS['skiptoabout']; ?></a></li>
        <?php if(!empty($_PAGE['showsectmenu'])) { ?>
            <li class="wb-slc"><a class="wb-sl" href="#wb-info"><?php echo $_STRINGS['skiptosectnav']; ?></a></li>
        <?php } ?>
    </ul>
    <header role="banner">
        <div id="wb-bnr" class="container">
            <?php if($_PAGE['langmenu']) { ?>
            <section id="wb-lng" class="visible-md visible-lg text-right">
                <h2 class="wb-inv"><?php echo $_STRINGS['languageselection']; ?></h2>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-inline margin-bottom-none">
                            <li><a lang="fr" href="content-fr.html"><?php echo $_STRINGS['french']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </section>
            <?php } ?>
            <div class="row">
                <div class="brand col-xs-8 col-sm-9 col-md-6">
                    <a href="https://www.canada.ca/en.html"><img src="<?php echo $_SITE['wet-boew']; ?>/GCWeb/assets/sig-blk-<?php echo $_SITE['lang']; ?>.svg" alt=""><span class="wb-inv"> <?php echo $_STRINGS['governmentofcanada']; ?></span></a>
                </div>
                <?php if($_PAGE['showmegamenu']) { ?>
                    <section class="wb-mb-links col-xs-4 col-sm-3 visible-sm visible-xs" id="wb-glb-mn">
                        <h2><?php echo $_STRINGS['searchandmenus']; ?></h2>
                        <ul class="list-inline text-right chvrn">
                            <li><a href="#mb-pnl" title="<?php echo $_STRINGS['searchandmenus']; ?>" aria-controls="mb-pnl" class="overlay-lnk" role="button"><span class="glyphicon glyphicon-search"><span class="glyphicon glyphicon-th-list"><span class="wb-inv"><?php echo $_STRINGS['searchandmenus']; ?></span></span></span></a></li>
                        </ul>
                        <div id="mb-pnl"></div>
                    </section>
                    <?php if($_PAGE['showsearch']) { ?>
                        <section id="wb-srch" class="col-xs-6 text-right visible-md visible-lg">
                            <h2><?php echo $_STRINGS['search']; ?></h2>
                            <form action="<?php echo $_SITE['searchurl']; ?>" method="post" name="cse-search-box" role="search" class="form-inline">
                                <div class="form-group">
                                    <label for="wb-srch-q" class="wb-inv"><?php echo $_STRINGS['searchwebsite']; ?></label>
                                    <input id="wb-srch-q" list="wb-srch-q-ac" class="wb-srch-q form-control" name="q" type="search" value="" size="27" maxlength="150" placeholder="<?php echo $_STRINGS['search']; ?> <?php echo $_SITE['shortname']; ?>">
                                    <?php echo $_SITE['searchsettings']; ?>
                                    <datalist id="wb-srch-q-ac">
                                        <!--[if lte IE 9]>
                                        <select>
                                            <![endif]-->
                                            <!--[if lte IE 9]>
                                        </select>
                                        <![endif]-->
                                    </datalist>
                                </div>
                                <div class="form-group submit">
                                    <button type="submit" id="wb-srch-sub" class="btn btn-primary btn-small" name="wb-srch-sub"><span class="glyphicon-search glyphicon"></span><span class="wb-inv"><?php echo $_STRINGS['search']; ?></span></button>
                                </div>
                            </form>
                        </section>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <nav role="navigation" id="wb-sm" data-ajax-replace="<?php echo $_SITE['wet-boew']; ?>/ajax/sitemenu-<?php echo $_SITE['lang']; ?>.html" data-trgt="mb-pnl" class="wb-menu visible-md visible-lg" typeof="SiteNavigationElement">
            <div class="container nvbar">
                <h2><?php echo $_STRINGS['topicsmenu']; ?></h2>
                <div class="row">
                    <ul class="list-inline menu">
                        <?php echo $_STRINGS['topicsmenulist']; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <nav role="navigation" id="wb-bc" property="breadcrumb">
            <h2><?php echo $_STRINGS['youarehere']; ?></h2>
            <div class="container">
                <div class="row">
                    <ol class="breadcrumb">
                        <?php echo $_PAGE['breadcrumbs']; ?>
                    </ol>
                </div>
            </div>
        </nav>        
        <?php if(!empty($_PAGE['signon'])) { ?>
        <section id="wb-so">
            <h2 class="wb-inv"><?php echo $_STRINGS['signoninfo']; ?></h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($_PAGE['signon'] == -1) { ?>
                            <?php if(!empty($_PAGE['register'])) { ?>
                                <a class="btn btn-default" href="<?php echo $_PAGE['register']; ?>"><?php echo $_STRINGS['register']; ?></a>
                            <?php } ?>
                            <a class="btn btn-primary" href="<?php echo $_PAGE['signonurl']; ?>"><?php echo $_STRINGS['signon']; ?></a>
                        <?php } else { ?>
                            <?php echo $_PAGE['usermenu']; ?>
                            <?php if(!empty($_SITE['accountsettingsurl'])) { ?>
                                <a class="btn btn-default" href="<?php echo $_SITE['accountsettingsurl']; ?>"><?php echo $_STRINGS['accountsettings']; ?></a>
                            <?php } ?>
                            <a class="btn btn-primary" href="<?php echo $_PAGE['signouturl']; ?>"><?php echo $_STRINGS['signout']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
    </header>
    <?php echo $_PAGE['extraheader']; ?>
    <main role="main" property="mainContentOfPage" class="container">
