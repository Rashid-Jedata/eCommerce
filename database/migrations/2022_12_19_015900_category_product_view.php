<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        DB::statement('CREATE VIEW category_product
                    AS SELECT
                            products.id AS product_id,
                            products.name AS product_name,
                            products.price  AS product_price,
                            products.details AS product_details,
                            products.slug AS product_slug,
                            products.views AS product_views,
                            products.rating AS product_rating,
                            products.updated_at AS product_updated_at,
                            products.user_id AS product_user_id,
                            products.mainImage AS product_mainImage,
                            products.category_id,
                            category.name AS category_name
                    FROM
                        products
                    JOIN category ON products.category_id = category.id');
    }

    public function down()
    {
        Schema::dropIfExists('category_product');
    }
};
