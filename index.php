<?php
// index.php - Legacy Table Layout with FIDO Integration
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Language" content="zh-tw">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>正新電腦有限公司 ::: WebAuthn 驗證服務</title>

<!-- Modern Assets -->
<link href="assets/theme/favicon.ico" rel="icon">
<link href="assets/theme/bootstrap-5.3.3.min.css" rel="stylesheet">
<link href="assets/theme/animate.min.css" rel="stylesheet">
<link href="assets/theme/custom.css" rel="stylesheet">
<script src="assets/theme/js/webauthn.js" defer></script>

<!-- Legacy Styles -->
<link href="20260111141054139/pronew.css" rel="stylesheet" type="text/css">
<link href="20260111141054139/showcut.css" rel="stylesheet" type="text/css">

<style>
    /* Overlay for FIDO Card to allow it to be 'portable' */
    .fido-overlay {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        display: none; /* Hidden by default */
    }
    .fido-overlay.active {
        display: block;
    }
    .fido-dimmer {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 9998;
        display: none;
    }
    .fido-dimmer.active {
        display: block;
    }
    
    /* Scoped styling for the auth card inside legacy layout */
    .auth-card {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        max-width: 400px;
        width: 100%;
    }
    
    /* Adjust legacy select */
    .TitleB { font-size: 11px; color: #841852; font-weight:bold; }
    
    /* Ensure the auth side is accessible */
    .portable-auth-trigger {
        cursor: pointer;
    }
</style>

<script>
    function toggleAuth() {
        document.getElementById('fido-dimmer').classList.toggle('active');
        document.getElementById('fido-overlay').classList.toggle('active');
    }
</script>

</head>
<body bgcolor="f2f2f2" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<div id="fido-dimmer" class="fido-dimmer" onclick="toggleAuth()"></div>
<div id="fido-overlay" class="fido-overlay">
    <div class="auth-card">
        <div id="loading-overlay" class="loading-overlay hidden">
            <div class="spinner"></div>
            <p id="loading-text">請稍候...</p>
        </div>

        <div id="login-flow-container">
            <div class="auth-header">
                <h3 style="color: var(--color-primary); font-weight: 700; margin-bottom: 10px;">Passkey 登入</h3>
                <p style="color: #777; font-size: 0.9rem; margin-bottom: 20px;">使用您的安全金鑰或生物辨識</p>
            </div>

            <div class="form-group">
                <label class="form-label">使用者名稱</label>
                <input type="text" id="userName" class="form-control-theme" oninput="updateUserId()" placeholder="例如: eddy">
            </div>

            <div class="form-group">
                <label class="form-label">顯示名稱</label>
                <input type="text" id="userDisplayName" class="form-control-theme" placeholder="例如: Eddy Chen">
            </div>

            <div class="btn-group-vertical">
                <button type="button" class="btn-theme btn-theme-primary" onclick="createRegistration()">
                    註冊新裝置
                </button>
                <button type="button" class="btn-theme btn-theme-secondary" onclick="checkRegistration()">
                    使用 Passkey 登入
                </button>
            </div>
            
            <div style="text-align: center; margin-top: 15px;">
                <button type="button" style="background:none; border:none; color:var(--color-primary); font-size:0.8rem; cursor:pointer; text-decoration: underline;" onclick="toggleAuth()">關閉</button>
            </div>
        </div>

        <!-- Authenticated State -->
        <div id="user-authenticated-section" class="hidden">
            <div class="user-section-card">
                <div id="auth-avatar" class="avatar-circle">U</div>
                <div class="user-info">
                    <h4 id="auth-user-name">User Name</h4>
                    <p id="auth-user-id">@userid</p>
                </div>
                <button type="button" class="btn-theme btn-theme-secondary" onclick="logout()">登出</button>
            </div>
        </div>
        
        <div id="status-container" class="status-message hidden">
            <p id="status-message" style="margin: 0;"></p>
        </div>
    </div>
</div>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"> 
      <div align="center">
        <table width="962" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="1" height="680" rowspan="2" valign="top" background="20260111141054139/line.gif"><img src="20260111141054139/line.gif" width="1" height="100"></td>
            <td width="1005" valign="top" bgcolor="#FFFFFF">
              
              <!-- Component: Header -->
              <?php include 'components/header.php'; ?>
              
              <!-- Component: Hero -->
              <?php include 'components/hero.php'; ?>

              <table width="940" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
                <tr>
                  <td width="639" valign="top">
                    <!-- Main Content from Modular Components -->
                    <div id="about">
                        <?php include 'components/about.php'; ?>
                    </div>
                    <div id="news" style="margin-top: 40px;">
                        <?php include 'components/news.php'; ?>
                    </div>
                  </td>
                  <td width="20" valign="top" background="20260111141054139/line_3.gif"><img src="20260111141054139/line_3.gif" width="24" height="100"></td>
                  <td width="280" valign="top">
                    <div id="brands">
                        <?php include 'components/brands.php'; ?>
                    </div>
                    
                    <!-- Trigger for FIDO Login -->
                    <div style="margin-top: 30px; text-align: center; padding: 20px; border: 1px dashed var(--color-primary); border-radius: 8px;">
                        <h4 style="color: var(--color-primary); margin-bottom: 10px;">Passkey 驗證服務</h4>
                        <button class="btn btn-primary btn-sm" onclick="toggleAuth()">立即登入/註冊</button>
                    </div>
                  </td>
                </tr>
              </table>

            </td>
            <td width="10" rowspan="2" valign="top" background="20260111141054139/line.gif"><img src="20260111141054139/line.gif" width="1" height="100"></td>
          </tr>
          <tr> 
            <td height="60" valign="top" bgcolor="#FFFFFF">
              <!-- Component: Footer -->
              <?php include 'components/footer.php'; ?>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>

</body>
</html>
