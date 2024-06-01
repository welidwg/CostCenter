<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demandeur extends Model
{
    use HasFactory;
    protected $fillable = ["matricule", "name", "id_fonction", "id_departement", "id_site", "groupe_article"];

    function fonction(): BelongsTo
    {
        return $this->belongsTo(Fonction::class, "id_fonction");
    }

    function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class, "id_departement");
    }

    function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, "id_site");
    }
}
