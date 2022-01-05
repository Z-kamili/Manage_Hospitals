<?php

use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\doctor\InvoiceController;
use App\Http\Controllers\RayController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| doctor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    //################################ dashboard doctor ########################################

    Route::get('/dashboard/doctor', function () {
        return view('Dashboard.doctor.dashboard');
    })->middleware(['auth:doctor'])->name('dashboard.admin');

    //################################ end dashboard doctor #####################################

//---------------------------------------------------------------------------------------------------------------


    Route::middleware(['auth:doctor'])->group(function () {

        Route::prefix('doctor')->group(function () {

               //############################# invoices route ##########################################
                   Route::resource('invoices', InvoiceController::class);
              //############################# end invoices route ######################################

               //############################# Diagnostics route ##########################################
                   Route::resource('Diagnostics', DiagnosticController::class);
               //############################# end Diagnostics route ######################################

               //############################# completed_invoices route ##########################################
                   Route::get('completed_invoices', [InvoiceController::class,'completedInvoices'])->name('completedInvoices');
              //############################# end invoices route ################################################

              //############################# review_invoices route ##########################################
                   Route::get('review_invoices', [InvoiceController::class,'reviewInvoices'])->name('reviewInvoices');
            //############################# end invoices route #############################################

            //############################# review_invoices route ##########################################
                   Route::post('add_review', [DiagnosticController::class,'addReview'])->name('add_review');
               //############################# end invoices route #############################################

               Route::resource('rays', RayController::class);


            //############################# rays route ##########################################

            Route::get('patient_details/{id}', [PatientDetailsController::class,'index'])->name('patient_details');

            //############################# end rays route ######################################

            //############################# Laboratories route ##########################################

            Route::resource('Laboratories', LaboratorieController::class);

            //############################# end Laboratories route ######################################
   
        });
    });
    require __DIR__ . '/auth.php';


});