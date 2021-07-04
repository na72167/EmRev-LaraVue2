<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Employee_review;
use App\CompanyInformation;
class postReviewController extends Controller
{
    //レビュー検索用アクション
    protected function serchRegistCompany(Request $request){
        //ユーザーのログイン状況を確認。
        log::debug('ログインの確認をします。');
        if(!Auth::check()){
            //セッション内処理に「ログインしてください」と入力する。
            //ログインしていなかった場合ルーティング内のname(‘login’)を通してログインページに返す処理を走らせる。
            return redirect('home');
        }

        //検索フォームから送信された内容をRequestインスタンスから取得・where文内の条件に設定。
        $EmployeeReview = CompanyInformation::all()->where($request->company_name,$request->representative,$request->location,$request->industry,
        $request->year_of_establishment,$request->listed_year,$request->number_of_employees,$request->average_annual_income,$request->average_age,$request->number_of_reviews);
        //レビュー数のカウント
        $ReviewCount = CompanyInformation::all()->where($request->company_name,$request->representative,$request->location,$request->industry,
        $request->year_of_establishment,$request->listed_year,$request->number_of_employees,$request->average_annual_income,$request->average_age,$request->number_of_reviews)->count();

        log::debug('検索結果が存在するか確認します。');

        if(isset($searchResult)){

            // 存在した場合
            log::debug('検索結果があります。');
            //フラッシュメッセージ内に「検索結果は〇〇件です。」
            //と表示させる。
            //ここのリターンの型はリスト表示用のアクション「showRegistCompany」と合わせる。
            return view('review.reviewRegister-cList',['EmployeeReview' => $EmployeeReview,'ReviewCount' => $ReviewCount]);

            }elseif(!isset($searchResult)){
            log::debug('検索結果があります。');
            //空だった場合
            //フラッシュメッセージ内に「検索結果がありませんでした」
            //と表示させる。
            return redirect('reviewRegister-cList');
        }
    }

    //登録済み会社を一覧表示させるアクション(初期表示)
    protected function showRegistCompany(){
        //ユーザーのログイン状況を確認。
        log::debug('ログインの確認をします。');
        if(!Auth::check()){
            //セッション内処理に「ログインしてください」と入力する。
            //ログインしていなかった場合ルーティング内のname(‘login’)を通してログインページに返す処理を走らせる。
            return redirect('home');
        }

        log::debug('会社情報を取得する。');
        // DBからレビューとユーザー情報を取得
        $EmployeeReview = Employee_review::all()->Employee_id()->get('employee_id', 'review_company_id', 'joining_route', 'occupation', 'position',
        'enrollment_period', 'enrollment_status', 'employment_status', 'welfare_office_environment',
        'working_hours', 'holiday', 'in_company_system', 'corporate_culture', 'ease_of_work_for_women',
        'rewarding_work', 'image_gap', 'business_outlook', 'strengths_and_weaknesses', 'annual_income_salary',
        'general_estimation_title', 'general_estimation', 'username', 'like_count', 'delete_flg');

        //レビュー数のカウント
        $ReviewCount = Employee_review::all()->count();

        //第二引数に配列を持たせるとview側に変数を渡せる。
        return redirect('review.reviewRegister-cList',['EmployeeReview' => $EmployeeReview,'ReviewCount' => $ReviewCount]);
    }

    //レビュー投稿ページ(入社経路)に関する関するアクション
    //Jrは「Join Route(入社経路)」の略。
    protected function companyRegistJr(Request $request){
        //ユーザーのログイン状況を確認。
        log::debug('ログインユーザーのID情報を取得します。');
        if(!Auth::check()){
            //セッション内処理に「ログインしてください」と入力する。
            //ログインしていなかった場合ルーティング内のname(‘login’)を通してログインページに返す処理を走らせる。
            return redirect('home');
        }

        // プロフィール編集ページ内でキャンセル・変更どちらを押したかを$requestの各name属性を確認。処理の分岐を行う。
        if ($request->get('cancel-button')){
            log::debug('レビュー対象会社を再選択します。');
            //セッション情報を破棄。
            session()->flush();
            //フラッシュ用セッションに「プロフィールの変更をキャンセルしました」と記入する。
            return redirect('reviewRegister-cList');
        }elseif ($request->get('update-button')){
            log::debug('送信情報のバリテーションを開始します。');
            //バリテーション
            $request->validate([
                'joining_route' => 'nullable|max:255',
                'occupation' => 'nullable|max:255',
                'position' => 'nullable|max:255',
                'enrollment_period' => 'nullable|max:255',
                'enrollment_status' => 'nullable|max:255',
                'employment_status' => 'nullable|max:255',
                'welfare_office_environment' => 'nullable|max:255',
                'working_hours' => 'nullable|max:255',
                'in_company_system' => 'nullable|max:255',
                'corporate_culture' => 'nullable|max:255',
                'holiday' => 'nullable|max:255',
                'organizational_structure' => 'nullable|max:255',
                'ease_of_work_for_women' => 'nullable|max:255',
                'image_gap' => 'nullable|max:255',
                'rewarding_work' => 'nullable|max:255',
                'strengths_and_weaknesses' => 'nullable|max:255',
                'annual_income_salary' => 'nullable|max:255',
                'business_outlook' => 'nullable|max:255',
                'general_estimation_title' => 'nullable|max:255',
                'general_estimation' => 'nullable|max:255',
            ]);

            log::debug('ユーザー登録を開始します。');
            // 一旦セッション内にユーザーが入力した情報を保持させる。
            //リクエストインスタンス内に各送信フォームのname属性も抱き合わせられているかどうかを確認。
            session(['age' => $request->age,'tel' => $request->tel,'profImg' => $request->profImg,'zip' => $request->zip,'addr' => $request->addr]);
            return view('/review/reviewRegister-cc');
        }
    }

    //レビュー投稿ページ(社内制度や企業文化について)に関する関するアクション
    //Ccは「CompanySystem CorporateCulture(社内制度や企業文化について)」の略。
    protected function companyRegistCc(Request $request){
        //ユーザーのログイン状況を確認。
        log::debug('ログインユーザーのID情報を取得します。');
        if(!Auth::check()){
            //セッション内処理に「ログインしてください」と入力する。
            //ログインしていなかった場合ルーティング内のname(‘login’)を通してログインページに返す処理を走らせる。
            return redirect('home');
        }

        // プロフィール編集ページ内でキャンセル・変更どちらを押したかを$requestの各name属性を確認。処理の分岐を行う。
        if ($request->get('cancel-button')){
            log::debug('レビュー対象会社を再選択します。');
            //セッション情報を破棄。
            session()->flush();
            //フラッシュ用セッションに「プロフィールの変更をキャンセルしました」と記入する。
            return redirect('reviewRegister-cList');
        }elseif ($request->get('update-button')){
            log::debug('送信情報のバリテーションを開始します。');
            //バリテーション
            $request->validate([
                'age' => 'integer|nullable|max:255',
                'tel' => 'integer|nullable|max:255',
                'profImg' => 'nullable|max:255',
                'zip' => 'integer|nullable|max:255',
                'addr' => 'nullable|max:255',
            ]);

            log::debug('ユーザー登録を開始します。');
            // 一旦セッション内にユーザーが入力した情報を保持させる。
            //リクエストインスタンス内に各送信フォームのname属性も抱き合わせられているかどうかを確認。
            session(['age' => $request->age,'tel' => $request->tel,'profImg' => $request->profImg,'zip' => $request->zip,'addr' => $request->addr]);
            return view('/review/reviewRegister-cc');
        }
    }

}
