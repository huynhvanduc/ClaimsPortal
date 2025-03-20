// assets/js/loading.js
if (typeof window.loadingOverlay === 'undefined') {
    window.loadingOverlay = document.getElementById('loading');
}

let loadingTimeout;

// Function to show loading
window.showLoading = function() {
    console.log('showLoading called');
    if (window.loadingOverlay) {
        console.log('Loading overlay found:', window.loadingOverlay);
        clearTimeout(loadingTimeout);
        window.loadingOverlay.style.display = 'flex';
        window.loadingOverlay.style.opacity = '1'; // Ensure opacity is 1
        window.loadingOverlay.classList.add('show');
    } else {
        console.error('Loading overlay not found');
    }
};

// Function to hide loading
window.hideLoading = function() {
    console.log('hideLoading called');
    if (window.loadingOverlay) {
        window.loadingOverlay.classList.remove('show');
        window.loadingOverlay.style.opacity = '0'; // Ensure opacity is 0
        loadingTimeout = setTimeout(() => {
            window.loadingOverlay.style.display = 'none';
        }, 300);
    }
};