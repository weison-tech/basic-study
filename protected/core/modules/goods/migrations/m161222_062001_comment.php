<?php

use core\migrations\Migration;

class m161222_062001_comment extends Migration
{
    public function up()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey()->comment('评论ID'),
            'goods_id' => $this->integer()->unsigned()->notNull()->comment('商品id'),
            'email' => $this->string(60)->notNull()->comment('邮箱'),
            'username' => $this->string(60)->notNull()->comment('用户名'),
            'content' => $this->text()->comment('评论内容'),
            'created_at' => $this->integer()->unsigned()->notNull()->comment('添加时间'),
            'ip_address' => $this->string(15)->notNull()->comment('ip地址'),
            'is_show' => $this->smallInteger()->unsigned()->notNull()->comment('是否显示'),
            'parent_id' => $this->integer()->unsigned()->notNull()->comment('父id'),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('评论用户'),
            'img' => $this->text()->comment('晒单图片'),
            'order_id' => $this->integer()->unsigned()->comment('订单id'),
            'deliver_rank' => $this->smallInteger()->unsigned()->notNull()->comment('物流评价等级'),
            'goods_rank' => $this->smallInteger()->unsigned()->comment('商品评价等级'),
            'service_rank' => $this->smallInteger()->unsigned()->comment('商家服务态度评价等级'),
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m161222_062001_comment cannot be reverted.\n";

        return false;
    }
}
