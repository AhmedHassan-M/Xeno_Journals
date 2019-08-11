<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('corresponding_author')->nullable();
            $table->longText('abstract')->nullable();
            $table->text('keywords')->nullable();
            $table->longText('intro')->nullable();
            $table->longText('additional_info')->nullable();
            $table->longText('reference')->nullable();
            $table->text('word_file')->nullable();
            $table->text('figures')->nullable();
            $table->text('excel_sheet')->nullable();
            $table->text('author_conflict')->nullable();
            $table->text('financial_disclosure')->nullable();
            $table->text('financial_disclosure_file')->nullable();
            $table->text('ethics_community')->nullable();
            $table->string('status');
            $table->text('rejection_reasons')->nullable();
            $table->integer('author_id');
            $table->integer('data_entry')->nullable();
            $table->integer('journal_id');
            $table->integer('volume')->nullable();
            $table->integer('visit')->default(0);
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('revisioned_at')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
