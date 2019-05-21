<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Articles extends Migrator
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
        $table = $this -> table("articles",array('engine'=>'MyISAM'));
        $table -> addColumn('title','string',array('limit' => 64, 'comment' => '标题'))
            -> addColumn('sub_title','string',array('limit' => 64,'default'=>'', 'comment' => '副标题','null'=>true))
            -> addColumn('flag_ids','string',array('limit' => 32,'default'=>'', 'comment' => '属性','null'=>true))
            -> addColumn('tag_ids','string',array('limit' => 64,'default'=>'', 'comment' => '标签','null'=>true))
            -> addColumn('sort','integer',array('limit' => 4,'default'=>'50', 'comment' => '权重'))
            -> addColumn('litpic','string',array('limit' => 128,'default'=>'', 'comment' => '缩略图','null'=>true))
            -> addColumn('source','string',array('limit' => 16,'default'=>'', 'comment' => '来源','null'=>true))
            -> addColumn('author','integer',array('limit' => 11,'default'=>'0', 'comment' => '作者'))
            -> addColumn('column_id','integer',array('limit' => 8,'default'=>'0', 'comment' => '栏目ID'))
            -> addColumn('keywords','string',array('limit' => 64,'default'=>'', 'comment' => '关键词','null'=>true))
            -> addColumn('description','string',array('limit' => 256,'default'=>'', 'comment' => '摘要','null'=>true))
            -> addColumn('content','text',array('comment' => '文章内容','null'=>true))
            -> addColumn('commentable','boolean',array('limit' => 1,'default'=>'0', 'comment' => '是否允许评论，1->允许'))
            -> addColumn('click','integer',array('limit' => 8,'default'=>'0', 'comment' => '点击量'))
            -> addColumn('titlecolor','string',array('limit' => 8,'default'=>'#333333', 'comment' => '标题颜色'))
            -> addColumn('accessory','string',array('limit' => 128,'default'=>'', 'comment' => '附件','null'=>true))
            -> addColumn('accessory_jur_id','integer',array('limit' => 4,'default'=>'0', 'comment' => '附件权限'))
            -> addColumn('fee','integer',array('limit' => 8,'default'=>'0', 'comment' => '附件价格'))
            -> addColumn('videourl','string',array('limit' => 128,'default'=>'', 'comment' => '视频链接','null'=>true))
            -> addColumn('redirecturl','string',array('limit' => 128,'default'=>'', 'comment' => '重定向链接','null'=>true))
            -> addColumn('images','text',array('comment' => '图集','null'=>true))
            ->addTimestamps()
            ->addIndex(array('column_id','author'),array('unique'=>false))
            ->create();
    }
}
