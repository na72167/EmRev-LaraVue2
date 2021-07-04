<?php

namespace App\Http\Controllers\companyDate;

use App\Http\Controllers\Controller;
use App\CompanyInformation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class searchCompanyDateController extends Controller
{
    /**
     * 会社情報を検索する。
     * @return Response
     */
    protected function searchCompanyDate()
    {
        // Eloquentをおさらい
        // https://qiita.com/shosho/items/5ca6bdb880b130260586
        // TODO:paginate()に変更する
        // https://readouble.com/laravel/8.x/ja/pagination.html

        Log::debug('初期検索');
        $$result = CompanyInformation::all()->select([
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
        ])
        ->orderBy('desc')
        ->take(10)
        ->get();

        return response()->json($result);
    }
}
