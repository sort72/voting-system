<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'election_candidates', 'election_id', 'candidate_id');
    }
}
