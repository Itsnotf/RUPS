<?php

namespace App\Http\Controllers;

use App\Models\departement;
use App\Models\kompartement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = departement::with('kompartement')->get();
            return DataTables::of($query)
            ->addColumn('kompartment', function ($row) {
                return $row->kompartement->nama;
            })
            ->make();
        }
        return view('pages.departement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kompartements = kompartement::get();
        return view('pages.departement.create',compact('kompartements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_Kompartement' => 'required',
            'nama' => 'required',
            'desk' => 'required',
        ]);

        $data = [
            'id_Kompartement' =>  $request->id_Kompartement,
            'nama' => $request->nama,
            'desk' => $request->desk,
        ];

        departement::create($data);
        return redirect('department')->with('toast', 'showToast("Data berhasil disimpan")');
    }


    /**
     * Display the specified resource.
     */
    public function show(departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = departement::find($id);
        $kompartements = kompartement::get();
        return view('pages.departement.edit',compact('item','kompartements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = departement::findOrFail($id);

        $request->validate([
            'id_Kompartement' => 'required',
            'nama' => 'required',
            'desk' => 'required',
        ]);

        $data = [
            'id_Kompartement' =>  $request->id_Kompartement,
            'nama' => $request->nama,
            'desk' => $request->desk,
        ];
        $department->update($data);

        return redirect('department')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = departement::findOrFail($id);
        $department->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
