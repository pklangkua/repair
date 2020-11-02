<!doctype html>
<html lang="en">
<head>
<title>calculate number</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
body{margin-top:40px;}
</style>
<div class="container">
<button data-toggle = "modal" data-target="#editemployee" data-id="1">ID:1</button>
<button data-toggle = "modal" data-target="#editemployee" data-id="2">ID:2</button>
</div>
<div class="modal fade" id="editemployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Test ID</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">ID:</label>
            <input type="text" class="form-control" id="emp_id" name ="idtest">
            
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
        <?php echo $emp_id ;?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#editemployee').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var id= button.data('id');
	  var modal = $(this);
	  modal.find('#emp_id').val(id);
	});
});
</script>
</body>
</html>