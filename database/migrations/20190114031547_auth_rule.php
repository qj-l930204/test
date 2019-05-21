<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AuthRule extends Migrator
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
        $table = $this -> table("auth_rule",array('engine'=>'MyISAM'));
        $table -> addColumn('name','string',array('limit' => 128, 'comment' => '规则名'))
            -> addColumn('title','string',array('limit' => 16, 'comment' => '规则标题'))
            -> addColumn('type','boolean',array('limit' => 1, 'default'=>'1', 'comment' => '规则类型'))
            -> addColumn('status','boolean',array('limit' => 1, 'default'=>'0', 'comment' => '是否启用，1->启用'))
            -> addColumn('condition','boolean',array('limit' => 1, 'default'=>'1', 'comment' => '规则状态'))
            -> addColumn('pid','integer',array('limit' => 11, 'default'=>'0', 'comment' => '父级规则'))
            -> addColumn('faicon','string',array('limit' => 32, 'default'=>'0', 'comment' => '后台列表图标'))
            -> addColumn('sort','integer',array('limit' => 4, 'default'=>'0', 'comment' => '权重'))
            -> addColumn('channel_id','integer',array('limit' => 8, 'default'=>'0', 'comment' => '模型ID'))
            ->addIndex('channel_id',array('unique'=>false))
            ->create();
    }
}
