<?php

namespace App\Http\Controllers;

use App\Models\Arahan;
use App\Models\Hasil;
use App\Models\kompartement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if ($request->ajax()) {
        // Initialize the base query with eager loading of relationships
        $query = Arahan::with('user', 'kompartement');

        // Check if the authenticated user is not a superadmin or admin
        if (!in_array(auth()->user()->role, ['superadmin', 'admin'])) {
            // Apply filter based on the user's Kompartement
            $query->whereHas('kompartement', function($q) {
                $q->where('nama', auth()->user()->Kompartement->nama);
            });
        }

        // Execute the query to get the results
        $results = $query->get();

        // Return the data formatted for DataTables
        return DataTables::of($results)
            ->addColumn('file', function($row) {
                return '<a class="btn btn-primary" href="'.asset('storage/'.$row->file).'" target="_blank">Lihat File</a>';
            })
            ->addColumn('user', function($row) {
                return $row->user->name;
            })
            ->addColumn('kompartement', function($row) {
                return $row->kompartement->nama;
            })
            ->rawColumns(['file'])
            ->make();
    }

    // Return the view for the index page
    return view('pages.arahan.index');
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kompartements = kompartement::get();
        return view('pages.arahan.create', compact('kompartements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_Kompartement' => 'required',
            'desk' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = [
            'id_user' => auth()->user()->id,
            'id_Kompartement' => $request->id_Kompartement,
            'desk' => $request->desk,

        ];

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('file', 'public');
        }

        Arahan::create($data);

        Hasil::create([
            'id_arahan' => Arahan::latest()->first()->id,
            'id_user' => auth()->user()->id,
            'desk' => 'Belum ada',
            'Bukti' =>  'Belum ada',
            'keterangan' =>  'Belum ada',
            'status' =>  'Belum ada',
            'tahap' =>  'awal'
        ]);

        return redirect('arahan')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(Arahan $arahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Arahan::find($id);
        $kompartements = kompartement::get();
        return view('pages.arahan.edit', compact('kompartements', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id )
    {
        $arahan = Arahan::find($id);
        $request->validate([
            'id_Kompartement' => 'required',
            'desk' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = [
            'id_user' => auth()->user()->id,
            'id_Kompartement' => $request->id_Kompartement,
            'desk' => $request->desk,

        ];

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $path = "file/";
            $oldfile = $path . basename($arahan->file);
            Storage::disk('public')->delete($oldfile);
            $data['file'] = Storage::disk('public')->put($path, $request->file('file'));
        }

        $arahan->update($data);

        return redirect('arahan')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $arahan = Arahan::findOrFail($id);
        $arahan->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
