<?php

class Templates extends Controller {

	public function userTable() {
		$this->load->view('admin/templates/user-table');
	}

	public function editUserModal(){
		$this->load->view('admin/templates/edit-user-modal');
	}
	public function deleteUserModal(){
		$this->load->view('admin/templates/delete-user-modal');
	}
	public function editUserCredentialsModal(){
		$this->load->view('admin/templates/edit-user-credentials-modal');
	}
	public function addUserModal(){
		$this->load->view('admin/templates/add-user-modal');
	}
}