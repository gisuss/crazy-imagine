<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;

// Programación de tareas
Schedule::command('fetch:data')
    ->everyMinute()
    ->withoutOverlapping()
    ->onOneServer()
    ->appendOutputTo(storage_path('logs/fetch-data.log'));

Schedule::command('cache:clear-all')
    ->daily()
    ->withoutOverlapping();
