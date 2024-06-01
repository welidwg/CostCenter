<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ["groupe", "designation_court", "designation_long", "id_fonction"];

    function fonction(): BelongsTo
    {
        return $this->belongsTo(Fonction::class, "id_fonction");
    }
}
