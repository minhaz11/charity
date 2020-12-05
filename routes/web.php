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

Route::group(['namespace' => 'Frontend'], function(){
    Route::get('/', 'HomeController@index');
    Route::get('contact-us', 'ContactUsController@index');
    Route::post('save-contact-message', 'ContactUsController@saveContactMessage');
    Route::get('page/{slug}', 'FrontendPageController@show');
    Route::get('show/faqs', 'FaqController@show');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function(){

    // Dashboard
    Route::get('dashboard', 'AdminController@index');
    // Roles
    Route::get('roles', 'RoleController@index')->middleware(['permission:view_role']);
    Route::match(['get', 'post'], 'role/create', 'RoleController@create')->middleware(['permission:add_role']);
    Route::match(['get', 'post'], 'role/edit/{id}', 'RoleController@edit')->middleware(['permission:edit_role']);
    Route::get('role/delete/{id}', 'RoleController@delete')->middleware(['permission:delete_role']);

    // Users
    Route::get('users', 'UserController@index')->middleware(['permission:view_user']);
    Route::match(['get', 'post'], 'user/create', 'UserController@create')->middleware(['permission:add_user']);
    Route::match(['get', 'post'], 'user/edit/{id}', 'UserController@edit')->middleware(['permission:edit_user']);
    Route::get('user/delete/{id}', 'UserController@delete')->middleware(['permission:delete_user']);

    // Contact
    Route::get('contact-message', 'ContactMessageController@index');
    Route::get('contact/delete/{id}', 'ContactMessageController@deleteContact');

    // Pages
    Route::get('pages', 'PageController@index');
    Route::match(['get', 'post'], 'save-page', 'PageController@save');
    Route::match(['get', 'post'], 'update-page/{id}', 'PageController@update');
    Route::get('page/delete/{id}', 'PageController@delete');

    // FAQ
    Route::get('faqs', 'FaqController@index');
    Route::match(['get', 'post'], 'faq/save', 'FaqController@save');
    Route::match(['get', 'post'], 'faq/update/{id}', 'FaqController@update');
    Route::get('faq/delete/{id}', 'FaqController@delete');

    Route::match(['get', 'post'], 'company-details/save', 'CompanyDetailsController@save');

    // Store
    Route::get('stores', 'StoreController@index');
    Route::match(['get', 'post'], 'store/save-store', 'StoreController@save');

    // Banner
    Route::get('banner-image/activate/{id}', 'BannerController@activateBannerImage');
    Route::get('banner-image/delete/{id}', 'BannerController@deleteBannerImage');
    Route::match(['get', 'post'], 'banner-image', 'BannerController@bannerImage');

    //Donate
    Route::get('donated/all/', 'DonationController@allDonations')->name('donations');
    Route::get('donated/recieved/{id}', 'DonationController@markAsRecieved')->name('recieved');

    //campaigns
    Route::get('campaigns/all/', 'CampaignController@allCampaigns')->name('admin.campaigns');
    Route::post('campaigns/create/', 'CampaignController@create')->name('campaign.create');

});

Route::post('donate','SiteController@donateStore')->name('donate');
