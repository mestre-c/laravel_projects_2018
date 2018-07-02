$(document).ready(function()
{
  $('#submit').click(function()
{
  var count = 0;
  $('.checkbox_table').each(function()
    {
        if($(this).is(':checked')) // if a particular checkbox is checked, then count it
        {
          count = count + 1;
        }
    });
        if(count > 0)
        {
            $('#export_form').submit();
        }
        else
        {
            alert("Please Select at least one table for Backup");
            return false;
        }
})
});