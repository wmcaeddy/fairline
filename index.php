<?php
// Galaxy Macau Theme index.php
?>
<!DOCTYPE html><html lang="zh-CHT"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><title>登錄 | 澳門銀河，世界級的亞洲度假勝地</title>
<link rel="icon" type="image/png" href="assets/theme/images/fav.0f84f8d50c11d05a0665.png">
<link rel="stylesheet" href="assets/theme/css/style.2a9e0de6901cd2b8a4a6.css">
<link rel="stylesheet" href="assets/theme/css/style.d597768381caa428f660.css">
<style>
    /* Custom overrides for FIDO integration */
    .hidden { display: none !important; }
    .fade-out { opacity: 0; transition: opacity 0.3s ease; pointer-events: none; }
    .fade-in { opacity: 1; transition: opacity 0.3s ease; }
    .loading-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255,255,255,0.8); z-index: 9999;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .spinner {
        border: 4px solid rgba(153, 117, 66, 0.1);
        width: 36px; height: 36px;
        border-radius: 50%;
        border-left-color: #a37c3c;
        animation: spin 1s linear infinite;
        margin-bottom: 16px;
    }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    
    /* Notification style override */
    #status-container {
        position: fixed; bottom: 20px; right: 20px; z-index: 10000;
        padding: 15px 25px; border-radius: 4px; color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .status-error { background-color: #f44336; }
    .status-success { background-color: #4caf50; }
    .status-info { background-color: #2196f3; }

    /* Profile view styles */
    .user-section-card { text-align: center; padding: 40px 20px; }
    .avatar-circle {
        width: 100px; height: 100px; background-color: #a37c3c; color: white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 2.5rem; font-weight: bold; margin: 0 auto 24px;
    }
    .user-info h2 { font-size: 1.5rem; margin-bottom: 8px; color: #343434; }
    .user-info p { font-size: 1rem; color: #666; margin-bottom: 32px; }
</style>
</head>
<body>
    <div id="app">
        <!-- Loading Overlay -->
        <div id="loading-overlay" class="loading-overlay hidden">
            <div class="spinner"></div>
            <p id="loading-text" style="color: #a37c3c; font-weight: 500;">請稍候...</p>
        </div>

        <div class="layout">
            <header id="header" class="eNQVmN">
                <div class="header-first">
                    <div class="header-first-left">
                        <span class="ml-2">銀河娛樂集團旗下成員</span>
                        <a href="#" class="header-first-left__link">星際酒店</a>
                        <a href="#" class="header-first-left__link">澳門百老匯</a>
                    </div>
                    <div class="header-first-right">
                        <ul class="header-first-right__list">
                            <li class="header-first-right__item"><i class="fas fa-map-marker-alt mr-2"></i>交通指南</li>
                            <li class="header-first-right__item header-first-right__item_user">
                                <i class="fas fa-user-circle mr-2"></i>
                                <a href="javascript:void(0)" id="header-login-link">登錄</a>&nbsp;|&nbsp;<a href="javascript:void(0)" id="header-join-link">加入</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="HeaderLogo__Container-sc-torv75-0 fIWwZa">
                    <div class="logoContainer">
                        <a href="/" class="bigLogo"><img src="assets/theme/images/gm_revwhite_tc_1_251125.png" alt="Galaxy Macau" class="cpRCiS"></a>
                    </div>
                </div>
            </header>

            <div id="page" class="eTPeDE">
                <div id="page-content">
                    <div class="kEcRTH fWXxdP formLogin-container">
                        
                        <!-- Login/Register Flow -->
                        <div id="auth-flow-container" class="formLogin-left">
                            <div class="formLogin-left-container">
                                <h3 class="dwanBp iGKSzW">
                                    <div class="fSxUpu"></div>
                                    <span id="auth-title" class="gHHdZC">登入</span>
                                </h3>
                                <p class="formLogin-left-description">
                                    <img class="formLogin-left-icon" alt="" src="assets/theme/images/icon-enjoy.09264fc967c127554341.svg">
                                    <span id="auth-desc">登入使用您的通行密鑰 (Passkey)</span>
                                </p>
                                
                                <div class="login-container">
                                    <form id="auth-form" class="TabLoginByEmail-form" onsubmit="return false;">
                                        <div class="Textfield-root">
                                            <label class="Textfield-field">
                                                <div class="Textfield-icon"><i class="fas fa-user"></i></div>
                                                <div class="Textfield-inputWrapper">
                                                    <input type="text" id="userName" name="userName" placeholder="用戶名稱" class="Textfield-input" required pattern="[0-9a-zA-Z]{2,}">
                                                </div>
                                            </label>
                                        </div>
                                        
                                        <div id="displayName-group" class="Textfield-root hidden">
                                            <label class="Textfield-field">
                                                <div class="Textfield-icon"><i class="fas fa-id-card"></i></div>
                                                <div class="Textfield-inputWrapper">
                                                    <input type="text" id="userDisplayName" name="userDisplayName" placeholder="顯示名稱" class="Textfield-input">
                                                </div>
                                            </label>
                                        </div>

                                        <div class="flex justify-center mt-4">
                                            <button id="auth-submit-btn" class="border border-yellow-750 text-yellow-750 text-xl px-4 py-3 cursor-pointer hover:text-white hover:bg-yellow-750 transition-colors min-w-[200px]">
                                                登入
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="formLogin-form">
                                    <h3 class="dwanBp iGKSzW small-h3">
                                        <div class="fSxUpu small-h3-line"></div>
                                        <span id="toggle-prompt" class="gHHdZC">還未加入?</span>
                                    </h3>
                                    <p id="toggle-desc" class="formLogin-right-info">註冊帳號，體驗 FIDO2 安全登錄</p>
                                    <div class="formLogin-form-create">
                                        <button id="auth-toggle-btn" class="border border-yellow-750 text-yellow-750 text-xl px-4 py-3 hover:text-white hover:bg-yellow-750 transition-colors min-w-[200px]" type="button">
                                            創建帳號
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Authenticated Section -->
                        <div id="user-authenticated-section" class="formLogin-left hidden">
                            <div class="formLogin-left-container">
                                <h3 class="dwanBp iGKSzW">
                                    <div class="fSxUpu"></div>
                                    <span class="gHHdZC">歡迎回來</span>
                                </h3>
                                <div class="user-section-card">
                                    <div id="auth-avatar" class="avatar-circle">U</div>
                                    <div class="user-info">
                                        <h2 id="auth-user-name">User Name</h2>
                                        <p id="auth-user-id">@userid</p>
                                    </div>
                                    <div class="flex justify-center">
                                        <button type="button" class="border border-yellow-750 text-yellow-750 text-xl px-4 py-3 hover:text-white hover:bg-yellow-750 transition-colors min-w-[200px]" onclick="logout()">
                                            登出
                                        </button>
                                    </div>
                                    <p id="auth-login-time" style="font-size: 0.75rem; color: #999; margin-top: 24px;">登錄時間: --</p>
                                </div>
                            </div>
                        </div>

                        <div class="column-line"></div>

                        <!-- Right Side Info -->
                        <div class="formLogin-right">
                            <div class="formLogin-right-container">
                                <h2 class="bBFmiX"><p>WebAuthn 演示</p></h2>
                                <div class="ckeditor__CKEditorText-sc-1hdgwz8-0 fpExem text__value">
                                    <p>此頁面演示了如何集成 FIDO2/WebAuthn 以實現無密碼登錄。您可以使用生物識別技術（如 TouchID/FaceID）或外部安全密鑰。</p>
                                    <br>
                                    <p><strong>技術特點：</strong></p>
                                    <ul style="list-style: disc; padding-left: 20px; margin-top: 10px;">
                                        <li>無密碼認證</li>
                                        <li>抗釣魚攻擊</li>
                                        <li>現代瀏覽器原生支持</li>
                                    </ul>
                                    <br>
                                    <div class="flex justify-center">
                                        <button type="button" class="text-yellow-750 hover:underline" onclick="toggleDebug()">
                                            調試工具
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Debug Tools (Hidden by default) -->
                    <div id="debug-container" class="kEcRTH hidden" style="margin-top: 40px; padding: 20px; border-top: 1px solid #ddd;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                            <h3 style="font-size: 1.2rem; margin: 0;">服務器數據預覽</h3>
                            <button type="button" class="text-red-450 hover:underline" onclick="clearRegistration()">
                                清除所有數據
                            </button>
                        </div>
                        <iframe src="_test/server.php?fn=getStoredDataHtml" id="serverPreview" style="width: 100%; height: 400px; border: 1px solid #ddd; border-radius: 4px;"></iframe>
                    </div>
                </div>
            </div>

            <footer class="byCIhE gkMYuH">
                <footer class="footer-link">
                    <a href="#" class="footer-bottomLink">網站地圖</a>
                    <a href="#" class="footer-bottomLink">隱私政策</a>
                    <a href="#" class="footer-bottomLink">使用條款</a>
                </footer>
                <footer class="footer-copyright">©新銀河娛樂2006有限公司。保留所有權利。</footer>
            </footer>
        </div>

        <!-- Status Notification -->
        <div id="status-container" class="hidden">
            <p id="status-message" style="margin: 0;"></p>
        </div>
    </div>

    <!-- WebAuthn Logic -->
    <script src="assets/theme/js/webauthn.js"></script>
</body></html>
