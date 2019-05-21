<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Singles extends Migrator
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
        $table = $this -> table("singles",array('engine'=>'MyISAM'));
        $table -> addColumn('title','string',array('limit' => 64,'default'=> '', 'comment' => '标题'))
            -> addColumn('litpic','string',array('limit' => 128,'default'=> '', 'comment' => '缩略图'))
            -> addColumn('column_id','integer',array('limit' => 11,'default'=> '0', 'comment' => '栏目ID'))
            -> addColumn('keywords','string',array('limit' => 64,'default'=> '', 'comment' => '关键词'))
            -> addColumn('description','string',array('limit' => 128,'default'=> '', 'comment' => '摘要'))
            -> addColumn('content','text',array( 'comment' => '内容'))
            -> addColumn('videourl','string',array('limit' => 128,'default'=> '', 'comment' => '视频'))
            ->addIndex(array('column_id'),array('unique'=>false))
            ->addTimestamps()
            ->create();
    }
}
