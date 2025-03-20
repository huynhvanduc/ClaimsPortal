<!-- Views/templates/add_claim.php -->
<?php include_once __DIR__ . '/loading.php'; ?>
<?php include_once __DIR__ . '/toast.php'; ?>

<h2>Add New Claim</h2>
<form id="add-claim-form" 
      hx-post="<?php echo BASE_URL; ?>/?action=add" 
      hx-target="#claim-table" 
      hx-swap="none">
    <div>
        <label for="JobID">Job ID:</label>
        <input type="text" id="JobID" name="JobID" placeholder="JobID" required>
    </div>
    <div>
        <label for="InsuranceClaimNo">Insurance Claim No:</label>
        <input type="text" id="InsuranceClaimNo" name="InsuranceClaimNo" placeholder="Insurance Claim No" required>
    </div>
    <div>
        <label for="VehicleRego">Vehicle Rego:</label>
        <input type="text" id="VehicleRego" name="VehicleRego" placeholder="Vehicle Rego" required>
    </div>
    <div>
        <label for="Owner">Owner:</label>
        <input type="text" id="Owner" name="Owner" placeholder="Owner" required>
    </div>
    <button type="submit">Add Claim</button>
</form>

<div id="message-area"></div>

<script src="<?php echo BASE_URL; ?>/assets/js/addClaim.js" defer></script>