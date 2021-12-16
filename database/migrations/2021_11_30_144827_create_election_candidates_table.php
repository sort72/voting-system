<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('election_candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('election_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('election_candidates');
    }
}
