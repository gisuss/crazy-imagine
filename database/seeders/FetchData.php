<?php

namespace Database\Seeders;

use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class FetchData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Artisan::call('fetch:data');
    }
}
