<?php
	class Posts extends CI_Controller{

        public function create_db(){

            $this->load->dbforge();

            if($this->dbforge->create_database('pro', TRUE)){

            $fields = array(
                'id' => array(
                            'type' => 'int',
                            'auto_increment' => TRUE
                        )
            );

            $this->dbforge->add_field($fields);  
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('exo');
                   

                echo "db created";

            }

        }

		public function index($offset = 0){

             // Pagination Config    
            $config['base_url'] = base_url() . 'posts/index/';
            $config['total_rows'] = $this->db->count_all('cours');
            $config['per_page'] = 5;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-link');
            // Init Pagination
            $this->pagination->initialize($config);   


			$data['title'] = 'les derniers cours publies';
			$data['cours'] = $this->post_model->get_cours(FALSE, $config['per_page'], $offset);  

			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

        public function mescours($id){
            // Pagination Config    
            $config['base_url'] = base_url() . 'posts/monindex/';
            $qeury=$this->db->get_where('cours',array('user_id'=>$id));
            $config['total_rows'] = $qeury->num_rows();
            $config['per_page'] = 5;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-link');
            // Init Pagination

            $this->pagination->initialize($config);   
            // Check role
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            } 

            // Check role
            if($this->session->userdata('role')!=2){
                redirect('posts');
            } 
            $data['title'] = 'mes cours';
            $data['cours'] =$this->post_model->mes_cours($id);

            $this->load->view('templates/header');
            $this->load->view('posts/monindex', $data);
            $this->load->view('templates/footer');             

        }

		public function view($slug = NULL){

            $data['post'] = $this->post_model->get_cours($slug);
            
            $post_id = $data['post']['id'];
            

            if(empty($data['post'])) {
                show_404();
            }
            
            $this->load->view('templates/header');
            $this->load->view('posts/view', $data);
            $this->load->view('templates/footer');
                       
        }

        public function exoindex($slug = NULL){

            $data['post'] = $this->post_model->get_cours($slug);
            
            $post_id = $data['post']['id'];
            

            if(empty($data['post'])) {
                show_404();
            }

            $data['title'] = $data['post']['title'];

            $data['exos'] = $this->post_model->get_exos($post_id);

            $this->load->view('templates/header');
            $this->load->view('exos/index', $data);
            $this->load->view('templates/footer');


        }

        public function mes_resolu(){

           $data['title']="mes exercice resolu";
           $data['exos']=$this->post_model->mes_exos_resolu($this->session->userdata('user_id'));

           $this->load->view('templates/header');
           $this->load->view('exos/resolu', $data);
           $this->load->view('templates/footer');

        }

        public function statistics($id){
            $data['exo']=$this->post_model->get_exo($id);
            $data['title']='statistics pour '.$data['exo']['title'];
            if($data['exo']['nbr_juste']==0){
             $data['pourcentage']=0;   
            }else{
            $data['pourcentage']=100*$data['exo']['nbr_juste']/$data['exo']['nbr_essey'];
            }
            $this->load->view('templates/header');
            $this->load->view('exos/statistics', $data);
            $this->load->view('templates/footer');

        }

        public function array_exist($liste,$elem){
            foreach ($liste as $key) {
                if($key['id']==$elem['id']){
                    return true;
                }
            }
            return false;
        }

        public function cours_statistics($id){
            $cour=$this->db->get_where('cours',array('id'=>$id));
            $cour=$cour->row_array();
            $exos=$this->db->get_where('execrcice', array('cours_id' =>$id));
            $exos=$exos->result_array();
            $exo_nonresolu=0;
            $nbr_essey=0;
            $nbr_juste=0;
            foreach ($exos as $exo) {
                if($exo['nbr_juste']==0){
                    $exo_nonresolu++;
                }
                $nbr_essey=$nbr_essey+$exo['nbr_essey'];
                $nbr_juste=$nbr_juste+$exo['nbr_juste'];
            }
            $etus=array();
            foreach ($exos as $key) {
                $etu = $this->db->get_where('resolu',array('exo_id'=>$key['id']));
                $etu = $etu->result_array();
                foreach ($etu as $e) {
                    $et=$this->db->get_where('users',array('id'=>$e['user_id']));
                    $et=$et->result_array();
                    foreach ($et as $t) {
                        if(!$this->array_exist($etus,$t)){
                        array_push($etus, $t);}
                    }
                }
            }
            $data['liste_etu']=$etus;
            $data['title']='statistics pour le cours de '.$cour['title'];
            $data['nbr_juste']=$nbr_juste;
            $data['nbr_essey']=$nbr_essey;
            $data['exo_nonresolu']=$exo_nonresolu;
            if($nbr_juste==0){
                $data['pourcentage']=0;   
            }else{
                $data['pourcentage']=100*$nbr_juste/$nbr_essey;
            }
            $this->load->view('templates/header');
            $this->load->view('exos/cours_statistics', $data);
            $this->load->view('templates/footer');

        }

		public function create(){

            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }  
            // Check role
            if($this->session->userdata('role')!=1){
                redirect('posts');
            }             

            $data['title'] ='Créer un Cour';
            
            
            $this->form_validation->set_rules('title', 'Title','required');
            $this->form_validation->set_rules('filiers','Filiers','required');
            
            if($this->form_validation->run()=== FALSE){
                 $this->load->view('templates/header');
			     $this->load->view('posts/create', $data);
			     $this->load->view('templates/footer');
            
            }else{
               
                
                $this->post_model->create_cours();
                //set message
                $this->session->set_flashdata('post_created','votre cours est bien créée');
                redirect('posts');
            }
            
          
        }

        function check_inscription($user_id,$cours_id){
 			
 			if($this->post_model->check_inscription($user_id,$cours_id)){
 				return true;
 			}else{
 				return false;
 			}
 		} 



        public function inscrit($id){

        	// Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            } 
            //check role
            if($this->session->userdata('role')==1){
            	redirect('posts');
            }

            if(!$this->check_inscription($this->session->userdata('user_id'),$id)){
            	$this->session->set_flashdata('check_inscription','Vous etes deja inscrit a ce cours');
            	redirect('posts');

            }else{

            $this->post_model->inscrit($id);

                // set message
            $this->session->set_flashdata('inscrit','vous etes bien inscrit a ce cours');

            redirect('posts');}

        }

        public function prof_cours($id){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            } 

            // Check role
            if($this->session->userdata('role')!=1){
                redirect('posts');
            }         

            $data['title']='les cours que vous avez creer';
            $data['cours']=$this->post_model->prof_cours($id);

            $this->load->view('templates/header');
            $this->load->view('posts/monindex', $data);
            $this->load->view('templates/footer');             

        }

        public function stitle(){
            $data['title'] = 'resulta de la recherche';

            $keyword = $this->input->post('keyword');

            if($keyword == NULL){
                die('error');
            }

            $data['cours']=$this->post_model->search($keyword);

            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');   

        }

        public function nbrligne($id){

            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }            

            $data['title'] ="Créer une appellete d'exercice non complete";
            $data['id']=$id;
            
            
            $this->form_validation->set_rules('titre', 'Titre','required');
            $this->form_validation->set_rules('enonce', 'Enonce','required');
            
            if($this->form_validation->run()=== FALSE){
                 $this->load->view('templates/header');
                 $this->load->view('exos/create', $data);
                 $this->load->view('templates/footer');
            
            }else{

                 $this->post_model->creer_exo($id);   
                 // set message
                 $this->session->set_flashdata('creer_exo','vous avez creer un exo rempliser les ligne');

                 redirect('posts');
            
            }

        }

      
      public function resoudre($id){
         // Check login
        if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
                    // Check login
        if($this->session->userdata('role')!=2){
                redirect('posts');
            }              

        $data['title']="resoudre l'exo";
        $data['lignes']=$this->post_model->get_ligne($id);
        $data['id']=$id;
        $qeury=$this->db->get_where('execrcice',array('id'=>$id));
        $d=$qeury->row_array();
        $data['solut']=$d['solution'];
        
      

        $this->load->view('templates/header');
        $this->load->view('exos/resoudre', $data);
        $this->load->view('templates/footer');


      }

      public function ajouter_ligne($id){
        // Check login
        if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }     
        // Check role
        if($this->session->userdata('role')!=1){
                redirect('posts');
            }         

        $data['title']="ajouter une ligne a l'exercice";
        $data['id']=$id;
        $data['lignes']=$this->post_model->get_ligne($id);


        $this->form_validation->set_rules('ligne', 'Ligne','required');
        $this->form_validation->set_rules('numero','Numero','required|callback_check_number_exists');

        if($this->form_validation->run()=== FALSE){
            $this->load->view('templates/header');
            $this->load->view('exos/ligne', $data);
            $this->load->view('templates/footer');
            
        }else{

             $this->post_model->ajouter_ligne($id);
             $data['lignes']=$this->post_model->get_ligne($id);
             $this->load->view('templates/header');
             $this->load->view('exos/ligne', $data);
             $this->load->view('templates/footer');             
           }

      }

      public function delete_ligne($id){
             

            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }

            // Check role
            if($this->session->userdata('role')!=1){
                redirect('posts');
            }     

            $this->post_model->delete_ligne($id);

                // set message
            $this->session->set_flashdata('ligne_deleted','la ligne est supprimé');

            $url = $_SERVER['HTTP_REFERER'];
            redirect($url);
        
      }

      function check_number_exists($number){

            $id=$this->input->post('id');


            $this->form_validation->set_message('check_number_exists','Ce numero de ligne et deja pris il faut choisir un autre');

            if($this->post_model->check_number_exists($id,$number)){
                return true;
            }else{
                return false;
            }

        }

      public function exos_noncomplet(){
            // Check login
        if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
         // Check role
       if($this->session->userdata('role')!=1){
                redirect('posts');
            }         

        $data['title']="exercice à completé";
        $data['exos']=$this->post_model->exo_noncomplet();

        $this->load->view('templates/header');
        $this->load->view('exos/index', $data);
        $this->load->view('templates/footer');


      }

      public function ajouter_solution($id){

        // Check login
        if(!$this->session->userdata('logged_in')){
                redirect('users/login');
        }
        // Check role
       if($this->session->userdata('role')!=1){
                redirect('posts');
            }

        $q=$this->post_model->get_exo($id);
        $data['solution']=$q['solution'];
        $data['title']="ajouter une solution a l'exercice";
        $data['id']=$id;
        $data['lignes']=$this->post_model->get_ligne($id);

        $this->load->view('templates/header');
        $this->load->view('exos/ajout_solution', $data);
        $this->load->view('templates/footer');        


      }


	}