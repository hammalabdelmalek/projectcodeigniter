<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
         $("form").submit(function(){
                  $.ajax({
                           data: $(this).serialize(),
                           type: $(this).attr('method'),
                           url: $(this).attr('action'),
                           success: function(varX){
                                    $('#get_result').html(varX);
                            }
                  });
                  return false;
         });
})
</script>

<form action="<?php echo base_url(); ?>resultat.php" method="post">
	<input type="text" name="resultat">
	<input type="submit" />
</form>

<div id="get_result">
	
</div>	