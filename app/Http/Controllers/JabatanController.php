<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Jabatan::get();
            return DataTables::of($query)
            ->make();
        }
        return view('pages.jabatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'desk' => $request->desk,
        ];

        Jabatan::create($data);
        return redirect('jabatan')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Jabatan::findOrFail($id);
        return view('pages.jabatan.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'desk' => $request->desk,
        ];

        $jabatan->update($data);

        return redirect('jabatan')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
