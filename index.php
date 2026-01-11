<?php
// index.php - Fairline Layout with WebAuthn Integration
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>中飛科技股份有限公司 ::: WebAuthn 驗證服務</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Modern Styles -->
    <link rel="stylesheet" href="assets/css/modern.css">

    <script>
        /**
         * WebAuthn Logic
         */
        async function createRegistration() {
            try {
                if (!window.fetch || !navigator.credentials || !navigator.credentials.create) {
                    throw new Error('Browser not supported.');
                }

                // Ensure User ID is generated
                updateUserId();

                const userName = document.getElementById('userName').value;
                const userDisplayName = document.getElementById('userDisplayName').value;

                if (!userName) throw new Error('請輸入使用者名稱');
                if (!userDisplayName) throw new Error('請輸入顯示名稱');

                showLoading('準備註冊中...');
                hideStatus();

                // get create args
                let rep = await window.fetch('_test/server.php?fn=getCreateArgs' + getGetParams(), {method:'GET', cache:'no-cache'});
                const createArgs = await rep.json();

                if (createArgs.success === false) {
                    throw new Error(createArgs.msg || 'unknown error occured');
                }

                recursiveBase64StrToArrayBuffer(createArgs);

                showLoading('請使用您的安全金鑰或生物辨識...');
                const cred = await navigator.credentials.create(createArgs);

                const authenticatorAttestationResponse = {
                    transports: cred.response.getTransports  ? cred.response.getTransports() : null,
                    clientDataJSON: cred.response.clientDataJSON  ? arrayBufferToBase64(cred.response.clientDataJSON) : null,
                    attestationObject: cred.response.attestationObject ? arrayBufferToBase64(cred.response.attestationObject) : null
                };

                showLoading('驗證中...');
                rep = await window.fetch('_test/server.php?fn=processCreate' + getGetParams(), {
                    method  : 'POST',
                    body    : JSON.stringify(authenticatorAttestationResponse),
                    cache   : 'no-cache'
                });
                const response = await rep.json();

                hideLoading();
                if (response.success) {
                    reloadServerPreview();
                    setStatus(response.msg || '註冊成功！', 'success');
                } else {
                    throw new Error(response.msg);
                }

            } catch (err) {
                hideLoading();
                reloadServerPreview();
                setStatus(err.message || 'unknown error occured', 'error');
            }
        }

        async function checkRegistration() {
            try {
                if (!window.fetch || !navigator.credentials || !navigator.credentials.get) {
                    throw new Error('Browser not supported.');
                }

                // Ensure User ID is generated
                updateUserId();

                const userName = document.getElementById('userName').value;
                if (!userName) throw new Error('請輸入使用者名稱');

                showLoading('準備登入...');
                hideStatus();

                let rep = await window.fetch('_test/server.php?fn=getGetArgs' + getGetParams(), {method:'GET',cache:'no-cache'});
                const getArgs = await rep.json();

                if (getArgs.success === false) {
                    throw new Error(getArgs.msg);
                }

                recursiveBase64StrToArrayBuffer(getArgs);

                showLoading('請驗證您的身份...');
                const cred = await navigator.credentials.get(getArgs);

                const authenticatorAttestationResponse = {
                    id: cred.rawId ? arrayBufferToBase64(cred.rawId) : null,
                    clientDataJSON: cred.response.clientDataJSON  ? arrayBufferToBase64(cred.response.clientDataJSON) : null,
                    authenticatorData: cred.response.authenticatorData ? arrayBufferToBase64(cred.response.authenticatorData) : null,
                    signature: cred.response.signature ? arrayBufferToBase64(cred.response.signature) : null,
                    userHandle: cred.response.userHandle ? arrayBufferToBase64(cred.response.userHandle) : null
                };

                showLoading('驗證登入中...');
                rep = await window.fetch('_test/server.php?fn=processGet' + getGetParams(), {
                    method:'POST',
                    body: JSON.stringify(authenticatorAttestationResponse),
                    cache:'no-cache'
                });
                const response = await rep.json();

                hideLoading();
                if (response.success) {
                    reloadServerPreview();
                    
                    // Transition to Authenticated State
                    const loginForm = document.getElementById('login-flow-container');
                    const userSection = document.getElementById('user-authenticated-section');
                    
                    const userName = response.userName || document.getElementById('userName').value;
                    const displayName = response.userDisplayName || document.getElementById('userDisplayName').value;
                    
                    document.getElementById('auth-user-name').textContent = displayName || userName;
                    document.getElementById('auth-user-id').textContent = '@' + userName;
                    document.getElementById('auth-login-time').textContent = new Date().toLocaleString();
                    document.getElementById('auth-avatar').textContent = (displayName || userName).charAt(0).toUpperCase();

                    loginForm.style.display = 'none';
                    userSection.classList.remove('hidden');
                    
                    setStatus('登入成功！', 'success');
                } else {
                    throw new Error(response.msg);
                }

            } catch (err) {
                hideLoading();
                reloadServerPreview();
                setStatus(err.message || 'unknown error occured', 'error');
            }
        }

        async function logout() {
            try {
                showLoading('登出中...');
                
                // Server-side logout
                await window.fetch('_test/server.php?fn=logout', {method:'GET', cache:'no-cache'});
                
                const loginForm = document.getElementById('login-flow-container');
                const userSection = document.getElementById('user-authenticated-section');

                userSection.classList.add('hidden');
                loginForm.style.display = 'block';
                
                hideStatus();
                hideLoading();

            } catch (err) {
                hideLoading();
                setStatus('Logout failed: ' + err.message, 'error');
            }
        }

        function clearRegistration() {
            if (!confirm('Are you sure you want to clear all registrations?')) return;
            
            showLoading('清除資料中...');
            window.fetch('_test/server.php?fn=clearRegistrations' + getGetParams(), {method:'GET',cache:'no-cache'}).then(function(response) {
                return response.json();
            }).then(function(json) {
               hideLoading();
               if (json.success) {
                   reloadServerPreview();
                   setStatus(json.msg, 'success');
               } else {
                   throw new Error(json.msg);
               }
            }).catch(function(err) {
                hideLoading();
                reloadServerPreview();
                setStatus(err.message || 'unknown error occured', 'error');
            });
        }

        /**
         * Utility Helpers
         */

        function recursiveBase64StrToArrayBuffer(obj) {
            let prefix = '=?BINARY?B?';
            let suffix = '?=';
            if (typeof obj === 'object') {
                for (let key in obj) {
                    if (typeof obj[key] === 'string') {
                        let str = obj[key];
                        if (str.substring(0, prefix.length) === prefix && str.substring(str.length - suffix.length) === suffix) {
                            str = str.substring(prefix.length, str.length - suffix.length);
                            let binary_string = window.atob(str);
                            let len = binary_string.length;
                            let bytes = new Uint8Array(len);
                            for (let i = 0; i < len; i++) {
                                bytes[i] = binary_string.charCodeAt(i);
                            }
                            obj[key] = bytes.buffer;
                        }
                    } else {
                        recursiveBase64StrToArrayBuffer(obj[key]);
                    }
                }
            }
        }

        function arrayBufferToBase64(buffer) {
            let binary = '';
            let bytes = new Uint8Array(buffer);
            let len = bytes.byteLength;
            for (let i = 0; i < len; i++) {
                binary += String.fromCharCode( bytes[ i ] );
            }
            return window.btoa(binary);
        }

        // Auto-generate User ID from User Name
        function updateUserId() {
            const username = document.getElementById('userName').value;
            const useridField = document.getElementById('userId');
            
            if (!username) {
                useridField.value = '';
                return;
            }

            // Simple string to hex conversion
            let hex = '';
            for(let i=0;i<username.length;i++) {
                hex += ''+username.charCodeAt(i).toString(16);
            }
            useridField.value = hex;
        }

        function getGetParams() {
            let url = '';
            // Basic params
            url += '&rpId=' + encodeURIComponent(document.getElementById('rpId').value || location.hostname);
            url += '&userId=' + encodeURIComponent(document.getElementById('userId').value);
            url += '&userName=' + encodeURIComponent(document.getElementById('userName').value);
            url += '&userDisplayName=' + encodeURIComponent(document.getElementById('userDisplayName').value);
            
            // Resident Key
            url += '&requireResidentKey=' + (document.getElementById('requireResidentKey').checked ? '1' : '0');

            // Verification
            if (document.getElementById('userVerification_required').checked) url += '&userVerification=required';
            else if (document.getElementById('userVerification_preferred').checked) url += '&userVerification=preferred';
            else if (document.getElementById('userVerification_discouraged').checked) url += '&userVerification=discouraged';

            // Types
            ['usb', 'nfc', 'ble', 'hybrid', 'int'].forEach(t => {
                if (document.getElementById('type_' + t).checked) url += '&type_' + t + '=1';
            });

            // Formats
            ['none', 'packed', 'android-key', 'apple', 'tpm'].forEach(f => {
                if (document.getElementById('fmt_' + f).checked) url += '&fmt_' + f + '=1';
            });

            return url;
        }

        function showLoading(message) {
            const overlay = document.getElementById('loading-overlay');
            if(overlay) {
                document.getElementById('loading-text').textContent = message;
                overlay.classList.remove('hidden');
            }
        }

        function hideLoading() {
            const overlay = document.getElementById('loading-overlay');
            if(overlay) overlay.classList.add('hidden');
        }

        function setStatus(message, type) {
            const container = document.getElementById('status-container');
            const msg = document.getElementById('status-message');
            msg.textContent = message;
            container.className = 'status-message status-' + type;
            container.classList.remove('hidden');
        }

        function hideStatus() {
            document.getElementById('status-container').classList.add('hidden');
        }

        function reloadServerPreview() {
            let iframe = document.getElementById('serverPreview');
            if (iframe) iframe.src = iframe.src;
        }

        function toggleSettings() {
            document.getElementById('advanced-settings').classList.toggle('hidden');
        }

        function togglePreview() {
            document.getElementById('preview-container').classList.toggle('hidden');
        }

        window.onload = function() {
            if (!window.isSecureContext && location.protocol !== 'https:') {                
                location.href = location.href.replace('http://', 'https://');
            }
            if(document.getElementById('rpId')) {
                document.getElementById('rpId').value = location.hostname;
            }
        }
    </script>
