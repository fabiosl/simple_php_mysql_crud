function success(){
  alert("Added new user successfully! Reloading page...")
  window.location.reload()
}

$(document).ready(function () {

  $('#add_user_form').submit(function() {
    var $inputs = $('#add_user_form :input');
    var values = {};
    $inputs.each(function() {
        values[this.name] = $(this).val();
    });
    
    
    $.ajax({
      type: "POST",
      url: 'insert.php',
      data: values,
      success: success
    });

    return false;
  });

});