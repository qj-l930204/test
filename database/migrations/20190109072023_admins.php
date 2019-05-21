<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Admins extends Migrator
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
        $table = $this -> table("admins",array('engine'=>'MyISAM'));
        $table -> addColumn('username','string',array('limit' => 32, 'comment' => '用户账号'))
            -> addColumn('password', 'string',array('limit' => 60,'default'=>\think\helper\Hash::make('123456'),'comment'=>'用户密码'))
            -> addColumn('nickname', 'string',array('limit' => 16,'default'=>'','comment'=>'昵称'))
            -> addColumn('headimg', 'string',array('limit' => 128,'default'=>'','comment'=>'头像'))
            -> addColumn('phone', 'string',array('limit' => 16,'default'=>'','comment'=>'电话'))
            -> addColumn('email', 'string',array('limit' => 128,'default'=>'','comment'=>'邮箱'))
            -> addColumn('status', 'boolean',array('limit' => 1,'default'=>'0','comment'=>'禁用账号'))
            -> addColumn('last_login_time', 'integer',array('limit' => 10,'default'=>'0','comment'=>'最后登录时间'))
            -> addColumn('last_login_ip', 'string',array('limit' => 64,'default'=>'','comment'=>'最后登录IP','null'=>true))
            ->addColumn('group_id','integer',array('limit'=>8,'comment'=>'管理员组'))
            ->addColumn('jur','string',array('limit'=>1024,'default'=>'0','comment'=>'管理员权限','null'=>true))
            ->addTimestamps()
            ->create();
    }
}
