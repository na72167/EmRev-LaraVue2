<?php

namespace App\Http\Controllers\companyDate;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class searchCompanyDateController extends Controller
{
    /**
     *
     * @return Response
     */
    protected function searchCompanyDate()
    {
        // TDDO:初期検索処理と条件込みの検索用コントローラーを一緒にする。
        // TODO:paginate()に変更する
        // https://readouble.com/laravel/8.x/ja/pagination.html

        // join句で後で結ぶ
        Log::debug('初期検索');
        $data = CompanyInformation::select([
          'id',
          'company_name',
          'industry',
          'company_url',
          'zip1',
          'zip2',
          'zip3',
          'location',
          'number_of_employees',
          'year_of_establishment',
          'representative',
          'listed_year',
          'average_annual_income',
          'average_age',
          'number_of_reviews',
          'delete_flg',
          'created_at',
          'updated_at'
        ])->paginate(10);

        $count = CompanyInformation::select([
          'id',
          'company_name',
          'industry',
          'company_url',
          'zip1',
          'zip2',
          'zip3',
          'location',
          'number_of_employees',
          'year_of_establishment',
          'representative',
          'listed_year',
          'average_annual_income',
          'average_age',
          'number_of_reviews',
          'delete_flg',
          'created_at',
          'updated_at'
        ])->count();

        $result = array('data' => $data, 'count' => $count);

        // $result = $this->search($companyInformation)->paginate(10);

        return response()->json($result);
    }
}
