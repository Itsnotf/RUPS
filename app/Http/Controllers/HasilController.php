<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Hasil::with('user', 'arahan.kompartement');

            if (!in_array(auth()->user()->role, ['superadmin', 'admin'])) {
                $query->whereHas('arahan.kompartement', function ($query) {
                    $query->where('nama', auth()->user()->Kompartement->nama);
                });
            }

            $results = $query->get();

            return DataTables::of($results)
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('arahan', function($row) {
                    return $row->arahan->desk;
                })
                ->addColumn('file', function($row) {
                    return '<a class="btn btn-primary" href="'.asset('storage/'.$row->arahan->file).'" target="_blank">Lihat File</a>';
                })
                ->rawColumns(['file', 'aksi'])
                ->make();
        }

        return view('pages.hasil.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Hasil::find($id);
        return view('pages.hasil.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hasil = Hasil::findOrFail($id);
        $tahap = '';


        $request->validate([
            'Bukti' => 'required|max:2048|mimes:jpg,jpeg,png,gif',
            'desk' => 'required',
        ]);

        if($hasil->tahap == 'awal'){
            $tahap = 'Approval 1';
        }else{
            $tahap = $hasil->tahap;
        }

        $data = [
            'id_user' => auth()->user()->id,
            'desk' => $request->desk,
            'status' => 'Dalam proses',
            'tahap' => $tahap,
        ];

        if($hasil->Bukti === 'Belum ada'){
            if ($request->hasFile('Bukti')) {
                $data['Bukti'] = $request->file('Bukti')->store('Bukti', 'public');
            }
        }else{
            if ($request->hasFile('Bukti') && $request->file('Bukti')->isValid()) {
                $path = "Bukti/";
                $oldfile = $path . basename($hasil->Bukti);
                Storage::disk('public')->delete($oldfile);
                $data['Bukti'] = Storage::disk('public')->put($path, $request->file('Bukti'));
            }
        }


        $hasil->update($data);

        return redirect('hasil')->with('toast', 'showToast("Data berhasil diupdate")');
    }


    public function review(string $id)
    {
        $item = Hasil::find($id);
        return view('pages.hasil.review',compact('item'));
    }


    public function next(Request $request, string $id)
    {


    $request->validate([
        'status' => 'required',
        'keterangan' => 'required',
    ]);

    $hasil = Hasil::findOrFail($id);


    $tahap = '';
    $status = '';

    if (auth()->check()) {
        $userJabatan = auth()->user()->Jabatan->nama;

        switch ($userJabatan) {
            case 'Vice President Department':
                if($request->status == 'Revisi'){
                    $tahap = 'Approval 1';
                }else{
                    $tahap = 'Approval 2';
                }
                break;
            case 'Senior Vice President Department':
                if($request->status == 'Revisi'){
                    $tahap = 'Approval 2';
                }else{
                    $tahap = 'Reviewer 1';
                }
                break;
            case 'Staff Monitoring Eval':
                if($request->status == 'Revisi'){
                    $tahap = 'Reviewer 1';
                }else{
                    $tahap = 'Reviewer 2';
                }
                break;
            case 'Senior Auditor':
                if($request->status == 'Revisi'){
                    $tahap = 'Reviewer 2';
                }else{
                    $tahap = 'Reviewer 3';
                }
                break;
            case 'Pengendali Teknis':
                if($request->status == 'Revisi'){
                    $tahap = 'Reviewer 3';
                }else{
                    $tahap = 'Reviewer 4';
                }
                break;
            case 'Vice President':
                if($request->status == 'Revisi'){
                    $tahap = 'Reviewer 4';
                }else{
                    $tahap = 'Reviewer 5';
                }
                break;
            case 'Senior Vice President':
                if($request->status == 'Revisi'){
                    $tahap = 'Reviewer 5';
                }else{
                    $tahap = 'Selesai';
                    $status = "Sudah sesuai";
                }
                break;
            default:
                $tahap = 'Unknown';
                break;
        }
    }

    if($status === ''){
       $status =  $request->status;
    }

    $data = [
        'status' => $status,
        'keterangan' => $request->keterangan,
        'tahap' => $tahap
    ];

    $hasil->update($data);

    return redirect('hasil')->with('toast', 'showToast("Data berhasil diupdate")');
}







    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $department = departement::findOrFail($id);
    //     $department->delete();

    //     return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    // }
}
