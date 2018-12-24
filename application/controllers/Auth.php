<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CORE_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

	public function index()
	{
		if ($this->session->userdata('currenty_logged')) {
			redirect(base_url().'dashboard');
		} else {
			$data['title']	= "Sign in";
			$data['header'] = $this->load->view('partials/header', NULL, TRUE);
			$data['page_js'] = base_url(). "assets/js/app/login.js";
			$data['footer'] = $this->load->view('partials/footer', $data, TRUE);
			$this->load->view('app/login_view',$data);
		}
	}
	
	public function sign_up() 
	{
		$m_auth = $this->Auth_model;

		if ($m_auth->InsertUser()) {
			$response['status'] = "success";
			$response['message'] = "Successfully registered";
		} else {
			$response['status'] = "error";
			$response['message'] = "Error occured while registering the user";
		}

		echo json_encode($response);	
	}

	public function update()
	{
		$m_auth = $this->Auth_model;

		if ($m_auth->updateUser()) {
			$response['status'] = "success";
			$response['message'] = "Successfully updated";
		} else {
			$response['status'] = "error";
			$response['message'] = "Error occured while updating the user";
		}

		echo json_encode($response);	
	}

	public function delete()
	{
		$m_auth = $this->Auth_model;

		if ($m_auth->deleteUser())
		{
			$response['status'] = "success";
			$response['message'] = "Successfully deleted";
		} else {
			$response['status'] = "error";
			$response['message'] = "Error occured while deleting the user";
		}
	}

	public function authenticate()
	{
		$m_auth = $this->Auth_model;

		$response['email'] = $this->input->post('email');

		$m_auth->email = $this->input->post('email');
		$m_auth->password = $this->input->post('password');

		if($m_auth->AuthenticateUser())
		{
			$response['status']  = "success";
			$response['message'] = "Successfully logged in";
		}
		else 
		{
			$response['status']  = "error";
			$response['message'] = "Username or password incorrect";
		}
		$response['password'] = $m_auth->password;

		echo json_encode($response);
	}

	public function sign_out()
	{
		$m_auth = $this->Auth_model;
		$m_auth->SignOut();
	}
}
?>