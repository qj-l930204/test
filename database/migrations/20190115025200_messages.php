<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Messages extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this -> table("messages",array('engine'=>'MyISAM'));
        $table -> addColumn('user_id','integer',array('limit' => 11,'default'=> '0', 'comment' => '用户ID'))
            -> addColumn('nickname','string',array('limit' => 32, 'comment' => '未登录用户名'))
            -> addColumn('phone','string',array('limit' => 32, 'comment' => '未登录用户联系电话'))
            -> addColumn('email','string',array('limit' => 32, 'comment' => '未登录用户联系邮箱'))
            -> addColumn('title','string',array('limit' => 32, 'comment' => '留言标题'))
            -> addColumn('message_type_id','integer',array('limit' => 11,'default'=> '0', 'comment' => '留言类型'))
            -> addColumn('content','string',array('limit' => 512, 'comment' => '留言内容'))
            ->addIndex(array('user_id','message_type_id'),array('unique'=>false))
            ->addTimestamps()
            ->create();
    }
}
