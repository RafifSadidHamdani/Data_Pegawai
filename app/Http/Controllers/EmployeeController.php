<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Job;
use App\Models\Employee;
use App\Models\Religion;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            // $data = Employee::where('nama','LIKE','%'.$request->search.'%')->paginate(5);
            $data = DB::table('employees')
            ->join('religions', 'employees.id_religions', 'religions.id')
            ->join('departments', 'employees.id_departments', 'departments.id')
            ->join('jobs', 'employees.id_jobs', 'jobs.id')
            ->select('employees.*' ,'religions.nama as namar', 'departments.nama as namad', 'jobs.nama as namaj')
            ->where('employees.nama', 'LIKE', '%'.$request->search.'%')
            ->orderBy('id', 'asc')
            ->whereNull('employees.deleted_at')
            ->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }else{
            // $data = Employee::paginate(5);;
            $data = DB::table('employees')
            ->join('religions', 'employees.id_religions', 'religions.id')
            ->join('departments', 'employees.id_departments', 'departments.id')
            ->join('jobs', 'employees.id_jobs', 'jobs.id')
            ->select('employees.*','religions.nama as namar', 'departments.nama as namad', 'jobs.nama as namaj')
            ->orderBy('id', 'asc')
            ->whereNull('employees.deleted_at')
            ->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }

        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai(){
        // $data = Employee::all();
        // $dataagama = Religion::all();
        // $datadepartment = Department::all();
        // $datajob = Job::all();
        $data = DB::select('select * from employees');
        $dataagama = DB::select('select * from religions');
        $datadepartment = DB::select('select * from departments');
        $datajob = DB::select('select * from jobs');
        return view('tambahdata', compact('dataagama', 'datadepartment', 'datajob'));
    }

    public function insertdata(Request $request){
        $this->validate($request,[
            'nama' => 'required|min:1|max:25',
            'notelpon' => 'required|min:5|max:12',
        ]);

        // $data = Employee::create($request->all());
        $data = array();
        $data['nama'] = $request->nama;
        $data['jeniskelamin'] = $request->jeniskelamin;
        $data['notelpon'] = $request->notelpon;
        $data['id_religions'] = $request->id_religions;
        $data['tanggal_lahir'] = $request->tanggal_lahir;
        $data['id_departments'] = $request->id_departments;
        $data['id_jobs'] = $request->id_jobs;
        DB::table('employees')->insert($data);
        if(session('halaman_url')){
            return redirect(session('halaman_url'));
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil di Tambahkan');
    }

    public function tampilkandata($id){
        // $data = Employee::find($id);
        // $dataagama = Religion::all();
        // $datadepartment = Department::all();
        // $datajob = Job::all();
        $data = DB::table('employees')->where('employees.id', $id)->first();
        $dataagama = DB::select('select * from religions');
        $datadepartment = DB::select('select * from departments');
        $datajob = DB::select('select * from jobs');
        return view('tampildata', compact('data', 'dataagama', 'datadepartment', 'datajob'));
    }

    public function updatedata(Request $request, $id){
        $this->validate($request,[
            'nama' => 'required|min:1|max:25',
            'notelpon' => 'required|min:5|max:12',
        ]);

        // $data = Employee::find($id);
        $data = array();
        $data['nama'] = $request->nama;
        $data['jeniskelamin'] = $request->jeniskelamin;
        $data['notelpon'] = $request->notelpon;
        $data['id_religions'] = $request->id_religions;
        $data['tanggal_lahir'] = $request->tanggal_lahir;
        $data['id_departments'] = $request->id_departments;
        $data['id_jobs'] = $request->id_jobs;
        // $data->update($request->select('select * from employees'));
        DB::table('employees')->where('employees.id', $id)->update($data);
        if(session('halaman_url')){
            return redirect(session('halaman_url'));
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil di Update');
    }

    public function delete($id){
        // $data = Employee::find($id);
        // $data->delete();
        DB::update('UPDATE employees SET deleted_at = NOW() WHERE id = :id', ['id' => $id]);
        if(session('halaman_url')){
            return redirect(session('halaman_url'));
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil di Hapus');
    }

    public function soft(){
        // $data = Employee::onlyTrashed()->get();
        $data = DB::table('employees')
                    ->whereNotNull('employees.deleted_at')
                    ->join('religions', 'employees.id_religions', 'religions.id')
                    ->join('departments', 'employees.id_departments', 'departments.id')
                    ->join('jobs', 'employees.id_jobs', 'jobs.id')
                    ->select('employees.*','religions.nama as namar', 'departments.nama as namad', 'jobs.nama as namaj')
                    ->orderBy('id', 'asc')
                    ->paginate(5);
        return view('soft', compact('data'));
    }

    public function restore($id){
        // Employee::withTrashed()->find($id)->restore();
        DB::update('UPDATE employees SET deleted_at = NULL WHERE id = :id', ['id' => $id]);
        return redirect()->route('soft')->with('success','Data Berhasil di Restore');
    }

    public function perm($id)
    {
    	// $data = Employee::onlyTrashed()->where('id',$id);
    	// $data->forceDelete();
        DB::delete('DELETE FROM employees WHERE id=:id', ['id' => $id]);
    	return redirect('/soft');
    }

    // public function exportpdf(){
    //     $data = Employee::all();
    //     view()->share('data', $data);
    //     $pdf = PDF::loadview('datapegawai-pdf');
    //     return $pdf->download('data.pdf');
    // }
}
