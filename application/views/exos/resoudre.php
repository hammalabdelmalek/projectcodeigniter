

<?php

    if (isset($_POST['update'])) {
		$solutions=explode("/", $_POST['solut']);   	
		foreach ($solutions as $solution) {
				
			if($solution===$_POST['response']){
    			exit("reponse_juste ");
    		}

		}

    	
 		exit('reponse_fausse ');
 	}	
 	    
?>

<?php

    if (isset($_POST['essey'])) {
        $q=$this->db->get_where('resolu',array('exo_id'=>$_POST['id'],'user_id'=>$this->session->userdata('user_id')));
            if(empty($q->row_array())){

                $query=$this->db->get_where('execrcice',array('id'=>$_POST['id']));
    	
    			$query=$query->row_array();

    			if($_POST['type']==1){

    			 	//reponse juste
            		$da=array(
                   		'user_id'=>$this->session->userdata('user_id'),
                   		'exo_id'=>$_POST['id']
                	);
            		$this->db->insert('resolu',$da);
    		
        			$data = array(
                		'nbr_juste'=>$query['nbr_juste']+1,
                		'nbr_essey'=>$query['nbr_essey']+1
           			 );

            	$this->db->where('id',$_POST['id'])->update('execrcice',$data);
    			}else{  	
    				$data = array(
                		'nbr_essey'=>$query['nbr_essey']+1
            		);

           		 $this->db->where('id',$_POST['id'])->update('execrcice',$data);
    				}
 				 exit('success');
            }else{
                exit('deja resolu');
            }


    }
?>
<h2
<h2><?= $title ?></h2>
<br><br>

<div  id="res">
	<p></p>
</div>
<?php echo validation_errors(); ?>
<?php foreach($lignes as $ligne) : ?>

	<div>
	ligne numero <?php echo $ligne['numero_ligne']; ?> :  <?php echo $ligne['body']; ?> 
    </div>

    <br>

<?php endforeach; ?>

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
             
        		   


               }


           });
        });

        function envoi(){
        	 $var='';
        	$('table tbody').children().each(function (index) {
        		$var=$var + $(this).attr('data-index');
        	});

        	console.log($var);
        	checkresult($var);
        }

       function checkresult($var) {
       		$solution="<?php echo $solut ?>";
       	    $.ajax({
               url: 'resoudre.php',
               method: 'POST',
               dataType: 'text',
               data: {
                   update: 1,
                   solut:$solution,
                   response: $var
               }, success: function (response) {
               		const words=$solution.split('/');
               		var r=0;
                    for(var i=0;i<words.length;i++){
                    	console.log(words[i]);
                    	if(words[i]===$var){
                    	   affiche(response,1);	
                    	   console.log('reponse_juste');	
                    	   essey_db(1);
                    	   r=1;
                    	}
                    }
                	if(r==0){
                	affiche(response,0);	
                    console.log('reponse_fausse');
                    essey_db(0);		
                    }
               }
            });

        }

        function essey_db($type) {
        	$id="<?php echo $id ?>";
            $.ajax({
               url: 'resoudre.php',
               method: 'POST',
               dataType: 'text',
               data: {
                   essey: 1,
                   type:$type,
                   id:$id
               }, success: function (response) {
                    console.log(response);
               }
            });
        } 

       function affiche($result,$etat){
       	   const words=$result.split(' ');
       	   var xhttp = new XMLHttpRequest();
 		   xhttp.onreadystatechange = function() {
  		   if (this.readyState == 4 && this.status == 200) {
  		   		if($etat==0){
  		   			$("#res").removeClass("alert alert-dismissible alert-success");
  		   	   		$("#res").addClass("alert alert-dismissible alert-danger");
					document.getElementById("res").innerHTML = "reponse_fausse";
  		   		}else{
  		   			$("#res").removeClass("alert alert-dismissible alert-danger");
  		   			$("#res").addClass("alert alert-dismissible alert-success");
					document.getElementById("res").innerHTML = "reponse_juste";
  		   		}
               
    		}	
  			};
  			xhttp.open("GET", "resoudre.php", true);
  			xhttp.send();
       } 

     </script>   
 

<button type="button" class="btn btn-primary" onclick="envoi()">Valider</button>
