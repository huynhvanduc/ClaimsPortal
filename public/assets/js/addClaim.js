// assets/js/addClaim.js
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('add-claim-form');
    const messageArea = document.getElementById('message-area');
    const tbody = document.getElementById('claim-table-body');

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
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(text).replace(/[&<>"']/g, m => map[m]);
    }

    // Handle the add claim event
    if (form) {
        let addTimeout;
        form.addEventListener('htmx:beforeRequest', () => {
            // Validate data before sending
            const jobID = form.querySelector('#JobID').value.trim();
            const insuranceClaimNo = form.querySelector('#InsuranceClaimNo').value.trim();
            const vehicleRego = form.querySelector('#VehicleRego').value.trim();
            const owner = form.querySelector('#Owner').value.trim();

            const errors = [];
            if (!jobID) errors.push('Job ID is required');
            if (!insuranceClaimNo) errors.push('Insurance Claim No is required');
            if (!vehicleRego) errors.push('Vehicle Rego is required');
            if (!owner) errors.push('Owner is required');

            if (errors.length > 0) {
                showToast(errors.join(', '), 'error');
                return false; // Cancel the request if validation fails
            }

            clearTimeout(addTimeout);
            showLoading();
        });

        form.addEventListener('htmx:afterRequest', (event) => {
            try {
                const response = event.detail.xhr.responseText;
                console.log('Add response:', response);
                if (!response) {
                    throw new Error('Empty response from server');
                }
                const data = JSON.parse(response);
                console.log('Parsed data:', data);
                if (!data.success) {
                    throw new Error(data.message || 'Failed to add claim');
                }
                updateClaimTable(data.claims);
                showToast(data.message, 'success');
                form.reset(); // Clear the form after successful addition
            } catch (error) {
                console.error('Error parsing add response:', error);
                showToast(error.message, 'error');
            } finally {
                addTimeout = setTimeout(() => {
                    hideLoading();
                }, 500);
            }
        });
    }
});