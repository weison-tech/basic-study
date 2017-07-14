<?php

use core\migrations\Migration;

class m161222_061001_goods_collect extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_collect}}', [
            'id' => $this->primaryKey()->comment('收藏ID'),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('用户ID'),
            'goods_id' => $this->integer()->unsigned()->notNull()->comment('商品ID'),
            'created_at' => $this->integer()->unsigned()->notNull()->comment('收藏时间'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_061001_goods_collect cannot be reverted.\n";

        return false;
    }
}
