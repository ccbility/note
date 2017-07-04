- 带别名的多表left join 写法
```php
$total = ContractModel::find()->alias('ct')->select('*')->where('pp.project_id = 1')->leftjoin(ContractSplitModel::tableName() . 'cst', 'ct.contract_id = cst.contract_id')->leftjoin(ProjectModel::tableName() . 'pp', 'cst.project_id = pp.project_id')->asArray()->all();
```
- yii中的占位符
```php
Admin::find()->where("username=:a AND password=:b", [':a' => 1,':b'=>2])->one();
```