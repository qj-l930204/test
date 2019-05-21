<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AuthGroupAccess extends Migrator
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
        $table = $this -> table("auth_group_access",array('engine'=>'MyISAM'));
        $table ->setId(false)
            -> addColumn('uid','integer',array('limit' => 8, 'comment' => '管理员id'))
            -> addColumn('group_id', 'integer',array('limit' => 8,'default'=>'0','comment'=>'管理员组id'))
            -> addIndex(array('uid','group_id'),array('unique'=>false))
            ->create();
    }
}
