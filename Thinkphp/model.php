<?php
// +----------------------------------------------------------------------
// | QbtThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.qbt8.com All rights reserved.
// +----------------------------------------------------------------------

namespace Home\Model;
use Think\Model;

/**
 * 分类模型
 */
class DocumentVoteResultModel extends Model{

    protected $_validate = array(
        array('user_name', 'require', '姓名不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('sex', 'require', '称谓不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('sex', array('先生', '女士'), '称谓非法', self::MUST_VALIDATE, 'in', self::MODEL_BOTH),
        array('tel', 'require', '手机号码格式不正确', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),

        //固定为某些值
        array('province', 'require', '所在地不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('province', 'checkProvince', '所在地不能随便篡改', self::MUST_VALIDATE , 'callback', self::MODEL_BOTH),
        array('product', 'require', '贷款产品不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('product', 'checkProduct', '贷款产品不能随便篡改', self::MUST_VALIDATE , 'callback', self::MODEL_BOTH),

        array('limit', 'require', '申请额度不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('limit', array(1,9999999999), '申请额度过于大了', self::MUST_VALIDATE , 'between', self::MODEL_BOTH),
        array('income', 'require', '月收入不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('income', array(1,9999999999), '月收入过于大了', self::MUST_VALIDATE , 'between', self::MODEL_BOTH),
        array('agree', 'require', '还未同意隐私条款', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected function checkProduct($var){
        $cate_id = 54;
        $products = M('document d')->join(C('DB_PREFIX') . 'document_ask_design ds on ds.id = d.id')->where('d.status = 1 and d.category_id = "%s"', $cate_id)->order('d.create_time desc')->getField('products');
        $products = explode('，', $products);
        return in_array($var, $products);
    }
    protected function checkProvince($var){
        $cate_id = 54;
        $province = M('document d')->join(C('DB_PREFIX') . 'document_ask_design ds on ds.id = d.id')->where('d.status = 1 and d.category_id = "%s"', $cate_id)->order('d.create_time desc')->getField('province');
        $province = explode('，', $province);
        return in_array($var, $province);
    }
}
