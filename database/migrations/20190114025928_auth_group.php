<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AuthGroup extends Migrator
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
        $table = $this -> table("auth_group",array('engine'=>'MyISAM'));
        $table -> addColumn('title','string',array('limit' => 16, 'comment' => '组名称'))
            -> addColumn('status', 'boolean',array('limit' => 1,'default'=>'0','comment'=>'是否启用，1->未启用'))
            -> addColumn('rules', 'string',array('limit' => 1024,'default'=>'0','comment'=>'权限'))
            ->create();
    }
}
