<?php

namespace App\Console\Commands;

use App\Models\{User, Post, Comment, Address, Company};
use Illuminate\Support\Facades\{Http, Log};
use Illuminate\Console\Command;

class FetchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from JSONPlaceholder API and store in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('[' . now()->toIso8601String() . '] - FetchCommand');
        
        try {
            // Fetch data from API
            $users = Http::get('https://jsonplaceholder.typicode.com/users')->json();
            $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();
            $comments = Http::get('https://jsonplaceholder.typicode.com/comments')->json();

            // Process users
            $this->processUsers($users);
            
            // Process posts
            $this->processPosts($posts);
            
            // Process comments
            $this->processComments($comments);
            
            // Despachar el job para procesar los comentarios por usuario
            \App\Jobs\CommentsPerUserJob::dispatch();
            
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            Log::error('FetchCommand error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
    
    /**
     * Process users, addresses and companies
     */
    protected function processUsers(array $users): void
    {
        $processed = 0;
        $skipped = 0;
        
        foreach ($users as $userData) {
            try {
                // Create or update address
                $address = Address::updateOrCreate(
                    ['id' => $userData['id']],
                    [
                        'street' => $userData['address']['street'],
                        'suite' => $userData['address']['suite'],
                        'city' => $userData['address']['city'],
                        'zipcode' => $userData['address']['zipcode'],
                        'lat' => $userData['address']['geo']['lat'],
                        'lng' => $userData['address']['geo']['lng'],
                    ]
                );
                
                // Create or update company
                $company = Company::updateOrCreate(
                    ['id' => $userData['id']],
                    [
                        'name' => $userData['company']['name'],
                        'catchPhrase' => $userData['company']['catchPhrase'],
                        'bs' => $userData['company']['bs']
                    ]
                );
                
                // Create or update user
                User::updateOrCreate(
                    ['id' => $userData['id']],
                    [
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'username' => $userData['username'],
                        'phone' => $userData['phone'],
                        'website' => $userData['website'],
                        'address_id' => $address->id,
                        'company_id' => $company->id,
                        'password' => bcrypt('password'), // Default password
                    ]
                );
                
                $processed++;
                
            } catch (\Exception $e) {
                $skipped++;
                continue;
            }
        }
        
        $this->line("Processed {$processed} users" . ($skipped > 0 ? " (skipped {$skipped})" : ''));
    }
    
    /**
     * Process posts
     */
    protected function processPosts(array $posts): void
    {
        $processed = 0;
        $skipped = 0;
        
        foreach ($posts as $postData) {
            try {
                // Check if user exists
                if (!User::where('id', $postData['userId'])->exists()) {
                    $skipped++;
                    continue;
                }
                
                // Create or update post
                Post::updateOrCreate(
                    ['id' => $postData['id']],
                    [
                        'user_id' => $postData['userId'],
                        'title' => $postData['title'],
                        'body' => $postData['body']
                    ]
                );
                
                $processed++;
                
            } catch (\Exception $e) {
                $skipped++;
                continue;
            }
        }
        
        $this->line("Processed {$processed} posts" . ($skipped > 0 ? " (skipped {$skipped})" : ''));
    }
    
    /**
     * Process comments
     */
    protected function processComments(array $comments): void
    {
        $processed = 0;
        $skipped = 0;
        
        foreach ($comments as $commentData) {
            try {
                // Check if post exists
                if (!Post::where('id', $commentData['postId'])->exists()) {
                    $skipped++;
                    continue;
                }
                
                // Create or update comment
                Comment::updateOrCreate(
                    ['id' => $commentData['id']],
                    [
                        'post_id' => $commentData['postId'],
                        'name' => $commentData['name'],
                        'email' => $commentData['email'],
                        'body' => $commentData['body']
                    ]
                );
                
                $processed++;
                
            } catch (\Exception $e) {
                $skipped++;
                continue;
            }
        }
        
        $this->line("Processed {$processed} comments" . ($skipped > 0 ? " (skipped {$skipped})" : ''));
    }
}
