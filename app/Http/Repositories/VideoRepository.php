<?php

namespace App\Http\Repositories;

use App\Models\Video;

class VideoRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(new Video());
    }
}
