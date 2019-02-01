<?php

namespace App\Models;

use App\Traits\ModelHasDateFormatted;
use App\Traits\ModelHasSlug;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use ModelHasDateFormatted;
    use ModelHasSlug;

    protected $fillable = [
        'title',
        'content',
    ];

    public function showRoute()
    {
        return route('pages.show', $this);
    }
}
