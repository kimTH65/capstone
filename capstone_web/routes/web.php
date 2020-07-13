<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*메인 페이지*/
Route::get('/','HomeController@index');
Route::get('/logout','HomeController@logout');
Route::post('/signup','HomeController@signup');
Route::post('/','HomeController@login');
Route::post('/message','HomeController@message'); // 메시지 보내기
Route::get('/message_Status','HomeController@message_Status'); // 메시지 보기

/*나만의 연락처*/
Route::any('/action_upload','UserimageController@action_upload');
Route::any('/toolPage','UserimageController@toolPage');
Route::any('/searchDir','UserimageController@searchDir');

/*무료 템플릿*/
Route::get('/TemplatePage','TemplateTableController@TemplatePage');
Route::any('/template_page/TemplatePage_1','TemplateTableController@TemplatePage_1'); // 무료 템플릿 텍스트1
Route::any('/template_page/TemplatePage_Image1','TemplateTableController@TemplatePage_Image1'); // 무료 템플릿 이미지1
Route::any('/template_page/TemplatePage_upload','TemplateTableController@TemplatePage_upload'); // 무료템 템플릿 텍스트1 업로드
Route::any('/template_page/TemplatePage_image_upload','TemplateTableController@TemplatePage_image_upload'); // 무료 템플렛 이미지1 업로드


/* 내 템플릿 */
Route::any('/MyTemplate','RepreImgController@MyTemplate');
Route::any('/MyTemplate_process','RepreImgController@MyTemplate_process');
Route::any('/template_page/myTemplate1','RepreImgController@myTemplate1'); // 무료 템플릿 텍스트 1
Route::any('/template_page/myTemplate2','RepreImgController@myTemplate2'); // 무료 템플릿 이미지 1
Route::any('/template_page/repre_template','RepreImgController@repre_template'); // 대표 템플릿으로 가기 위한 설정
Route::any('/template_page/repre_base','RepreImgController@repre_base'); // base 템플릿

/* 커뮤니티 게시판 */
Route::any('/board','BoardController@board');
Route::any('/write','BoardController@write');
Route::any('/write_ok','BoardController@write_ok');
//Route::any('read','BoardController@read');
Route::get('/read/{page}', 'BoardController@read')->name('read'); // 글 읽기
Route::get('/update/{page}', 'BoardController@update')->name('update'); // 글 수정
Route::any('/comment_process','BoardController@comment_process'); // 댓글 작성
Route::get('/delete/{page}', 'BoardController@delete')->name('delete'); // 게시글 삭제
Route::get('/co_delete/{reply}', 'BoardController@co_delete')->name('co_delete'); // 댓글 삭제
Route::post('/update_process', 'BoardController@update_process'); // 게시글 수정


/* 문의 게시판 */
Route::any('/question_board','QuestionBoardController@question_board'); // 메인
Route::any('/question_write','QuestionBoardController@question_write'); // 글쓰기
Route::any('/question_write_ok','QuestionBoardController@question_write_ok');

Route::get('/question_read/{q_page}', 'QuestionBoardController@question_read')->name('question_read'); // 글 읽기
Route::get('/question_update/{q_page}', 'QuestionBoardController@question_update')->name('question_update'); // 글 수정
Route::post('/question_update_process', 'QuestionBoardController@question_update_process'); // 게시글 수정
Route::get('/question_delete/{q_page}', 'QuestionBoardController@question_delete')->name('question_delete'); // 게시글 삭제

Route::any('/q_comment_process','QuestionBoardController@q_comment_process'); // 댓글 작성
Route::get('/q_co_delete/{q_reply}', 'QuestionBoardController@q_co_delete')->name('q_co_delete'); // 댓글 삭제

/* 디자인 요청 게시판 */

Route::any('/design_board','DesignBoardController@design_board'); // 메인
Route::any('/design_write','DesignBoardController@design_write'); // 글쓰기
Route::any('/design_write_process','DesignBoardController@design_write_process'); // 글쓰기
Route::get('/design_read/{d_page}', 'DesignBoardController@design_read')->name('design_read'); // 글읽기
Route::get('/design_delete/{d_page}', 'DesignBoardController@design_delete')->name('design_delete'); // 게시글 삭제


Route::any('/design_form', 'DesignBoardController@design_form'); // 디자인 요청

Route::any('/design_Status', 'DesignBoardController@design_Status'); // 디자인 요청 현황

Route::any('/design_form_process', 'DesignBoardController@design_form_process'); // 디자인 요청 처리

//------new
Route::any('/design_vector','DesignBoardController@design_vector')->name('design_vector'); // 디자인 백터값 처리
