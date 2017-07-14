<?php

use core\migrations\Migration;

class m161222_060507_goods extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods}}', [
            'id' => $this->primaryKey()->comment('商品ID'),
            'category_id' => $this->integer()->unsigned()->notNull()->comment('分类ID'),
            'sn' => $this->string(60)->notNull()->comment('商品编号'),
            'name' => $this->string(120)->notNull()->comment('商品名称'),
            'short_name' => $this->string(60)->notNull()->comment('商品短名称,主要用于手机'),
            'brand_id' => $this->integer()->unsigned()->notNull()->comment('品牌ID'),
            'stock' => $this->smallInteger(5)->unsigned()->notNull()->comment('库存数量'),
            'comment_counts' => $this->integer()->unsigned()->comment('商品评论数'),
            'weight' => $this->integer()->unsigned()->notNull()->comment('商品重量克为单位'),
            'market_price' => $this->decimal(10, 2)->unsigned()->notNull()->comment('市场价'),
            'price' => $this->decimal(10, 2)->unsigned()->notNull()->comment('销售价'),
            'cost_price' => $this->decimal(10, 2)->unsigned()->comment('商品成本价'),
            'keywords' => $this->string()->notNull()->comment('商品关键词'),
            'summary' => $this->string()->notNull()->comment('商品简单描述'),
            'description' => $this->text()->comment('商品详细描述'),
            'is_on_sale' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->comment('是否上架'),
            'is_free_shipping' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->comment('是否包邮0否1是'),
            'on_sale_at' => $this->integer()->unsigned()->notNull()->comment('商品上架时间'),
            'sort' => $this->smallInteger()->unsigned()->notNull()->comment('商品排序'),
            'is_recommend' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->comment('是否推荐'),
            'is_new' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->comment('是否新品'),
            'is_hot' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->comment('是否热卖'),
            'created_at' => $this->integer()->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->unsigned()->notNull()->comment('最后更新时间'),
            'goods_type' => $this->smallInteger()->unsigned()->notNull()->comment('商品所属类型id'),
            'sales_sum' => $this->integer()->unsigned()->null()->defaultValue(0)->comment('商品销量'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_060507_goods cannot be reverted.\n";

        return false;
    }
}
