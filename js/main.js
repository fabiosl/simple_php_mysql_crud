function getValuesAsObject($fields){
  var values = {};
  $fields.each(function() {
        values[this.name] = $(this).val();
  });
  return values;
}

function validateEmail(email) {
    filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    emailOk = filter.test(email);
    if (!emailOk) {
      alert("Invalid email!");
    }
    return emailOk;
}

function success(){
  alert("Success! Reloading page...");
  window.location.reload();
}

function error(){
  alert("Error! Reloading page...");
  window.location.reload();
}

function getValuesFromRow(rowNumber){
  $editable_fields = $("tr[row_id="+ rowNumber+ "] .row_field input");  
  var values = getValuesAsObject($editable_fields);
  return values;
}

function removeTextAreasFromRow(rowNumber){
  $editable_fields = $("tr[row_id="+ rowNumber+ "] .row_field");
  $editable_fields.each(function() {    
    $(this).html($(this).children(0).val());
  });
}

function saveRow(rowNumber){
  var values = getValuesFromRow(rowNumber);
  if(validateValues(values)){
    $.ajax({
      type: "POST",
      url: 'update.php',
      data: values,
      success: (function(){
        alert ("Updated Successfully!");
        removeTextAreasFromRow(rowNumber);
        $('#save_button_'+rowNumber).hide(); //hide save button
        $('#edit_button_'+rowNumber).show(); //show edit button
      }),
      error: error
    });
  }

}

function addTextAreasOnRow(rowNumber){
  $editable_fields = $("tr[row_id="+ rowNumber+ "] .row_field");
  $editable_fields.each(function() {
    var content = $(this).html();
    var newHTML = "<input name=\""+ $(this).attr('name') +"\" value=\""+ content.replace('"','') +"\"></input>"
    $(this).html(newHTML);
  });
}

function editRow(rowNumber){
  $('#edit_button_'+rowNumber).hide(); //hide edit button
  $('#save_button_'+rowNumber).show(); //show save button
  addTextAreasOnRow(rowNumber);
}

function deleteRow(rowNumber){
  if(confirm("Are you sure that you want to delete this user?")){
    $.ajax({
      type: "POST",
      url: 'delete.php',
      data: {'id':rowNumber},
      success: function(){
        $("tr[row_id='"+ rowNumber+"']").remove();
      }
    });
  }
}

function validateValues(values){
  return validateEmail(values.email)
}

$(document).ready(function () {
  $('#add_user_form').submit(function() {
    var $fields = $('#add_user_form :input');
    var values = getValuesAsObject($fields)
    if(validateValues(values)){
     $.ajax({
      type: "POST",
      url: 'insert.php',
      data: values,
      success: success,
      error: error
    }); 
    }
    return false;
  });

$(document)
  .ajaxStart(function() {
    $('#loading-div-background').show();
  })
  
  .ajaxStop(function() {
    $('#loading-div-background').hide();
  })
;


});