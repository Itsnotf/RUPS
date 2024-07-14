<?php

namespace App\Http\Controllers;

use App\Models\kompartement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KompartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = kompartement::get();
            return DataTables::of($query)
            ->make();
        }
        return view('pages.kompartement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kompartement.create');
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

        kompartement::create($data);
        return redirect('kompartement')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(kompartement $kompartement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = kompartement::findOrFail($id);
        return view('pages.kompartement.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kompartement = kompartement::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'desk' => $request->desk,
        ];

        $kompartement->update($data);

        return redirect('kompartement')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kompartement = kompartement::findOrFail($id);
        $kompartement->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
