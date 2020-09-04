<?php
     class post_model extends CI_Model{
          public function __construct(){
              $this->load->database();
          }
         

        public function get_cours($slug = FALSE, $limit = FALSE, $offset = FALSE){

            if($limit){
                $this->db->limit($limit, $offset);
            }

            if($slug== FALSE){
                 $this->db->order_by('cours.  id','DESC');
                 $query = $this->db->get('cours');
                 return $query->result_array();
             }
            $query = $this->db->get_where('cours',array('slug' => $slug));
             return $query->row_array();  
             
         } 

        public function mes_cours($id){


            $data  = array();    

            $query=$this->db->get_where('inscription',array('user_id'=>$id));

            $r=$query->result_array();

            foreach ($r as $a):
                $q=$this->db->get_where('cours',array('id'=>$a['cours_id']));
                $b=$q->result_array();
                foreach ($b as $c) {
                    array_push($data, $c);
                }
            endforeach;

            return $data;

        }  

        public function get_exos($id =FALSE ,$slug = FALSE, $limit = FALSE, $offset = FALSE){

            if($limit){
                $this->db->limit($limit, $offset);
            }

            if($slug== FALSE){
                 $this->db->order_by('execrcice.  id','DESC');
                 $query = $this->db->get_where('execrcice',array('cours_id'=>$id));
                 return $query->result_array();
             }
            $query = $this->db->get_where('execrcice',array('id' => $slug,'cours_id'=>$id));
             return $query->row_array();  
             
         }  
        public function get_exo($id){
             $query = $this->db->get_where('execrcice',array('id' => $id));
             return $query->row_array(); 
        } 

         public function get_ligne($id){
            $query=$this->db->get_where('ligne',array('exo_id'=>$id));
            return $query->result_array();
         }

        public function create_cours(){
            $slug = url_title($this->input->post('title'));
             
            $data = array(
                'slug' => $slug,
                'title' => $this->input->post('title'),
                'filiers'=>$this->input->post('filiers'),
                'body'=>$this->input->post('body'),
                'user_id' => $this->session->userdata('user_id'),
                'user_name' =>$this->session->userdata('username')
             );
             return $this->db->insert('cours',$data);
         }

        public function inscrit($id){
            $data = array(
                'cours_id' =>$id ,
                'user_id' =>$this->session->userdata('user_id') 
            );

            return $this->db->insert('inscription',$data);
        } 

        // check  exists inscription 
        public function check_inscription($user_id,$cours_id){
            $query=$this->db->get_where('inscription',array('cours_id'=>$cours_id,'user_id'=>$user_id));
            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }

        public function check_resolu($user_id,$exo_id){
            $query=$this->db->get_where('resolu',array('exo_id'=>$exo_id,'user_id'=>$user_id));
            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }



        public function mes_exos_resolu($id){ 
        $data  = array();    
        $query=$this->db->get_where('resolu',array('user_id'=>$id));
        $r=$query->result_array();
        foreach ($r as $a):
            $q=$this->db->get_where('execrcice',array('id'=>$a['exo_id']));
            $b=$q->result_array();
            foreach ($b as $c) {
                array_push($data, $c);
            }
        endforeach;
        return $data;

        }             


        public function prof_cours($id){
            $query=$this->db->get_where('cours', array('user_id' =>$id  ));
            return $query->result_array();
        }

        public function search($key){

            $this->db->order_by('title', 'DESC');
            $query = $this->db->from('cours')->like('body',$key,'both')->get();
            return $query->result_array();
        }

        public function creer_exo($id){
            $query=$this->db->get_where('cours',array('id'=>$id));
            $query=$query->row_array();
            $data=array(
                "title"=>$this->input->post('titre'),
                "enonce"=>$this->input->post('enonce'),
                "cours_name"=>$query['title'],
                "cours_id"=>$id,
                "user_id"=>$this->session->userdata('user_id')
            
            );

            return $this->db->insert('execrcice',$data);
        }

      public function ajouter_ligne($id){

        $data=array(
           'body'=>$this->input->post('ligne'),
           'exo_id'=>$id,
           'numero_ligne'=>$this->input->post('numero')

        );

         $this->db->insert('ligne',$data); 

      }

 
     public function exo_noncomplet(){

        $query = $this->db->get_where('execrcice',array('user_id'=>$this->session->userdata('user_id'),'etat'=>0));
        return $query->result_array();

     }

     public function check_number_exists($id,$number){
            $query=$this->db->get_where('ligne',array('exo_id'=>$id,'numero_ligne'=>$number));
            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
    }
    
    public function delete_ligne($id){
             $this->db->where('id',$id);
             $this->db->delete('ligne');
             return true;
    }        


}         