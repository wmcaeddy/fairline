/**
 * WebAuthn Handshake Logic for Galaxy Macau Theme
 */

let isRegistrationMode = false;

document.addEventListener('DOMContentLoaded', () => {
    initUI();
    checkHttps();
});

function initUI() {
    const toggleBtn = document.getElementById('auth-toggle-btn');
    const submitBtn = document.getElementById('auth-submit-btn');
    const headerLoginLink = document.getElementById('header-login-link');
    const headerJoinLink = document.getElementById('header-join-link');

    toggleBtn.addEventListener('click', toggleAuthMode);
    headerLoginLink.addEventListener('click', () => setAuthMode(false));
    headerJoinLink.addEventListener('click', () => setAuthMode(true));

    submitBtn.addEventListener('click', () => {
        if (isRegistrationMode) {
            createRegistration();
        } else {
            checkRegistration();
        }
    });
}

function setAuthMode(registration) {
    if (isRegistrationMode === registration) return;
    toggleAuthMode();
}

function toggleAuthMode() {
    isRegistrationMode = !isRegistrationMode;
    
    const title = document.getElementById('auth-title');
    const desc = document.getElementById('auth-desc');
    const submitBtn = document.getElementById('auth-submit-btn');
    const toggleBtn = document.getElementById('auth-toggle-btn');
    const togglePrompt = document.getElementById('toggle-prompt');
    const toggleDesc = document.getElementById('toggle-desc');
    const displayNameGroup = document.getElementById('displayName-group');

    if (isRegistrationMode) {
        title.textContent = '加入';
        desc.textContent = '註冊帳號，體驗 FIDO2 安全登錄';
        submitBtn.textContent = '創建帳號';
        toggleBtn.textContent = '登入';
        togglePrompt.textContent = '已經有帳號?';
        toggleDesc.textContent = '使用您的通行密鑰登入';
        displayNameGroup.classList.remove('hidden');
    } else {
        title.textContent = '登入';
        desc.textContent = '登入使用您的通行密鑰 (Passkey)';
        submitBtn.textContent = '登入';
        toggleBtn.textContent = '創建帳號';
        togglePrompt.textContent = '還未加入?';
        toggleDesc.textContent = '註冊帳號，體驗 FIDO2 安全登錄';
        displayNameGroup.classList.add('hidden');
    }
}

async function createRegistration() {
    try {
        const userName = document.getElementById('userName').value;
        const userDisplayName = document.getElementById('userDisplayName').value || userName;

        if (!userName) throw new Error('請輸入用戶名稱');

        showLoading('準備註冊...');
        hideStatus();

        // get create args - relative to root index.php
        let rep = await window.fetch('_test/server.php?fn=getCreateArgs&userName=' + encodeURIComponent(userName) + '&userDisplayName=' + encodeURIComponent(userDisplayName) + '&requireResidentKey=1&userVerification=discouraged', {method:'GET', cache:'no-cache'});
        const createArgs = await rep.json();

        if (createArgs.success === false) {
            throw new Error(createArgs.msg || '發生未知錯誤');
        }

        recursiveBase64StrToArrayBuffer(createArgs);

        showLoading('等待驗證器...');
        const cred = await navigator.credentials.create(createArgs);

        const authenticatorAttestationResponse = {
            transports: cred.response.getTransports  ? cred.response.getTransports() : null,
            clientDataJSON: cred.response.clientDataJSON  ? arrayBufferToBase64(cred.response.clientDataJSON) : null,
            attestationObject: cred.response.attestationObject ? arrayBufferToBase64(cred.response.attestationObject) : null
        };

        showLoading('正在向服務器驗證...');
        const verifyRep = await window.fetch('_test/server.php?fn=processCreate', {
            method  : 'POST',
            body    : JSON.stringify(authenticatorAttestationResponse),
            cache   : 'no-cache'
        });
        const response = await verifyRep.json();

        hideLoading();
        if (response.success) {
            reloadServerPreview();
            setStatus(response.msg || '註冊成功', 'success');
            setTimeout(() => setAuthMode(false), 1500); // Switch to login after success
        } else {
            throw new Error(response.msg);
        }

    } catch (err) {
        hideLoading();
        reloadServerPreview();
        setStatus(err.message || '發生未知錯誤', 'error');
    }
}

