<?php

use core\migrations\Migration;

class m161222_061737_goods_spec extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_spec}}', [
            'goods_id' => $this->integer()->unsigned()->comment('商品id'),
            'key' => $this->string()->comment('规格ID组合'),
            'key_name' => $this->string()->comment('规格值组合'),
            'price' => $this->decimal(10, 2)->comment('价格'),
            'stock' => $this->integer()->unsigned()->comment('库存数量'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('状态：0隐藏; 1展示; 2删除'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_061737_goods_spec cannot be reverted.\n";

        return false;
    }
}
