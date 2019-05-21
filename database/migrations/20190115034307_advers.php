<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Advers extends Migrator
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
        $table = $this -> table("advers",array('engine'=>'MyISAM'));
        $table -> addColumn('title','string',array('limit' => 64,'default'=> '', 'comment' => '标题'))
            -> addColumn('adver_place_id','integer',array('limit' => 11,'default'=> '0', 'comment' => '位置ID'))
            -> addColumn('litpic','string',array('limit' => 128,'default'=> '0', 'comment' => '广告图片'))
            -> addColumn('picwidth','integer',array('limit' => 8,'default'=> '0', 'comment' => '图片宽度'))
            -> addColumn('picheight','integer',array('limit' => 8,'default'=> '0', 'comment' => '图片高度'))
            -> addColumn('isdisplay','boolean',array('limit' => 1,'default'=> '0', 'comment' => '是否显示'))
            -> addColumn('link','string',array('limit' => 128,'default'=> '', 'comment' => '链接'))
            -> addColumn('sort','integer',array('limit' => 4,'default'=> '50', 'comment' => '权重'))
            ->addIndex(array('adver_place_id'),array('unique'=>false))
            ->addTimestamps()
            ->create();
    }
}
