<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->helper('url');
        $this->load->model('user');
        $this->load->library('auth');
        $this->load->library('form_validation');
    }

    /**
     * @return null
     */
    private function setupSignupValidationRules()
    {
        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|min_length[2]|max_length[100]'
        );

        $this->form_validation->set_rules(
            'surname',
            'Surname',
            'required|min_length[2]|max_length[100]'
        );

        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]'
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]|max_length[255]'
        );
    }

    /**
     * @return null
     */
    private function setupSigninValidationRules()
    {
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email'
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]|max_length[255]'
        );
    }

    /**
     * @return view
     */
    public function getSignup()
    {
        if ($this->auth->isLogin()) {
            redirect('/');
        }

        $this->load->view('register');
    }

    /**
     * @return view
     */
    public function postSignup()
    {
        $this->setupSignupValidationRules();

        if (! $this->form_validation->run()) {
            return $this->load->view('register');
        }

        $credentials = [
            'name'     => $this->input->post('name'),
            'surname'  => $this->input->post('surname'),
            'email'    => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];

        $userId = $this->user->register($credentials);

        $this->auth->login($this->input->post('email'), $this->input->post('password'));

        redirect('/dashboard');
    }

    /**
     * @return view
     */
    public function getSignin()
    {
        if ($this->auth->isLogin()) {
            redirect('/');
        }

        $this->load->view('login');
    }

    /**
     * @return view
     */
    public function postSignin()
    {
        $this->setupSigninValidationRules();

        if (! $this->form_validation->run()) {
            return $this->load->view('login');
        }

        if (! $this->auth->login($this->input->post('email'), $this->input->post('password'))) {
            $this->session->set_flashdata('error', 'Login or password incorrect.');

            return $this->load->view('login');
        }

        redirect('/dashboard');
    }

    /**
     * @return view
     */
    public function logout()
    {
        $this->auth->logout();

        redirect('/');
    }
}
