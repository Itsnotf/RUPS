<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest\Store;
use App\Http\Requests\UserRequest\Update;
use App\Models\departement;
use App\Models\Jabatan;
use App\Models\kompartement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('Kompartement','Department','Jabatan')->whereNot('role', 'superadmin')->get();
            return DataTables::of($query)
            ->addColumn('Kompartement', function ($row){
                return $row->Kompartement->nama;
            })
            ->addColumn('Department', function ($row){
                return $row->Department->nama;
            })
            ->addColumn('Jabatan', function ($row){
                return $row->Jabatan->nama;
            })
            ->make();
        }

        return view('pages.user.index');
    }

    public function getDepartments($kompartement_id)
{
    $departments = Departement::where('id_Kompartement', $kompartement_id)->get();
    return response()->json($departments);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kompartements = kompartement::get();
        $departments = departement::get();
        $jabatans = Jabatan::get();
        return view('pages.user.create',compact('kompartements','departments','jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $data = [
            'id_Kompartement' => $request->id_Kompartement,
            'id_Department' => $request->id_Department,
            'id_Jabatan' => $request->id_Jabatan,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatar', 'public');
        }
        User::create($data);

        return redirect('user')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = User::findOrFail($id);
        $kompartements = Kompartement::get();
        $departments = Departement::get();
        $jabatans = Jabatan::get();

        return view('pages.user.edit', compact('item', 'kompartements', 'departments', 'jabatans'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'id_Kompartement' => $request->id_Kompartement,
            'id_Department' => $request->id_Department,
            'id_Jabatan' => $request->id_Jabatan,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'username' => $request->username,
        ];

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $path = "avatar/";
            $oldfile = $path . basename($user->avatar);
            Storage::disk('public')->delete($oldfile);
            $data['avatar'] = Storage::disk('public')->put($path, $request->file('avatar'));
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('user')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
