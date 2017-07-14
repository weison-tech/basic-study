<?php

use core\migrations\Migration;

class m161222_061526_spec_name extends Migration
{
    public function up()
    {
        $this->createTable('{{%spec_name}}', [
            'id' => $this->primaryKey()->comment('规格表ID'),
            'type_id' => $this->integer()->unsigned()->comment('规格类型'),
            'name' => $this->string(55)->comment('规格名称'),
            'order' => $this->integer()->unsigned()->comment('排序'),
            'search_index' => $this->smallInteger()->comment('1是，0否'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('状态：0隐藏; 1展示; 2删除'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_061526_spec_name cannot be reverted.\n";

        return false;
    }
}
