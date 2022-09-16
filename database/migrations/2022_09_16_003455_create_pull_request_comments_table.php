<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePullRequestCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pull_request_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pull_request_id')->constrained('pull_requests');
            $table->foreignId('requested_reviewer_id')->constrained('members');
            $table->longText('comments');
            $table->string('status');
            $table->dateTime('submitted_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pull_request_comments');
    }
}
