// assets/js/toast.js
document.addEventListener('DOMContentLoaded', () => {
    const toastContainer = document.getElementById('toast-container');

    // Function to show toast
    window.showToast = function(message, type = 'success', duration = 3000) {
        if (!toastContainer) {
            console.error('Toast container not found');
            return;
        }

        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <span class="toast-message">${message}</span>
            <button class="toast-close">×</button>
        `;

        // Add toast to container
        toastContainer.appendChild(toast);

        // Show toast with animation
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        // Automatically hide after duration
        setTimeout(() => {
            hideToast(toast);
        }, duration);

        // Handle close button click
        const closeButton = toast.querySelector('.toast-close');
        closeButton.addEventListener('click', () => {
            hideToast(toast);
        });
    };

    // Function to hide toast
    function hideToast(toast) {
        toast.classList.remove('show');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300); // Wait for fade-out animation to complete
    }
});