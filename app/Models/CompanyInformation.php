<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', //個別ID
        'company_name', //会社名
        'industry', //業界分類
        'company_url', //会社の紹介URL
        'zip1', //会社紹介画像その1
        'zip2', //会社紹介画像その2
        'zip3', //会社紹介画像その3
        'location', //所在地
        'number_of_employees', //従業員数
        'year_of_establishment', //設立年度
        'representative', //代表者
        'listed_year', //上場年
        'average_annual_income', //平均年収
        'average_age', //平均年齢
        'number_of_reviews', //総レビュー数
        'delete_flg', //削除フラグ
        'created_at', //生成日時
        'updated_at' //最終更新日時
    ];

    protected $table = 'CompanyInformations';
}
