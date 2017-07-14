<?php

use core\migrations\Migration;

class m161222_060937_goods_category extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_category}}', [
            'id' => $this->primaryKey()->comment('商品分类id'),
            'name' => $this->string(90)->notNull()->comment('商品分类名称'),
            'short_name' => $this->string(60)->notNull()->comment('手机端显示的商品分类名'),
            'parent_id' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('父id'),
            'sort_order' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->comment('排序'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('状态：0隐藏; 1展示; 2删除'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_060937_goods_category cannot be reverted.\n";

        return false;
    }
}
