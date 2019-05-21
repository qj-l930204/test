<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Sysconfigs extends Migrator
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
        $table = $this -> table("sysconfigs",array('engine'=>'MyISAM'));
        $table -> addColumn('cname','string',array('limit' => 32,'default'=> '', 'comment' => 'en别名'))
            -> addColumn('title','string',array('limit' => 32,'default'=> '', 'comment' => '名称'))
            -> addColumn('sysconfig_group_id','integer',array('limit' => 11,'default'=> '0', 'comment' => '组ID'))
            -> addColumn('type','string',array('limit' => 16,'default'=> '', 'comment' => '类型'))
            -> addColumn('value','string',array('limit' => 1024,'default'=> '', 'comment' => '值'))
            ->addIndex(array('sysconfig_group_id'),array('unique'=>false))
            ->addTimestamps()
            ->create();
    }
}
