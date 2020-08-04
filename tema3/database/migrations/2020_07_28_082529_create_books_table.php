<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author_id');
            $table->foreignId('publisher_id');
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('cascade');
            $table->foreign('publisher_id')
                ->references('id')
                ->on('publishers')
                ->onDelete('cascade');
            $table->integer('publisher_year');
            $table->timestamps();
        });

        DB::table('books')->insert([
            [
                'title' => 'book 1',
                'author_id' => '1',
                'publisher_id' => '1',
                'publisher_year' => 2000,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'book 2',
                'author_id' => '2',
                'publisher_id' => '1',
                'publisher_year' => 2001,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'book 3',
                'author_id' => '1',
                'publisher_id' => '4',
                'publisher_year' => 2002,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'book 4',
                'author_id' => '3',
                'publisher_id' => '3',
                'publisher_year' => 2003,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'book 5',
                'author_id' => '4',
                'publisher_id' => '2',
                'publisher_year' => 2004,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'book 6',
                'author_id' => '2',
                'publisher_id' => '4',
                'publisher_year' => 2005,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'book 7',
                'author_id' => '4',
                'publisher_id' => '1',
                'publisher_year' => 2006,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'book 8',
                'author_id' => '2',
                'publisher_id' => '1',
                'publisher_year' => 2007,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'book 8',
                'author_id' => '4',
                'publisher_id' => '4',
                'publisher_year' => 2008,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
