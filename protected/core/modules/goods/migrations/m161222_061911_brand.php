<?php

use core\migrations\Migration;

class m161222_061911_brand extends Migration
{
    public function up()
    {
        $this->createTable('{{%brand}}', [
            'id' => $this->primaryKey()->comment('品牌ID'),
            'name' => $this->string(60)->notNull()->comment('品牌名称'),
            'description' => $this->text()->notNull()->comment('品牌描述'),
            'url' => $this->string()->notNull()->defaultValue('')->comment('品牌网址'),
            'sort' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('排序'),
            'category_id' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('分类id'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('状态：0隐藏; 1展示; 2删除'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_061911_brand cannot be reverted.\n";

        return false;
    }
}
