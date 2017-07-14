<?php

use core\migrations\Migration;

class m161222_061653_spec_image extends Migration
{
    public function up()
    {
        $this->createTable('{{%spec_image}}', [
            'id' => $this->primaryKey()->comment('规格图片表ID'),
            'goods_id' => $this->integer()->unsigned()->comment('商品规格图片表ID'),
            'spec_value_id' => $this->integer()->comment('规格项id'),
        ], $this->tableOptions);
    }
}
