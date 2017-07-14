<?php

use core\migrations\Migration;

class m161222_061633_spec_value extends Migration
{
    public function up()
    {
        $this->createTable('{{%spec_value}}', [
            'id' => $this->primaryKey()->comment('规格值ID'),
            'spec_id' => $this->integer()->unsigned()->comment('规格id'),
            'value' => $this->string(64)->comment('规格项'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_061633_spec_value cannot be reverted.\n";

        return false;
    }
}
