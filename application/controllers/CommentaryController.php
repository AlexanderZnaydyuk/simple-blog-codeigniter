<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CommentaryController extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->helper('url');
        $this->load->model('article');
        $this->load->model('comment');
        $this->load->library('auth');
    }

    /**
     * @return view
     */
    public function post()
    {
        $this->auth->check();

        $article = $this->article->getById($this->input->post('article'));

        if (! $article) {
            show_404();
        }

        $currentDatetime = new DateTime();

        $commentDetails = [
            'text'       => $this->input->post('text'),
            'leave_at'   => $currentDatetime->format('Y-m-d H:i:s'),
            'article_id' => $article->id,
            'user_id'    => $this->auth->userId(),
        ];

        $this->comment->leave($commentDetails);

        redirect($_SERVER['HTTP_REFERER']);
    }
}
