 <?php 
 
   if (isset($_POST['register'])) {

     $data = array(
        'solution'=>$_POST['sol']."/".$_POST['response'],
        'etat'=>1
      );

      $this->db->where('id',$_POST['id'])->update('execrcice',$data);
      $this->session->set_flashdata('exo_created','vous avez ajouter une solution a cette execrcice');
      exit('success');

    }

?>

<h2><?= $title ?></h2>

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
            $sol="<?php echo $solution ?>";
            $.ajax({
               url: 'ligne.php',
               method: 'POST',
               dataType: 'text',
               data: {
                   register: 1,
                   response:$var,
                   sol:$sol,
                   id:$id
               }, success: function (response) {
                    location.replace("http://localhost/projet/posts");

               }
            });
        }

    </script>  

    <button type="button" class="btn btn-primary" onclick="envoi()">Ajouter reponse</button>