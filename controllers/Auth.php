<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	/**
	 * @author 		Faisal Efendi
	 * @copyright 	Tenggarong, 10 Oct 2019
	 * @uses		Controller Authentication
	 * @version		20.03.25
	 */

	public function index()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('login_view');
		} else {
			$this->authentication->login($username, $password);
		}
	}

	public function logout()
	{
		$this->authentication->logout();
	}

	public function register()
	{
		$post = $this->input->post();

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_users.user_username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password', 'required|matches[password]');

		if ($this->form_validation->run() == false) {
			$this->load->view('register_view');
		} else {
			$this->authentication->register($post);
		}
	}
}
