<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ArticleController extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->helper('url');
        $this->load->model('article');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('auth');
    }

    /**
     * @return null
     */
    private function prepareArticleValidationRules()
    {
        $this->form_validation->set_rules(
            'title',
            'Title',
            'required|min_length[2]|max_length[255]'
        );

        $this->form_validation->set_rules(
            'text',
            'Text',
            'required|min_length[2]'
        );
    }

    /**
     * @return array
     */
    private function fileUploadConfig()
    {
        $config = [];
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name']  = true;
        $config['max_size']      = '2048';

        return $config;
    }

    /**
     * Prepeare paginations config array
     * @return array
     */
    private function paginationConfig()
    {
        $config = [];

        $config['base_url']      = '/articles';
        $config['total_rows']    = $this->article->count();
        $config['per_page']      = 10;
        $config["num_links"]     = round($config["total_rows"] / $config["per_page"]);
        $config['num_tag_open']  = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open']  = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link']     = false;
        $config['prev_link']     = false;
        
        return $config;
    }

    /**
     * @return view
     */
    public function index()
    {
        redirect('articles');
    }

    /**
     * @param  integer $from
     * @return view
     */
    public function articles($from = 0)
    {
        $paginationConfig = $this->paginationConfig();

        $this->pagination->initialize($paginationConfig);

        $articles = $this->article->withAuthors($paginationConfig['per_page'], $from);

        $links = $this->pagination->create_links();
        
        $this->load->view('articles', [
            'articles' => $articles,
            'links'    => $links
        ]);
    }

    /**
     * @param  integer $article
     * @return view
     */
    public function article($article)
    {
        $article = $this->article->getOneWithAuthor($article);

        if (! $article) {
            show_404();
        }

        $this->load->view('article', ['article' => $article]);
    }

    /**
     * @return view
     */
    public function management()
    {
        $this->auth->check();

        $articles = $this->article->getByUser($this->auth->user()->id);

        $this->load->view('management', ['articles' => $articles]);
    }

    /**
     * @return view
     */
    public function getCreate()
    {
        $this->auth->check();

        $this->load->view('new_article');
    }

    /**
     * @return view
     */
    public function postCreate()
    {
        $this->auth->check();

        $this->prepareArticleValidationRules();

        if (! $this->form_validation->run()) {
            return $this->load->view('new_article');
        }

        $fileUploadConfig = $this->fileUploadConfig();
        $this->upload->initialize($fileUploadConfig);
            
        if (! $this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            return $this->load->view('new_article', $error);
        }

        $currentDatetime = new DateTime();
        $articleDetails = [
            'title'        => $this->input->post('title'),
            'text'         => $this->input->post('text'),
            'image'        => base_url() . 'uploads/' . $this->upload->data('file_name'),
            'published_at' => $currentDatetime->format('Y-m-d H:i:s'),
            'user_id'      => $this->auth->userId(),
        ];

        $this->article->post($articleDetails);

        redirect('dashboard');
    }

    /**
     * @param  integer $article
     * @return view
     */
    public function getEdit($article)
    {
        $this->auth->check();

        $article = $this->article->getById($article);

        if (! $article) {
            show_404();
        }

        $this->auth->isOwner($article);

        $this->load->view('edit_article', ['article' => $article]);
    }

    /**
     * @param  integer $article
     * @return view
     */
    public function postEdit($article)
    {
        $this->auth->check();

        $this->prepareArticleValidationRules();

        if (! $this->form_validation->run()) {
            return $this->load->view('edit_article');
        }

        $articleDetails = [];

        if (! empty($_FILES['image']['name'])) {
            unlink('./uploads/' . basename($this->input->post('oldImage')));

            $fileUploadConfig = $this->fileUploadConfig();
            $this->upload->initialize($fileUploadConfig);

            if (! $this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                return $this->load->view('new_article', $error);
            }

            $articleDetails['image'] = base_url() . 'uploads/' . $this->upload->data('file_name');
        }

        $currentDatetime = new DateTime();
        $articleDetails['title'] = $this->input->post('title');
        $articleDetails['text'] = $this->input->post('text');
        $articleDetails['published_at'] = $currentDatetime->format('Y-m-d H:i:s');

        $this->article->update($article, $articleDetails);

        redirect('dashboard');
    }

    /**
     * @param  integer $article
     * @return view | null
     */
    public function delete($article)
    {
        $this->auth->check();

        $article = $this->article->getById($article);

        $this->auth->isOwner($article);

        $this->article->delete($article->id);

        redirect('dashboard');
    }
}
