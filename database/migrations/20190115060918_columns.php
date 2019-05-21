<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Columns extends Migrator
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
        $table = $this -> table("columns",array('engine'=>'MyISAM'));
        $table -> addColumn('channel_id','integer',array('limit' => 11,'default'=> '0', 'comment' => '模型ID'))
            -> addColumn('pid','integer',array('limit' => 11,'default'=> '0', 'comment' => '父级ID'))
            -> addColumn('title','string',array('limit' => 16,'default'=> '', 'comment' => '栏目名称'))
            -> addColumn('ctitle','string',array('limit' => 16,'default'=> '', 'comment' => '别名'))
            -> addColumn('sort','integer',array('limit' => 4,'default'=> '50', 'comment' => '权重'))
            -> addColumn('isnav','boolean',array('limit' => 1,'default'=> '0', 'comment' => '是否在导航显示'))
            -> addColumn('status','boolean',array('limit' => 1,'default'=> '0', 'comment' => '是否禁用栏目'))
            ->addIndex(array('channel_id','pid'),array('unique'=>false))
            ->addTimestamps()
            ->create();
    }
}
