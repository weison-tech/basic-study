<?php

use core\migrations\Migration;

class m161222_060703_goods_attribute extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_attribute}}', [
            'id' => $this->primaryKey()->comment('属性ID'),
            'attr_name' => $this->string(60)->notNull()->comment('属性名称'),
            'type_id' => $this->integer()->unsigned()->notNull()->comment('属性分类id'),
            'attr_index' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->comment('0不需要检索 1关键字检索 2范围检索'),
            'attr_type' => $this->smallInteger()->unsigned()->notNull()->defaultValue(1)->comment('1单选属性 2复选属性'),
            'attr_input_type' => $this->smallInteger()->unsigned()->notNull()->comment('1单行文本框录入 2多行文本框 3从列表中选择'),
            'attr_values' => $this->text()->notNull()->comment('可选值列表'),
            'order' => $this->smallInteger()->unsigned()->notNull()->comment('属性排序'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('状态：0隐藏; 1展示; 2删除'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_060703_goods_attribute cannot be reverted.\n";

        return false;
    }
}
