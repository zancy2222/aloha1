<form class="form-horizontal well span6" action="controller.php?action=applydiscount&code=<?php echo $result->CONFIRMATIONCODE; ?>" method="POST">

  <fieldset>
    <legend>New User Account</legend>

    <div class="form-group">
      <label class="col-md-4 control-label" for="allSeniors">All Guests are Seniors:</label>
      <div class="col-md-8">
        <input type="checkbox" id="allSeniors" name="allSeniors" onchange="handleSeniorCheckboxChange()">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="numberOfGuests">Number of Guests:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="numberOfGuests" name="numberOfGuests" placeholder="Number of Guests" type="number" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="numberOfSeniors">Number of Senior Citizens:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="numberOfSeniors" name="numberOfSeniors" placeholder="Number of Senior Citizens" type="number" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <button class="btn btn-primary" name="save" type="submit">Save</button>
      </div>
    </div>

  </fieldset>

  <script>
  function handleSeniorCheckboxChange() {
    var allSeniorsCheckbox = document.getElementById('allSeniors');
    var numberOfGuestsInput = document.getElementById('numberOfGuests');
    var numberOfSeniorsInput = document.getElementById('numberOfSeniors');

    // Disable or enable all inputs based on the checkbox status
    numberOfGuestsInput.disabled = allSeniorsCheckbox.checked;
    numberOfSeniorsInput.disabled = allSeniorsCheckbox.checked;

    // If all guests are seniors, set the number of guests to be the same as the number of seniors
    if (allSeniorsCheckbox.checked) {
      numberOfGuestsInput.value = numberOfSeniorsInput.value;
    } else {
      // If not all guests are seniors, reset the number of guests to an empty value
      numberOfGuestsInput.value = "";
    }
  }
</script>


</form>
