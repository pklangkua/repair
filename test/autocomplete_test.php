 <br><br><meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Autocomplete - Default functionality</title>
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="test/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
  <script>
 $(document).ready(function() {
  
    $( "#autocomplete" ).autocomplete({
      //source: availableTags

      source: function( request, response ) {
                
                $.ajax({
                    url: "test/fetchData.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#autocomplete').val(ui.item.label);
                $('#autocomplete2').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        

    });
  } );
  </script>
<div class="ui-widget">
  <label for="autocomplete">Tags: </label>
  <input type ='text'id="autocomplete">
  <input type='text' id='autocomplete2' >
</div>