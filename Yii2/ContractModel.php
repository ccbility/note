<?php
namespace system\db;

use yii\db\ActiveRecord;

class ContractModel extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%contract}}';
    }

    public function rules()
    {
        //开始日期 和 结束日期 必须是正确的日期格式
        //结束日期必须大于等于开始日期
        //自定义报错提示
        return [
            [['contract_name'], 'required'],
            [['contract_name'], 'string', 'max' => 255],
            [['contract_status'], 'required'],
            [['contract_createdate'], 'integer'],
            ['contract_status', 'in', 'range'=>[1,2,3,4,5], 'message'=>'状态不在给定范围'],
            [['contract_remark'], 'string', 'max' => 255],
            [['contract_begindate', 'contract_enddate'], 'toTime'],
            [['contract_enddate'], 'dateValid'],
        ];
    }

    public function toTime($attr)
    {
        $this->$attr = strtotime($this->$attr);
        if(!$this->$attr){
            $this->addError($attr,'日期格式非法');
        }
        return true;
    }

    public function dateValid($attr)
    {
        if($this->contract_enddate < $this->contract_begindate){
            $this->addError($attr,'结束日期必须大于等于开始日期');
            return false;
        }
        return true;
    }
}
