<?php

use core\migrations\Migration;

class m161222_061043_goods_consultation extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_consultation}}', [
            'id' => $this->primaryKey()->comment('商品咨询ID'),
            'goods_id' => $this->integer()->unsigned()->comment('商品id'),
            'username' => $this->string(60)->comment('网名'),
            'created_at' => $this->integer()->unsigned()->comment('咨询时间'),
            'consult_type' => $this->smallInteger()->comment('1 商品咨询 2 支付咨询 3 配送 4 售后'),
            'content' => $this->string()->comment('咨询内容'),
            'parent_id' => $this->integer()->unsigned()->comment('父id 用于管理员回复'),
            'is_show' => $this->smallInteger()->unsigned()->comment('是否显示'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_061043_goods_consultation cannot be reverted.\n";

        return false;
    }
}
