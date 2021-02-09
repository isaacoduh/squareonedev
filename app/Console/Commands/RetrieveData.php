<?php

namespace App\Console\Commands;

use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

class RetrieveData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retrieve:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrives information from external api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Posts retrieval successful');

        // $resultsArr = array();

        $client = new Client(['base_uri' => 'https://sq1-api-test.herokuapp.com']);

        $response = $client->request('GET', '/posts');
        $results = $response->getBody();
        $data = json_decode($results, true);
        $postData = $data['data'];
        foreach ($postData as $post) {
            // $resultsArr[] = array("title" => $post['title'], 'body' => $post['description'], 'date' => $post['publication_date']);
            Post::updateOrCreate([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'body' => $post['description'],
                'created_at' => $post['publication_date'],
                'user_id' => 1,
            ]);
        }

        $this->info('Retrieve:Data Cummand Run successfully!');

        // return $resultsArr;
    }
}