</head>
<body>
    <?php include 'components/header.php'; ?>

    <div class="page-wrapper">
        <!-- Left Side: Branding -->
        <div class="branding-side">
            <div class="branding-content">
                <div class="t1">ABOUT FAIRLINE</div>
                <h2 class="t2">關於中飛</h2>
                <div class="describe">
                    中飛科技專精於網路安全與應用層安全技術，<br>
                    整合產品、技術與人才，<br>
                    提供最適合客戶需求且完善的整合性解決方案。
                </div>
            </div>
            <div class="scroll-prompt">SCROLL</div>
        </div>

        <!-- Right Side: Authentication -->
        <div class="auth-side">
            <!-- Loading Overlay -->
            <div id="loading-overlay" class="loading-overlay hidden">
                <div class="spinner"></div>
                <p id="loading-text" style="color: var(--color-text-primary); font-weight: 500;">Please wait...</p>
            </div>

            <div class="auth-container">
                <header class="auth-header">
                    <h1>WebAuthn 登入驗證</h1>
                    <p>專業的團隊, 精緻的服務</p>
                </header>

                <div id="login-flow-container">
                    <div class="form-group">
                        <label class="form-label">使用者名稱 (User Name)</label>
                        <input type="text" id="userName" class="form-control" placeholder="請輸入您的帳號" oninput="updateUserId()">
                    </div>
                    <div class="form-group">
                        <label class="form-label">顯示名稱 (Display Name)</label>
                        <input type="text" id="userDisplayName" class="form-control" placeholder="例如：王小明">
                    </div>

                    <button class="btn btn-primary" onclick="createRegistration()">註冊新憑證</button>
                    <button class="btn btn-secondary" onclick="checkRegistration()">使用憑證登入</button>
                    
                    <div style="text-align: center; margin-top: 15px;">
                        <button type="button" style="background:none; border:none; color:#888; font-size:0.8rem; cursor:pointer; text-decoration: underline;" onclick="toggleSettings()">進階設定 (Advanced)</button>
                    </div>

                    <!-- Advanced Settings (Hidden) -->
                    <div id="advanced-settings" class="hidden" style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px;">
                        <div class="form-group">
                            <label class="form-label">Relying Party ID</label>
                            <input type="text" id="rpId" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label class="form-label">User ID (Hex)</label>
                            <input type="text" id="userId" class="form-control" readonly style="background-color: #f0f0f0; color: #666;">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display:inline-block; margin-right:10px;">Resident Key:</label>
                            <input type="checkbox" id="requireResidentKey">
                        </div>

                        <div class="form-group">
                            <label class="form-label">User Verification</label>
                            <div>
                                <label><input type="radio" name="userVerification" id="userVerification_required"> Required</label>
                                <label><input type="radio" name="userVerification" id="userVerification_preferred"> Preferred</label>
                                <label><input type="radio" name="userVerification" id="userVerification_discouraged" checked> Discouraged</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Authenticator Types</label>
                            <div style="font-size: 0.85rem; display: grid; grid-template-columns: 1fr 1fr; gap: 5px;">
                                <label><input type="checkbox" id="type_usb" checked> USB</label>
                                <label><input type="checkbox" id="type_nfc" checked> NFC</label>
                                <label><input type="checkbox" id="type_ble" checked> BLE</label>
                                <label><input type="checkbox" id="type_hybrid" checked> Hybrid</label>
                                <label><input type="checkbox" id="type_int" checked> Internal</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Attestation Formats</label>
                            <div style="font-size: 0.85rem; display: grid; grid-template-columns: 1fr 1fr; gap: 5px;">
                                <label><input type="checkbox" id="fmt_none" checked> None</label>
                                <label><input type="checkbox" id="fmt_packed" checked> Packed</label>
                                <label><input type="checkbox" id="fmt_android-key" checked> Android Key</label>
                                <label><input type="checkbox" id="fmt_apple" checked> Apple</label>
                                <label><input type="checkbox" id="fmt_tpm" checked> TPM</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Authenticated Section -->
                <div id="user-authenticated-section" class="hidden">
                    <div class="user-section-card">
                        <div id="auth-avatar" class="avatar-circle">U</div>
                        <div class="user-info">
                            <h2 id="auth-user-name">User Name</h2>
                            <p id="auth-user-id">@userid</p>
                        </div>
                        
                        <div style="background: var(--color-bg); padding: 16px; border-radius: var(--radius-md); margin-bottom: 24px;">
                            <p style="font-size: 0.875rem; margin-bottom: 4px; color: var(--color-text-primary); font-weight: 500;">目前狀態</p>
                            <p id="auth-login-time" class="login-meta">Login time: --</p>
                            <p style="color: #1e7e34; font-weight: 500; margin-top: 8px;">登入成功</p>
                        </div>

                        <button type="button" class="btn btn-secondary btn-block" onclick="logout()">
                            登出
                        </button>
                    </div>
                </div>

                <div id="status-container" class="hidden">
                    <p id="status-message"></p>
                </div>
                
                <div style="text-align: center; margin-top: 10px;">
                    <button type="button" style="background:none; border:none; color:#bbb; font-size:0.75rem; cursor:pointer;" onclick="toggleSettings()">[ Show Server Data ]</button>
                </div>

                <!-- Server Preview (Hidden) -->
                <div id="preview-container" class="hidden" style="margin-top: 15px; border: 1px solid #eee; border-radius: 4px; padding: 10px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <h4 style="font-size: 0.8rem; margin: 0; color: #666;">Server Data</h4>
                        <button type="button" style="background: #fce8e6; border: 1px solid #d93025; color: #d93025; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; cursor: pointer;" onclick="clearRegistration()">Clear All</button>
                    </div>
                    <iframe src="_test/server.php?fn=getStoredDataHtml" id="serverPreview" style="width: 100%; height: 200px; border: 1px solid #eee; background: #fafafa;"></iframe>
                </div>
            </div>

            <?php include 'components/footer.php'; ?>
        </div>
    </div>
</body>
</html>