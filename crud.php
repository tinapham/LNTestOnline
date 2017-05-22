<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 class Crud extends CI_Controller {  
      //functions  
      function index(){  
           $data["title"] = "Codeigniter Ajax CRUD with Data Tables and Bootstrap Modals";  
           $this->load->view('crud_view', $data);  
      }  
      function fetch_user(){  
           $this->load->model("crud_model");  
           $fetch_data = $this->crud_model->make_datatables();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';  
                $sub_array[] = $row->first_name;  
                $sub_array[] = $row->last_name;  
                $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs update">Update</button>';  
                $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs delete">Delete</button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->crud_model->get_all_data(),  
                "recordsFiltered"     =>     $this->crud_model->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);  
      }  
      function user_action(){  
           if($_POST["action"] == "Add")  
           {  
                $insert_data = array(  
                     'first_name'          =>     $this->input->post('first_name'),  
                     'last_name'               =>     $this->input->post("last_name"),  
                     'image'                    =>     $this->upload_image()  
                );  
                $this->load->model('crud_model');  
                $this->crud_model->insert_crud($insert_data);  
                echo 'Data Inserted';  
           }  
           if($_POST["action"] == "Edit")  
           {  
                $user_image = '';  
                if($_FILES["user_image"]["name"] != '')  
                {  
                     $user_image = $this->upload_image();  
                }  
                else  
                {  
                     $user_image = $this->input->post("hidden_user_image");  
                }  
                $updated_data = array(  
                     'first_name'          =>     $this->input->post('first_name'),  
                     'last_name'               =>     $this->input->post('last_name'),  
                     'image'                    =>     $user_image  
                );  
                $this->load->model('crud_model');  
                $this->crud_model->update_crud($this->input->post("user_id"), $updated_data);  
                echo 'Data Updated';  
           }  
      }  
      function upload_image()  
      {  
           if(isset($_FILES["user_image"]))  
           {  
                $extension = explode('.', $_FILES['user_image']['name']);  
                $new_name = rand() . '.' . $extension[1];  
                $destination = './upload/' . $new_name;  
                move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
                return $new_name;  
           }  
      }  
      function fetch_single_user()  
      {  
           $output = array();  
           $this->load->model("crud_model");  
           $data = $this->crud_model->fetch_single_user($_POST["user_id"]);  
           foreach($data as $row)  
           {  
                $output['first_name'] = $row->first_name;  
                $output['last_name'] = $row->last_name;  
                if($row->image != '')  
                {  
                     $output['user_image'] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row->image.'" />';  
                }  
                else  
                {  
                     $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
                }  
           }  
           echo json_encode($output);  
      }  
 }  

Models - crud_model.php

 <?php  
 class Crud_model extends CI_Model  
 {  
      var $table = "users";  
      var $select_column = array("id", "first_name", "last_name", "image");  
      var $order_column = array(null, "first_name", "last_name", null, null);  
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);  
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("first_name", $_POST["search"]["value"]);  
                $this->db->or_like("last_name", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table);  
           return $this->db->count_all_results();  
      }  
      function insert_crud($data)  
      {  
           $this->db->insert('users', $data);  
      }  
      function fetch_single_user($user_id)  
      {  
           $this->db->where("id", $user_id);  
           $query=$this->db->get('users');  
           return $query->result();  
      }  
      function update_crud($user_id, $data)  
      {  
           $this->db->where("id", $user_id);  
           $this->db->update("users", $data);  
      }  
 }  