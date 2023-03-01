<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('category_news', function (Blueprint $table) {
            $table->foreignId('news_id')->constrained();
            $table->foreignId('category_id')->constrained();

            $table->primary(['news_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories_news');
    }
};