async function checkRegistration() {
    try {
        const userName = document.getElementById('userName').value;
        // In modern client, resident key is preferred, so userName might be empty initially
        
        showLoading('準備驗證...');
        hideStatus();

        let url = '_test/server.php?fn=getGetArgs&requireResidentKey=1&userVerification=discouraged';
        if (userName) url += '&userName=' + encodeURIComponent(userName);

        let rep = await window.fetch(url, {method:'GET', cache:'no-cache'});
        const getArgs = await rep.json();

        if (getArgs.success === false) {
            throw new Error(getArgs.msg);
        }

        recursiveBase64StrToArrayBuffer(getArgs);

        showLoading('等待驗證器...');
        const cred = await navigator.credentials.get(getArgs);

        const authenticatorAttestationResponse = {
            id: cred.rawId ? arrayBufferToBase64(cred.rawId) : null,
            clientDataJSON: cred.response.clientDataJSON  ? arrayBufferToBase64(cred.response.clientDataJSON) : null,
            authenticatorData: cred.response.authenticatorData ? arrayBufferToBase64(cred.response.authenticatorData) : null,
            signature: cred.response.signature ? arrayBufferToBase64(cred.response.signature) : null,
            userHandle: cred.response.userHandle ? arrayBufferToBase64(cred.response.userHandle) : null
        };

        showLoading('正在驗證登錄...');
        const verifyRep = await window.fetch('_test/server.php?fn=processGet&requireResidentKey=1', {
            method:'POST',
            body: JSON.stringify(authenticatorAttestationResponse),
            cache:'no-cache'
        });
        const response = await verifyRep.json();

        hideLoading();
        if (response.success) {
            reloadServerPreview();
            showAuthenticatedState(response);
            setStatus('登錄成功', 'success');
        } else {
            throw new Error(response.msg);
        }

    } catch (err) {
        hideLoading();
        reloadServerPreview();
        if (err.name === 'NotAllowedError') {
            setStatus('操作未獲授權。', 'error');
        } else {
            setStatus(err.message || '發生未知錯誤', 'error');
        }
    }
}

function showAuthenticatedState(data) {
    const authFlow = document.getElementById('auth-flow-container');
    const userSection = document.getElementById('user-authenticated-section');
    
    document.getElementById('auth-user-name').textContent = data.userDisplayName || data.userName;
    document.getElementById('auth-user-id').textContent = '@' + data.userName;
    document.getElementById('auth-login-time').textContent = '登錄時間: ' + new Date().toLocaleString();
    document.getElementById('auth-avatar').textContent = (data.userDisplayName || data.userName).charAt(0).toUpperCase();

    authFlow.classList.add('fade-out');
    setTimeout(() => {
        authFlow.classList.add('hidden');
        userSection.classList.remove('hidden');
        userSection.classList.add('fade-in');
    }, 300);
}

async function logout() {
    try {
        showLoading('正在登出...');
        await window.fetch('_test/server.php?fn=logout', {method:'GET', cache:'no-cache'});
        
        const authFlow = document.getElementById('auth-flow-container');
        const userSection = document.getElementById('user-authenticated-section');

        userSection.classList.remove('fade-in');
        userSection.classList.add('fade-out');
        
        setTimeout(() => {
            userSection.classList.add('hidden');
            userSection.classList.remove('fade-out');
            authFlow.classList.remove('hidden');
            authFlow.classList.remove('fade-out');
            authFlow.classList.add('fade-in');
            hideStatus();
            hideLoading();
        }, 300);

    } catch (err) {
        hideLoading();
        setStatus('登出失敗: ' + err.message, 'error');
    }
}

function clearRegistration() {
    if (!confirm('您確定要清除所有註冊數據嗎？')) return;
    
    showLoading('正在清除數據...');
    window.fetch('_test/server.php?fn=clearRegistrations', {method:'GET',cache:'no-cache'}).then(res => res.json()).then(json => {
       hideLoading();
       if (json.success) {
           reloadServerPreview();
           setStatus(json.msg, 'success');
       } else {
           throw new Error(json.msg);
       }
    }).catch(err => {
        hideLoading();
        reloadServerPreview();
        setStatus(err.message, 'error');
    });
}

/**
 * Helpers
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

function showLoading(message) {
    const overlay = document.getElementById('loading-overlay');
    document.getElementById('loading-text').textContent = message;
    overlay.classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loading-overlay').classList.add('hidden');
}

function setStatus(message, type) {
    const container = document.getElementById('status-container');
    const msg = document.getElementById('status-message');
    msg.textContent = message;
    container.className = 'status-message status-' + type;
    container.classList.remove('hidden');
    setTimeout(hideStatus, 5000);
}

function hideStatus() {
    document.getElementById('status-container').classList.add('hidden');
}

function reloadServerPreview() {
    let iframe = document.getElementById('serverPreview');
    if (iframe) iframe.src = iframe.src;
}

function toggleDebug() {
    document.getElementById('debug-container').classList.toggle('hidden');
}

function checkHttps() {
    if (!window.isSecureContext && location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {                
        location.href = location.href.replace('http://', 'https://');
    }
}
