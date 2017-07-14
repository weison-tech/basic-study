<?php

use core\migrations\Migration;

class m161222_061123_goods_type extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_type}}', [
            'id' => $this->primaryKey()->comment('自增ID'),
            'name' => $this->string(60)->notNull()->comment('类型名称'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('状态：0隐藏; 1展示; 2删除'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_061123_goods_type cannot be reverted.\n";

        return false;
    }
}
