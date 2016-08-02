<?php

class Seeder
{
    /**
     * @var Faker\Factory
     */
    private $faker;

    /**
     * @var integer
     */
    private $usersLimit = 30;

    /**
     * @var integer
     */
    private $articlesLimit = 30;

    /**
     * @var integer
     */
    private $commentariesLimit = 60;

    /**
     * @var CodeIgniter object
     */
    private $application;

    /**
     * Seeder constructor 
     */
    public function __construct()
    {
        $this->faker = Faker\Factory::create();

        $this->application = & get_instance();

        $this->application->load->model('user');
        $this->application->load->model('article');
        $this->application->load->model('comment');
    }

    /**
     * Truncate all tables in database
     * @return null
     */
    private function truncate()
    {
        $this->application->user->truncate();
        $this->application->article->truncate();
        $this->application->comment->truncate();
    }

    /**
     * @param  integer $limit
     * @return null
     */
    private function users($limit = 5)
    {
        for ($i = 0; $i < $limit; $i++) {
            $userCredentials = [
                'name'     => $this->faker->firstName,
                'surname'  => $this->faker->lastName,
                'email'    => $this->faker->email,
                'password' => password_hash($this->faker->password, PASSWORD_DEFAULT),
            ];

            $this->application->user->register($userCredentials);
        }
    }
    
    /**
     * @param  integer $limit
     * @return null
     */
    private function articles($limit = 5)
    {
        for ($i = 0; $i < $limit; $i++) {
            $articleDetails = [
                'title'        => $this->faker->sentence($this->faker->numberBetween(1, 10)), 
                'image'        => $this->faker->imageUrl,
                'text'         => $this->faker->paragraph($this->faker->numberBetween(4, 20)),
                'published_at' => $this->faker->dateTimeBetween('-5 years')->format('Y-m-d H:i:s'),
                'user_id'      => $this->faker->numberBetween(1, $this->usersLimit), 
            ];

            $this->application->article->post($articleDetails);
        }
    }

    /**
     * @param  integer $limit
     * @return null
     */
    private function commentaries($limit = 5)
    {
        for ($i = 0; $i < $limit; $i++) {
            $commentDetails = [
                'text'       => $this->faker->sentence($this->faker->numberBetween(2, 12)), 
                'leave_at'   => $this->faker->dateTimeBetween('-5 years')->format('Y-m-d H:i:s'),
                'article_id' => $this->faker->numberBetween(1, $this->articlesLimit), 
                'user_id'    => $this->faker->numberBetween(1, $this->usersLimit), 
            ];

            $this->application->comment->leave($commentDetails);
        }
    }

    /**
     * @return null
     */
    public function seed()
    {
        $this->truncate();

        $this->users($this->usersLimit);
        $this->articles($this->articlesLimit);
        $this->commentaries($this->commentariesLimit);
    }
}
