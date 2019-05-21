<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Fans extends Migrator
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
        $table = $this -> table("fans",array('engine'=>'MyISAM'));
        $table -> addColumn('fan_id','integer',array('limit' => 11, 'comment' => '关注ID'))
            -> addColumn('star_id','integer',array('limit' => 11, 'comment' => '被关注ID'))
            ->addTimestamps()
            ->create();
    }
}
