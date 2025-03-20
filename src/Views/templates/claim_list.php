<?php include_once __DIR__ . '/loading.php'; ?>

<!-- Views/templates/claim_list.php -->
<div class="search-container">
        <form id="search-form">
            <input type="text" 
                   id="search" 
                   name="search" 
                   placeholder="Search claims..." 
                   hx-post="<?php echo BASE_URL; ?>/?action=search" 
                   hx-target="#claim-table" 
                   hx-swap="none" 
                   hx-trigger="input delay:500ms" 
                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        </form>
    </div>

<div id="claim-table">
    <table>
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Insurance Claim No</th>
                <th>Vehicle Rego</th>
                <th>Owner</th>
            </tr>
        </thead>
        <tbody id="claim-table-body">
            <?php if (!empty($claims) && count($claims) > 0): ?>
                <?php foreach ($claims as $claim): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($claim['JobID']); ?></td>
                        <td><?php echo htmlspecialchars($claim['InsuranceClaimNo']); ?></td>
                        <td><?php echo htmlspecialchars($claim['VehicleRego']); ?></td>
                        <td><?php echo htmlspecialchars($claim['Owner']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No claims found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="<?php echo BASE_URL; ?>/assets/js/claimList.js" defer></script>