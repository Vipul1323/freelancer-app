<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('projects')){
            Schema::create('projects', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('project_id')->nullable()->default(null);
                $table->unsignedBigInteger('user_id')->nullable()->default(null);
                $table->char('title',100)->nullable()->default(null);
                $table->longText('description')->nullable()->default(null);
                $table->date('due_date')->nullable()->default(null);
                $table->boolean('is_completed')->nullable()->default(false);
                $table->unsignedBigInteger('assigned_to')->nullable()->default(null);
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('deleted_at')->nullable()->default(null);
                $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            });
        }

        if(!Schema::hasTable('projects_has_files')){
            Schema::create('projects_has_files', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('project_id')->nullable()->default(null);
                $table->unsignedBigInteger('user_id')->nullable()->default(null);
                $table->string('file_name')->nullable()->default(null);
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('deleted_at')->nullable()->default(null);
                $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            });
        }
        if(!Schema::hasTable('projects_notes')){
            Schema::create('projects_notes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('project_id')->nullable()->default(null);
                $table->unsignedBigInteger('user_id')->nullable()->default(null);
                $table->mediumText('note')->nullable()->default(null);
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('deleted_at')->nullable()->default(null);
                $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
