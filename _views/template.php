<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Affinity Health - Online Application</title>

<link rel="stylesheet" href="_load/css/styles.css">
<link rel="stylesheet" href="_load/css/font-awesome.min.css">
<link rel="stylesheet" href="_load/fonts/fonts.css">
<link rel="stylesheet" href="_load/css/jquery-ui.css" />
<script src="_load/js/jquery-3.2.1.min.js"></script>
<script src="_load/js/functions.js"></script>
<script src="_load/js/jquery-ui.js"></script>
</head>

<body>

<?php 
/*
echo "<pre>";
print_r($_SESSION); 
echo "</pre>";
*/

?>

    <div id="main">
        <!-- NOTE: this should really be included in a seperate file -->
        <div id="header">
            <div class="logo-orb"></div>
            <div class="logo"><img src="_load/images/logo.png" width="100%" height="auto" alt=""/></div>
            <div class="home-btn">
            <button type="button" id="back-home"><a href="https://www.affinityhealth.co.za" style="color: #FFFFFF; text-decoration:none;">BACK TO WEBSITE</a></button>
         </div>
        </div>

        <div id="steps">
            <div class="step-block step-1">
                <p class="val">1</p>
                <p class="des">Personal Details</p>
            </div>
            <div class="step-block step-2">
                <p class="val">2</p>
                <p class="des">Plan Selection</p>
            </div>
            <div class="step-block step-3">
                <p class="val">3</p>
                <p class="des">Payment Setup</p>
            </div>
            <div class="clear"></div>
        </div>

        <?php require_once($app->load_page()); ?>
    </div>

    <!-- overlay and tooltip -->
    <div class="overlay"></div>
    <div id="idtooltip">
        <p>We require your ID number in order for us to identify if you have dealt with us before. Your ID number is safe and will not be distributed or used for any other reasons.</p>
    </div>

<script src="_load/js/cd.validator.js"></script>
<script src="_load/js/cd.handler.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-80338702-35"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-80338702-35');
</script>

</body>
</html>