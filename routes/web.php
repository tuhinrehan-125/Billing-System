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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/',function(){
// return view('auth.login');
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');



Route::group(['admin' => 'auth'], function () {
    // category api router
    Route::get('category', 'CategoryController@data')->name('category');
    Route::post('category-store', 'CategoryController@store')->name('category.store');
    Route::get('category-edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('category-update', 'CategoryController@update')->name('category.update');
    Route::get('category-delete/{id}', 'CategoryController@SoftDelete')->name('category.delete');
    //sub category api router
    Route::get('sub-category', 'SubCategoryController@data')->name('subcategory');
    //  Route::get('sub-category', 'SubCategoryController@category');
    Route::post('sub-category-store', 'SubCategoryController@store')->name('subcategory.store');
    Route::get('sub-category-edit/{id}', 'SubCategoryController@edit')->name('subcategory.edit');
    Route::post('sub-category-update', 'SubCategoryController@update')->name('subcategory.update');
    Route::get('sub-category-delete/{id}', 'SubCategoryController@SoftDelete')->name('subcategory.delete');

    Route::get('employees', 'EmployeeController@data')->name('employee');
    Route::post('employee-store', 'EmployeeController@store')->name('employee.store');
    Route::get('employee-edit/{id}', 'EmployeeController@edit')->name('employee.edit');
    Route::post('employee-update', 'EmployeeController@update')->name('employee.update');
    Route::get('employee-delete/{id}', 'EmployeeController@SoftDelete')->name('employee.delete');

    Route::get('projects', 'Projectcontroller@data')->name('project');
    Route::post('project-store', 'ProjectController@store')->name('project.store');
    Route::get('project-edit/{id}', 'ProjectController@edit')->name('project.edit');
    Route::post('project-update', 'ProjectController@update')->name('project.update');
    Route::get('project-delete/{id}', 'ProjectController@SoftDelete')->name('project.delete');

    Route::get('note-sheet', 'ExpenseController@data')->name('note.sheet');
    Route::get('note-sheet-create', 'ExpenseController@Create')->name('note.sheet.create');
    Route::post('note-sheet-store', 'ExpenseController@store')->name('note.sheet.store');
    Route::get('note-sheet-edit/{id}', 'ExpenseController@edit')->name('note.sheet.edit');
    Route::post('note-sheet-update', 'ExpenseController@update')->name('note.sheet.update');
    Route::get('note-sheet-delete/{id}', 'ExpenseController@SoftDelete')->name('note.sheet.delete');
    Route::get('note-sheet-details-delete/{id}', 'ExpenseController@SoftDeleteExDe')->name('note.sheet.details.delete');

    Route::get('pendding-expense', 'ExpenseController@penddingData')->name('processing.expense');
    Route::get('pendding-details/{id}', 'ExpenseController@penddingDetails')->name('pendding.expanse.details');

    Route::post('accept-expense/{id}', 'ExpenseController@acceptExpense')->name('accept.expense');
    Route::post('cancel-expense/{id}', 'ExpenseController@cancelExpense')->name('cancel.expense');
    Route::get('accept-expense', 'ExpenseController@approveExpense')->name('approve.expense');
    Route::get('expanse-invoice/{id}', 'ExpenseController@printExpanse')->name('print.expense');

    // for payment
    Route::get('payment-expense', 'ExpenseController@paymentExpense')->name('payment.expense');
    Route::get('payment-edit/{id}', 'EmployeeController@payEdit')->name('payment.edit');
    Route::post('payment-clear', 'ExpenseController@paymentCashStore')->name('paymentCash.store');


    Route::get('profile', 'UserController@Profile')->name('user.profile');
    Route::post('profile-update', 'UserController@ProfileUpdate')->name('user.update');
    Route::post('profile-password-change', 'UserController@ProfilePasswordUpdate')->name('user.passupdate');

    //user management system
    Route::get('admin-user', 'AdminManagementController@admin')->name('admin-user');
    Route::get('admin-user-data', 'AdminManagementController@adminajax')->name('admin-user-ajax');
    Route::post('admin-user-store', 'AdminManagementController@adminStore')->name('admin-user-store');
    Route::post('admin-user-update', 'AdminManagementController@adminUpdate')->name('admin-user-update');
    Route::get('admin-user-delete/{id}', 'AdminManagementController@adminDelete')->name('admin.delete');
    Route::get('admin-user-active/{id}', 'AdminManagementController@adminActive')->name('admin.active');
    Route::get('admin-user-find', 'AdminManagementController@adminFind')->name('admin-user-find');

    Route::get('income', 'IncomeController@data')->name('income');
    Route::get('income-create', 'IncomeController@Create')->name('income.create');
    Route::get('income-project/{id}', 'IncomeController@dataProject')->name('income.project');
    Route::post('income-store', 'IncomeController@store')->name('income.store');
    Route::get('income-edit/{id}', 'IncomeController@edit')->name('income.edit');
    Route::post('income-update', 'IncomeController@update')->name('income.update');
    Route::get('income-delete/{id}', 'IncomeController@SoftDelete')->name('income.delete');
});
