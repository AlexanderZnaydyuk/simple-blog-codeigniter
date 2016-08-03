<?php

trait HaveAuthor
{
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
}
