<?php

namespace App\Http\Controllers\applyCompany;

use App\Http\Controllers\Controller;
use App\CompanyInformation;
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

        $request->validate([
            'company_name' => 'required|string|max:20|min:4',
            'industry' => 'required|string|max:20|min:4',
            'location' => 'required|string|max:20|min:4',
            'number_of_employees' => 'required|max:20|min:4',
            'representative' => 'required|string|max:20|min:4',
            'year_of_establishment' => 'required|max:20|min:2',
            'listed_year' => 'required|max:20|min:2',
            'average_annual_income' => 'required|max:20|min:2',
            'average_age' => 'required|max:20|min:2',
        ]);

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
