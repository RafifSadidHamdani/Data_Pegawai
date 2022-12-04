<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Job::paginate('5');
        $data = DB::table('jobs')
        ->whereNull('deleted_at')
        ->paginate(4);
        return view('datajob', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambahjob');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = Job::create($request->all());
        DB::insert('INSERT INTO jobs(id,nama,gaji) VALUES (:id, :nama, :gaji)',
        [
            'id' => $request->id,
            'nama' => $request->nama,
            'gaji' => $request->gaji,
        ]
        );
        return redirect()->route('datajob');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function tampilkandatajob($id){
        // $data = Job::find($id);
        $data = DB::table('jobs')->where('jobs.id', $id)->first();
        return view('tampildatajob', compact('data'));
    }

    public function updatedatajob(Request $request, $id){
        $this->validate($request,[
            'nama' => 'required|min:1|max:25',
        ]);

        // $data = Job::find($id);
        // $data->update($request->all());
        $data = array();
        $data['nama'] = $request->nama;
        $data['gaji'] = $request->gaji;
        DB::table('jobs')->where('jobs.id', $id)->update($data);
        return redirect()->route('datajob')->with('success','Data Berhasil di Update');
    }

    public function deletejob($id){
        // $data = Job::find($id);
        // $data->delete();
        DB::update('UPDATE jobs SET deleted_at = NOW() WHERE id = :id', ['id' => $id]);
        return redirect()->route('datajob')->with('success','Data Berhasil di Hapus');
    }

    public function softjob(){
        // $data = Job::onlyTrashed()->get();
        $data = DB::table('jobs')
                    ->whereNotNull('deleted_at')
                    ->paginate(5);
        return view('softjob', compact('data'));
    }

    public function restorejob($id){
        // $data = Job::withTrashed()->find($id)->restore();
        DB::update('UPDATE jobs SET deleted_at = NULL WHERE id = :id', ['id' => $id]);
        return redirect()->route('softjob')->with('success','Data Berhasil di Restore');
    }

    public function permjob($id)
    {
    	// $data = Job::onlyTrashed()->where('id',$id);
    	// $data->forceDelete();
        DB::delete('DELETE FROM jobs WHERE id=:id', ['id' => $id]);
    	return redirect('/softjob');
    }
}
