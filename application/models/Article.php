<?php

include_once 'Truncatable.php';

class Article extends CI_Model
{
    use Truncatable;

    /**
     * @var string
     */
    private $table = 'articles';

     public function __construct()
    {
        $this->load->database();
    }

    /**
     * @param  array  $ids
     * @return array
     */
    public function authors(array $ids)
    {
        return $this->db->select('id, name, surname')
            ->where_in('id', $ids)
            ->from('users')
            ->order_by('id', 'ASC')
            ->get()
            ->result();
    }

    /**
     * @param  array $subjects
     * @param  array $authors
     * @return null
     */
    private function mergeAuthorsById(array $subjects, array $authors)
    {
        $sortedAuthotrs = [];

        foreach ($authors as $author) {
            $sortedAuthotrs[$author->id] = $author;
        }

        foreach ($subjects as $subject) {
            $subject->author = $sortedAuthotrs[$subject->user_id];
        }
    }

    /**
     * @param  array  $details
     * @return boolean
     */
    public function post(array $details)
    {
        // secure ?
        return $this->db->insert($this->table, $details);
    }

    /**
     * @param  integer $id
     * @param  array   $details
     * @return [type]
     */
    public function update($id, array $details)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $details);
    }

    /**
     * @return integer
     */
    public function count()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * @param  integer $user
     * @return array
     */
    public function getByUser($user)
    {
        return $articles = $this->db->where('user_id', $user)
            ->from($this->table)
            ->order_by('published_at', 'DESC')
            ->get()
            ->result();
    }

    /**
     * @param  integer $article
     * @return object | null
     */
    public function getById($article)
    {
        return $this->db->where('id', $article)
            ->from($this->table)
            ->get()
            ->row();
    }

    /**
     * @param  integer $article
     * @return null
     */
    public function delete($article)
    {
        $this->db->where('id', $article);
        $this->db->delete($this->table);
    }

    /**
     * @param  integer $limit
     * @param  integer $start
     * @return array
     */
    public function withAuthors($limit, $start = 0)
    {
        $articles = $this->db->select()
            ->from($this->table)
            ->order_by('published_at', 'DESC')
            ->limit($limit, $start)
            ->get()
            ->result();

        $usersIds = [];

        foreach ($articles as $article) {
            $usersIds[] = $article->user_id;
        }

        $usersIds = array_unique($usersIds);

        $authors = $this->authors($usersIds);

        $this->mergeAuthorsById($articles, $authors);
        
        return $articles;
    }

    /**
     * @param  integer $article
     * @return object | null
     */
    public function getOneWithAuthorAndCommentaries($article)
    {
        $article = $this->getById($article);

        if (! $article) {
            return null;
        }

        $author = $this->db->where('id', $article->user_id)
            ->from('users')
            ->get()
            ->row();

        $article->author = $author;

        $commentaries = $this->db->where('article_id', $article->id)
            ->from('commentaries')
            ->order_by('leave_at', 'DESC')
            ->get()
            ->result();

        if (! $commentaries) {
            $article->commentaries = [];
            
            return $article;
        }

        $commentariesAuthorsIds = [];

        foreach ($commentaries as $commentary) {
            $commentariesAuthorsIds[] = $commentary->user_id;
        }

        $commentariesAuthorsIds = array_unique($commentariesAuthorsIds);

        $commentariesAuthors = $this->authors($commentariesAuthorsIds);

        $this->mergeAuthorsById($commentaries, $commentariesAuthors);

        $article->commentaries = $commentaries;

        return $article;
    }
}
