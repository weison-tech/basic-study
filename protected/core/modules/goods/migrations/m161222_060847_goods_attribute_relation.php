<?php

use core\migrations\Migration;

class m161222_060847_goods_attribute_relation extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_attribute_relation}}', [
            'id' => $this->primaryKey()->comment('商品属性id自增'),
            'goods_id' => $this->integer()->unsigned()->notNull()->comment('商品id'),
            'attr_id' => $this->integer()->unsigned()->notNull()->comment('属性id'),
            'attr_value' => $this->text()->notNull()->comment('属性值'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_060847_goods_attribute_relation cannot be reverted.\n";

        return false;
    }
}
