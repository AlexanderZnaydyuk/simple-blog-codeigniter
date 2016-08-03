<?php

class Auth
{
    /**
     * @var object
     */
    private static $instance = null;

    /**
     * @var CodeIgniter object
     */
    private $application;

    /**
     * Auth constructor
     */
    public function __construct()
    {
        $this->application = & get_instance();

        $this->application->load->library('session');
        $this->application->load->model('user');
    }

    /**
     * @param  string $email
     * @param  string $password
     * @return null
     */
    public function login($email, $password)
    {
        $user = $this->application->user->getByEmail($email);

        if (! $user) {
            return false;
        }

        if (! password_verify($password, $user->password)) {
            return false;
        }

        $_SESSION['user'] = $user->id;

        return true;
    }

    /**
     * @return null
     */
    public function logout()
    {
        unset($_SESSION['user']);
    }

    /**
     * @return boolean
     */
    public function isLogin()
    {
        return isset($_SESSION['user']);
    }

    /**
     * @return null | redirect
     */
    public function check()
    {
        if (! $this->isLogin()) {
            redirect('auth/signin');
        }
    }

    /**
     * @param  object $object
     * @return boolean
     * @throws Exception 
     */
    public function isOwner($object)
    {
        if ($object->user_id != $this->userId()) {
            throw new Exception("Access denied!", 1);
        }

        return true;
    }

    /**
     * @return object | null
     */
    public function user()
    {
        if (! isset(self::$instance)) {
            self::$instance = $this->application->user->getById($this->application->session->user);
        }

        return self::$instance ;
    }

    /**
     * @return integer | null
     */
    public function userId()
    {
        return $_SESSION['user'];
    }
}
