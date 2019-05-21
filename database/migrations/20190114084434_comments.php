<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Comments extends Migrator
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
        $table = $this -> table("comments",array('engine'=>'MyISAM'));
        $table -> addColumn('user_id','integer',array('limit' => 11, 'comment' => '用户ID'))
            -> addColumn('article_id','integer',array('limit' => 11, 'comment' => '文章ID'))
            -> addColumn('content','text',array('comment' => '评论内容'))
            -> addColumn('pid','integer',array('limit' => 11,'default'=> '0', 'comment' => '上级评论ID'))
            ->addIndex('article_id',array('unique'=>false))
            ->addTimestamps()
            ->create();
    }
}
