<?php

namespace App\Jobs;

use Illuminate\Bus\Dispatcher as BaseDispatcher;
use Illuminate\Support\Str;

class Dispatcher extends BaseDispatcher
{
    public function dispatchToQueue($command)
    {
        // Si el job usa el trait WithJobUuid, le asignamos un UUID
        if (in_array(\App\Jobs\Traits\WithJobUuid::class, class_uses_recursive($command))) {
            $reflection = new \ReflectionClass($command);
            $property = $reflection->getProperty('jobUuid');
            $property->setAccessible(true);
            
            if (empty($property->getValue($command))) {
                $property->setValue($command, (string) Str::uuid());
            }
        }
        
        return parent::dispatchToQueue($command);
    }
}
