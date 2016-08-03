<?php

include_once 'Truncatable.php';
include_once 'HaveAuthor.php';

class Comment extends CI_Model
{
    use Truncatable, HaveAuthor;

    /**
     * @var string
     */
    private $table = 'commentaries';

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * @param  array  $comment
     * @return bool
     */
    public function leave(array $comment)
    {
        return $this->db->insert($this->table, $comment);
    }

    /**
     * @param  integer $article
     * @return array
     */
    public function getByArticle($article)
    {
        $commentaries = $this->db->where('article_id', $article)
            ->from('commentaries')
            ->order_by('leave_at', 'DESC')
            ->get()
            ->result();

        $commentariesAuthorsIds = [];

        foreach ($commentaries as $commentary) {
            $commentariesAuthorsIds[] = $commentary->user_id;
        }

        $commentariesAuthorsIds = array_unique($commentariesAuthorsIds);

        $commentariesAuthors = $this->authors($commentariesAuthorsIds);

        $this->mergeAuthorsById($commentaries, $commentariesAuthors);

        return $commentaries;
    }
}
