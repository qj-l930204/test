<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Watermarks extends Migrator
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
        $table = $this -> table("watermarks",array('engine'=>'MyISAM'));
        $table -> addColumn('isopen','boolean',array('limit' => 1,'default'=> '0', 'comment' => '是否开启水印'))
            -> addColumn('watermark_type_id','integer',array('limit' => 2,'default'=> '0', 'comment' => '水印类型'))
            -> addColumn('wmheight','integer',array('limit' => 8,'default'=> '0', 'comment' => '最小添加水印图片高度'))
            -> addColumn('wmwidth','integer',array('limit' => 8,'default'=> '0', 'comment' => '最小添加水印图片宽度'))
            -> addColumn('wmpic','string',array('limit' => 128,'default'=> '', 'comment' => '水印图片'))
            -> addColumn('wmtext','string',array('limit' => 128,'default'=> '', 'comment' => '水印文字'))
            -> addColumn('wmfontsize','integer',array('limit' => 4,'default'=> '12', 'comment' => '水印文字大小'))
            -> addColumn('wmcolor','string',array('limit' => 8,'default'=> '#ff0000', 'comment' => '水印文字颜色'))
            -> addColumn('wmangle','integer',array('limit' => 4,'default'=> '0', 'comment' => '水印字体旋转角度'))
            -> addColumn('wmalpha','integer',array('limit' => 4,'default'=> '100', 'comment' => '水印图片透明度'))
            -> addColumn('watermark_place_id','integer',array('limit' => 4,'default'=> '0', 'comment' => '水印位置'))
            ->addTimestamps()
            ->create();
    }
}
