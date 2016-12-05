<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsAndCategoriesTables extends Migration
{
    public function up()
    {
        $schema = Capsule::schema();
        $schema->create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_title');
            $table->string('product_info');
        });
        $schema->create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_title');
            $table->string('category_info');
        });
        $schema->create('products_categories_relations', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }
}
