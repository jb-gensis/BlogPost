<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::create([
            'id' => '1',
            'user_id' => '1',
            'title' => 'Title 1',
            'description' => 'You may write information to the logs using the Log facade. As previously mentioned, the logger provides the eight logging levels. would like to know how I can make the delete button correctly send the id by parameter to the controller, that it receives it and then removes the comment. Thanks!',
        ]);

        Blog::create([
            'id' => '2',
            'user_id' => '1',
            'title' => 'Title 2',
            'description' => 'Laravel includes the ability to seed your database with data using seed classes. All seed classes are stored in the database/seeders directory.',
        ]);

        Blog::create([
            'id' => '3',
            'user_id' => '1',
            'title' => 'Title 3',
            'description' => 'Within the DatabaseSeeder class, you may use the call method to execute additional seed classes. Using the call method allows you to break up your database seeding into multiple files so that no single seeder class becomes too large.',
        ]);

        Blog::create([
            'id' => '4',
            'user_id' => '2',
            'title' => 'Title 1-1',
            'description' => 'Some seeding operations may cause you to alter or lose data. In order to protect you from running seeding commands against your production database, you will be prompted for confirmation before the seeders are executed in the production environment. ',
        ]);

        Blog::create([
            'id' => '5',
            'user_id' => '2',
            'title' => 'Title 1-2',
            'description' => 'Science is an enterprise that should be cherished as an activity of the free human mind. Because it transforms who we are, how we live, and it gives us an understanding of our place in the universe.',
        ]);

        Blog::create([
            'id' => '6',
            'user_id' => '2',
            'title' => 'Title 1-3',
            'description' => 'Venus has a runaway greenhouse effect. I kind of want to know what happened there because were twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. Its bone dry today. Something bad happened there as well.',
        ]);
    }
}
