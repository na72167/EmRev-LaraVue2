<?php

namespace Tests\Unit;

use App\Models\CompanyInformation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplyCompanyTest extends TestCase
{
  use RefreshDatabase;

  /**
   * @test
   */
  public function should_レビュー会社情報の申請()
  {
    $data = [
      'company_name' => '株式会社test',
      'industry' => '建築',
      // 'company_url' => '',
      // 'zip1' => '',
      // 'zip2' => '',
      // 'zip3' => '',
      'location' => '東京都板橋区',
      'number_of_employees' => '2000',
      'year_of_establishment' => '1990',
      'representative' => '山田太郎',
      'listed_year' => '1998',
      'average_annual_income' => '500',
      'average_age' => '32',
      'number_of_reviews' => '50',
    ];

    $response = $this->json('POST', route('applyCompany'),$data);
    $companyInformation = CompanyInformation::first();
    $this->assertEquals($data['company_name'], $companyInformation->company_name);

    $response->assertStatus(201);
  }
}
