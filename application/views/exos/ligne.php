 <?php 

   if (isset($_POST['register'])) {

     $data = array(
        'solution'=>$_POST['response'],
        'etat'=>1
      );

      $this->db->where('id',$_POST['id'])->update('execrcice',$data);
      $this->session->set_flashdata('exo_created','votre exos est bien completé');
      exit('success');

    }

?>

<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php foreach($lignes as $ligne) : ?>

	<div class="alert alert-dismissible alert-warning">
	ligne numero <?php echo $ligne['numero_ligne']; ?> :  <?php echo $ligne['body']; ?> 
 <a  href="<?php echo base_url(); ?>posts/delete_ligne/<?php echo $ligne['id']; ?>"> <button type="button" class="close" data-dismiss="alert">&times;</button></a> 
    </div>

    <br>

<?php endforeach; ?>

<br><br>


<?php echo form_open('posts/ajouter_ligne/'.$id); ?>

	<div class="form-group">
      <label>ajouter ligne </label>
      <input type="text" class="form-control" name="ligne" placeholder="remplir ligne">
    </div>

    <div class="form-group">
      <label>donner un numero a la ligne </label>
      <input type="number" class="form-control" name="numero" >
    </div>
    <input type="hidden" name="id" value="<?php echo($id) ?>">
   
    <button type="submit" class="btn btn-primary">Ajouter ligne</button>

</form>    

<br><br>
<h2>Donner la solution et envoyer</h2>
<table class="table table-stripped table-hover table-bordered">
          <thead>
            <tr>
              <td>Exo lines</td>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($lignes as $ligne) :
                  echo '
                      <tr data-index="'.$ligne['numero_ligne'].'">
                          <td>'.$ligne['body'].'</td>
                      </tr>
                  ';
                            endforeach;
            ?>
          </tbody>
</table>

  

    <script
            src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script
            src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>

    <script type="text/javascript">  
        $(document).ready(function () {
              $('table tbody').sortable({
                 update: function (event, ui) {
                  $var='';
                    $(this).children().each(function (index) {
                      console.log(index);
                      console.log($(this).attr('data-index'));
                      $var=$var + $(this).attr('data-index');
                   });
             
                  console.log($var);


               }


           });
        });

        function envoi(){
           $var='';
          $('table tbody').children().each(function (index) {
            $var=$var + $(this).attr('data-index');
          });
           console.log($var);
          register_reponse($var);
          
        }

        function register_reponse($var){
            $id="<?php echo $id ?>";
            $.ajax({
               url: 'ligne.php',
               method: 'POST',
               dataType: 'text',
               data: {
                   register: 1,
                   response:$var,
                   id:$id
               }, success: function (response) {
                    location.replace("http://localhost/projet/posts");

               }
            });
        }

    </script>  

    <button type="button" class="btn btn-primary" onclick="envoi()">Valider</button>