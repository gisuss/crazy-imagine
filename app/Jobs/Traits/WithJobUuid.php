<?php

namespace App\Jobs\Traits;

trait WithJobUuid
{
    protected $jobUuid;

    public function getJobUuid(): string
    {
        if (!$this->jobUuid) {
            $this->jobUuid = (string) \Illuminate\Support\Str::uuid();
        }
        return $this->jobUuid;
    }

    public function setJobUuid(string $uuid): void
    {
        $this->jobUuid = $uuid;
    }
}
