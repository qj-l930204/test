<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Links extends Migrator
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
        $table = $this -> table("links",array('engine'=>'MyISAM'));
        $table -> addColumn('title','string',array('limit' => 32,'default'=> '', 'comment' => '名称'))
            -> addColumn('link','string',array('limit' => 128,'default'=> '', 'comment' => '链接网址'))
            -> addColumn('sort','integer',array('limit' => 4,'default'=> '50', 'comment' => '权重'))
            -> addColumn('litpic','string',array('limit' => 128,'default'=> '0', 'comment' => '缩略图'))
            -> addColumn('link_group_id','integer',array('limit' => 11,'default'=> '0', 'comment' => '组ID'))
            -> addColumn('isdisplay','boolean',array('limit' => 1,'default'=> '0', 'comment' => '是否显示'))
            ->addIndex(array('link_group_id'),array('unique'=>false))
            ->addTimestamps()
            ->create();
    }
}
