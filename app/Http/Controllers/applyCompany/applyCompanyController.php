<?php

namespace App\Http\Controllers\applyCompany;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class applyCompanyController extends Controller
{
    protected function applyCompany(Request $request)
    {
      Log::debug('会社情報登録処理を行います。');
      Log::debug("リクエスト内容".$request);

      $CompanyRegistrationResults = CompanyInformation::create([
        'company_name' => $request['company_name'],
        'industry' => $request['industry'],
        // TODO:のちに実装
        // 'company_url' => $request['email'],
        // 'zip1' => $request['email'],
        // 'zip2' => $request['email'],
        // 'zip3' => $request['email'],
        'location' => $request['location'],
        'number_of_employees' => $request['number_of_employees'],
        'year_of_establishment' => $request['year_of_establishment'],
        'representative' => $request['representative'],
        'listed_year' => $request['listed_year'],
        'average_annual_income' => $request['average_annual_income'],
        'average_age' => $request['average_age'],
        // TODO:のちに実装
        // 'number_of_reviews' => $request['number_of_reviews'],
      ]);

      Log::debug($CompanyRegistrationResults);
      return response()->json($CompanyRegistrationResults,201);
    }
}
