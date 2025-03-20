// assets/js/claimList.js
document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('claim-table-body');

    showLoading();

    // Function to attempt finding searchInput with retry
    function findSearchInput(callback, retries = 5, delay = 100) {
        searchInput = document.getElementById('search');
        if (searchInput) {
            console.log('Search input found:', searchInput);
            callback(searchInput);
        } else if (retries > 0) {
            console.log('Search input not found, retrying...', retries);
            setTimeout(() => findSearchInput(callback, retries - 1, delay), delay);
        } else {
            console.error('Search input not found after retries');
        }
    }

    // Function to update the claims table
    function updateClaimTable(claims) {
        tbody.innerHTML = ''; // Clear old content

        if (!Array.isArray(claims) || claims.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4">No claims found.</td></tr>';
            return;
        }

        claims.forEach(claim => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${escapeHtml(claim.JobID)}</td>
                <td>${escapeHtml(claim.InsuranceClaimNo)}</td>
                <td>${escapeHtml(claim.VehicleRego)}</td>
                <td>${escapeHtml(claim.Owner)}</td>
            `;
            tbody.appendChild(row);
        });
    }

    // Function to protect against XSS
    function escapeHtml(text) {
        const map = {
            '&': '&',
            '<': '<',
            '>': '>',
            '"': '"',
            "'": "'"
        };
        return String(text).replace(/[&<>"']/g, m => map[m]);
    }

    // Check window.BASE_URL
    if (!window.BASE_URL) {
        console.error('BASE_URL is not defined');
        tbody.innerHTML = '<tr><td colspan="4">Error: BASE_URL is not defined</td></tr>';
        return;
    }

    // Load initial claims list using fetch
    const startTime = Date.now();
    showLoading();
    fetch(`${window.BASE_URL}?action=list`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.text();
    })
    .then(rawResponse => {
        if (!rawResponse) {
            throw new Error('Empty response from server');
        }
        let data;
        try {
            data = JSON.parse(rawResponse);
        } catch (e) {
            throw new Error('Invalid JSON response: ' + e.message + ' | Raw response: ' + rawResponse);
        }
        if (data.error) {
            throw new Error(data.error);
        }
        updateClaimTable(data.claims);
    })
    .catch(error => {
        console.error('Error loading initial claims:', error);
        tbody.innerHTML = '<tr><td colspan="4">Error loading claims: ' + error.message + '</td></tr>';
    })
    .finally(() => {
        const elapsedTime = Date.now() - startTime;
        const minLoadingTime = 500;
        const remainingTime = Math.max(0, minLoadingTime - elapsedTime);
        setTimeout(() => {
            hideLoading();
        }, remainingTime);
    });

    // Handle search
    findSearchInput((searchInput) => {
        let searchTimeout;
        searchInput.addEventListener('htmx:beforeRequest', (event) => {
            const searchValue = searchInput.value.trim();
            console.log('Search input value:', searchValue);
            header('Content-Type: application/json');
            clearTimeout(searchTimeout);
            showLoading();
        });

        searchInput.addEventListener('htmx:afterRequest', (event) => {
            try {
                const response = event.detail.xhr.responseText;
                console.log('Search response:', response);
                const data = JSON.parse(response);
                if (data.error) {
                    throw new Error(data.error);
                }
                updateClaimTable(data.claims);
            } catch (error) {
                console.error('Error parsing search response:', error);
                tbody.innerHTML = '<tr><td colspan="4">Error loading claims: ' + error.message + '</td></tr>';
            } finally {
                const elapsedTime = Date.now() - startTime;
                const minLoadingTime = 500;
                const remainingTime = Math.max(0, minLoadingTime - elapsedTime);
                searchTimeout = setTimeout(() => {
                    hideLoading();
                }, remainingTime);
            }
        });
    });
});