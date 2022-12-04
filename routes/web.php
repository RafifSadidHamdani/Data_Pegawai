<?php

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\DepartmentController;

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

Route::get('/', function () {

    // $jumlahpegawai = Employee::count();
    // $jumlahpegawailaki = Employee::where('jeniskelamin', 'laki-laki')->count();
    // $jumlahpegawaiperempuan = Employee::where('jeniskelamin', 'perempuan')->count();
    // $jumlahpegawai = DB::select('SELECT COUNT(id) FROM employees');
    // $jumlahpegawailaki = DB::select('SELECT COUNT(id) FROM employees');
    // $jumlahpegawaiperempuan = DB::select('SELECT COUNT(id) FROM employees');
    // return view('welcome', compact('jumlahpegawai', 'jumlahpegawailaki', 'jumlahpegawaiperempuan'));
    return view('welcome');
})->middleware('auth');

Route::get('/pegawai',[EmployeeController::class, 'index'])->name('pegawai')->middleware('auth');

Route::get('/tambahpegawai',[EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata',[EmployeeController::class, 'insertdata'])->name('insertdata');
Route::get('/tampilkandata/{id}',[EmployeeController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}',[EmployeeController::class, 'updatedata'])->name('updatedata');
Route::get('/delete/{id}',[EmployeeController::class, 'delete'])->name('delete');
Route::get('/soft',[EmployeeController::class, 'soft'])->name('soft');
Route::get('/restore/{id}',[EmployeeController::class, 'restore'])->name('restore');
Route::get('/perm/{id}', [EmployeeController::class, 'perm']);

Route::get('/exportpdf',[EmployeeController::class, 'exportpdf'])->name('exportpdf');

Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/loginuser',[LoginController::class, 'loginuser'])->name('loginuser');

Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/registeruser',[LoginController::class, 'registeruser'])->name('registeruser');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');


Route::get('/datareligion',[ReligionController::class, 'index'])->name('datareligion')->middleware('auth');
Route::get('/tambahreligion',[ReligionController::class, 'create'])->name('tambahreligion');
Route::post('/insertdatareligion',[ReligionController::class, 'store'])->name('insertdata');


Route::get('/datadepartment',[DepartmentController::class, 'index'])->name('datadepartment')->middleware('auth');
Route::get('/tambahdepartment',[DepartmentController::class, 'create'])->name('tambahdepartment');
Route::post('/insertdatadepartment',[DepartmentController::class, 'store'])->name('insertdatadepartment');


Route::get('/datajob',[JobController::class, 'index'])->name('datajob')->middleware('auth');
Route::get('/tambahjob',[JobController::class, 'create'])->name('tambahjob');
Route::post('/insertdatajob',[JobController::class, 'store'])->name('insertdatajob');
Route::get('/tampilkandatajob/{id}',[JobController::class, 'tampilkandatajob'])->name('tampilkandatajob');
Route::post('/updatedatajob/{id}',[JobController::class, 'updatedatajob'])->name('updatedatajob');
Route::get('/deletejob/{id}',[JobController::class, 'deletejob'])->name('deletejob');
Route::get('/softjob',[JobController::class, 'softjob'])->name('softjob');
Route::get('/restorejob/{id}',[JobController::class, 'restorejob'])->name('restorejob');
Route::get('/permjob/{id}', [JobController::class, 'permjob']);


