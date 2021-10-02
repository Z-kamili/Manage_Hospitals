<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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



Route::get('/Dashboard_Admin',[DashboardController::class,'index']);


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 

        //################################ Dashboard user #########################################

        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(['auth:web'])->name('dashboard.user');
        
         //################################ end Dashboard user #########################################

         //################################ Dashboard admin #########################################

        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin'])->name('dashboard.admin');
        
         //################################ end  Dashboard admin #########################################
        


//-----------------------------------------------------------------------------------------------------------

        Route::middleware(['auth:admin'])->group(function(){

        //############################ sections route ####################################################
        
        Route::resource('Sections',SectionController::class);

        //############################ end sections route ################################################

        //############################# Doctors route ##########################################

        Route::resource('Doctors','App\Http\Controllers\Dashboard\DoctoreController');
        Route::post('update_password', ['App\Http\Controllers\Dashboard\DoctoreController', 'update_password'])->name('update_password');
        Route::post('update_status', ['App\Http\Controllers\Dashboard\DoctoreController', 'update_status'])->name('update_status');

       //############################# end Doctors route ######################################

        
        //############################# sections route ##########################################

        Route::resource('Service', 'App\Http\Controllers\Dashboard\SingleServiceController');

        //############################# end sections route ######################################



        });

         //############################# GroupServices route ##########################################

                Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');

         //############################# end GroupServices route ######################################

        //############################# insurance route ##########################################

        Route::resource('insurance', 'App\Http\Controllers\Dashboard\InsuranceController');

        //############################# end insurance route ######################################

        Route::resource('Ambulance', 'App\Http\Controllers\Dashboard\AmbulanceController');
            
        Route::resource('Patients', 'App\Http\Controllers\Dashboard\PatientController');

                //############################# single_invoices route ##########################################

                Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
                
                Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');

                //############################# end single_invoices route ######################################

                //############################# Receipt route ##########################################

                Route::resource('Receipt', 'App\Http\Controllers\Dashboard\ReceiptAccountController');

              //############################# end Receipt route ######################################

              //############################# Payment route ##########################################

                Route::resource('Payment','App\Http\Controllers\Dashboard\PaymentAccountController');

             //############################# end Payment route ######################################

         require __DIR__.'/auth.php';


    });


