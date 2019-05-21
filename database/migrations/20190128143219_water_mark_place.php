<?php

use think\migration\Migrator;
use think\migration\db\Column;

class WaterMarkPlace extends Migrator
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
        $table = $this -> table("watermark_place",array('engine'=>'MyISAM'));
        $table -> addColumn('wmtitle','string',array('limit' => 8,'default'=> '', 'comment' => '位置名称'))
            -> addColumn('wmconst','string',array('limit' => 32,'default'=> '0', 'comment' => '位置常量'))
            -> addColumn('wmcode','integer',array('limit' => 2,'default'=> '0', 'comment' => '位置代码'))
            ->create();
    }
}
