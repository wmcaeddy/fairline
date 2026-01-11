<?php
// index.php - Fairline Layout with WebAuthn Integration
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>中飛科技股份有限公司 ::: 專業的團隊,精緻的服務</title>

<link href="assets/theme/favicon.ico" rel="icon">
<link href="assets/theme/bootstrap-5.3.3.min.css" rel="stylesheet">
<link href="assets/theme/font-awesome.min.css" rel="stylesheet">
<link href="assets/theme/animate.min.css" rel="stylesheet">
<link href="assets/theme/custom.css" rel="stylesheet">
<link href="assets/theme/plugin-slick.min.css" rel="stylesheet">
<link href="assets/theme/plugin-fix.css" rel="stylesheet">
<link href="assets/theme/plugin-magnific-popup.css" rel="stylesheet">

<script src="assets/theme/js/webauthn.js" defer></script>
<!-- Animations JS -->
<script src="assets/js/animations.js" defer></script>

<style>
    /* Ensure the auth section matches the theme's aesthetic */
    .fido-auth-section {
        padding: 100px 0;
        background: #fff;
    }
    .hidden { display: none !important; }
</style>

</head>
<body class="pace-done">
<?php include 'components/header.php'; ?>

<div class="g-wrap" id="index">
    <?php include 'components/hero.php'; ?>
    
    <div class="main">
        <section class="sec sec1 fido-auth-section" id="auth-section">
            <div class="container-1400">
                <div class="g-title showrole" data-scroll-view="init">
                    <div class="t1">AUTHENTICATION</div>
                    <h2 class="t2">身份驗證</h2>
                </div>
                
                <div id="fido-ui-container">
                    <!-- FIDO UI will be ported here in Phase 3 -->
                    <p style="text-align: center; color: #666;">WebAuthn 功能整合中...</p>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include 'components/footer.php'; ?>
</body>
</html>
