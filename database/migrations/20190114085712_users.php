<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Users extends Migrator
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
        $table = $this -> table("users",array('engine'=>'MyISAM'));
        $table -> addColumn('username','string',array('limit' => 32, 'comment' => '账号'))
            -> addColumn('password','string',array('limit' => 60,'default'=>\think\helper\Hash::make('123456'), 'comment' => '密码'))
            -> addColumn('nickname','string',array('limit' => 16,'default'=>'', 'comment' => '昵称'))
            -> addColumn('phone','string',array('limit' => 16,'default'=>'', 'comment' => '手机号'))
            -> addColumn('email','string',array('limit' => 128,'default'=>'', 'comment' => '邮箱'))
            -> addColumn('name','string',array('limit' => 16,'default'=>'', 'comment' => '姓名'))
            -> addColumn('birth','integer',array('limit' => 10,'default'=>'0', 'comment' => '生日'))
            -> addColumn('gender','integer',array('limit' => 1,'default'=>'0', 'comment' => '性别，0->未知，1->男，2->女'))
            -> addColumn('profession','string',array('limit' => 16,'default'=>'', 'comment' => '职业'))
            -> addColumn('hometown','string',array('limit' => 64,'default'=>'', 'comment' => '籍贯'))
            -> addColumn('location','string',array('limit' => 64,'default'=>'', 'comment' => '所在地'))
            -> addColumn('headimg','string',array('limit' => 128,'default'=>'', 'comment' => '头像'))
            -> addColumn('coverimg','string',array('limit' => 128,'default'=>'', 'comment' => '封面'))
            -> addColumn('ckemail','boolean',array('limit' => 1,'default'=>'0', 'comment' => '邮箱是否验证'))
            -> addColumn('ckphone','boolean',array('limit' => 1,'default'=>'0', 'comment' => '手机号是否验证'))
            -> addColumn('bdate','integer',array('limit' => 10,'default'=>'0', 'comment' => '封号时间','null'=>true))
            -> addColumn('unbdate','integer',array('limit' => 10,'default'=>'0', 'comment' => '解封时间','null'=>true))
            -> addColumn('regdate','integer',array('limit' => 10,'default'=>'0', 'comment' => '注册时间'))
            -> addColumn('last_login_time','integer',array('limit' => 10,'default'=>'0', 'comment' => '最后登录时间'))
            -> addColumn('last_login_ip','string',array('limit' => 32,'default'=>'0.0.0.0', 'comment' => '最后登录IP'))
            -> addColumn('bonuspoints','integer',array('limit' => 11,'default'=>'0', 'comment' => '消费积分'))
            -> addColumn('ratepoints','integer',array('limit' => 11,'default'=>'0', 'comment' => '等级积分'))
            -> addColumn('isvip','boolean',array('limit' => 1,'default'=>'0', 'comment' => '是否是VIP'))
            -> addColumn('balance','integer',array('limit' => 11,'default'=>'0', 'comment' => '余额'))
            ->addIndex(array('username','phone','email'),array('unique'=>true))
            ->addTimestamps()
            ->create();
    }
}
