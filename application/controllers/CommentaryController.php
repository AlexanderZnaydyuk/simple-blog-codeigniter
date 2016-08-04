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
     * @return string
     */
    public function post()
    {
        $this->auth->check();

        // Hello, Anglular Content-Type: application/json
        $request = json_decode(trim(file_get_contents('php://input')), true);

        $article = $this->article->getById($request['article']);

        if (! $article) {
            show_404();
        }

        $currentDatetime = new DateTime();

        $commentDetails = [
            'text'       => $request['text'],
            'leave_at'   => $currentDatetime->format('Y-m-d H:i:s'),
            'article_id' => $article->id,
            'user_id'    => $this->auth->userId(),
        ];

        $this->comment->leave($commentDetails);

        $commentDetails['author'] = $this->auth->user();
        unset($commentDetails['author']->password);

        echo json_encode($commentDetails);
    }

    /**
     * @param  integer $article
     * @return string
     */
    public function get($article)
    {
        $commentaries = $this->comment->getByArticle($article);

        echo json_encode($commentaries);
    }
}
