<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\kompartement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Hasil::with('user', 'arahan.kompartement')
                ->where('status', 'Sudah sesuai');
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

        $ks = Kompartement::where(function($query) {
            $query->where('nama', '!=', 'super admin')
                  ->where('nama', '!=', 'SPI');
        })->get();

        // Return the view for the index page
        return view('pages.dashboard',compact('ks'));
    }

    public function komdashboard(Request $request, string $id)
        {

            if ($request->ajax()) {
                $query = Hasil::with(['user', 'arahan'])
                ->where('status', 'Sudah sesuai')
                ->whereHas('arahan.kompartement', function($query) use ($id) {
                    $query->where('id', $id);
                })
                ->get();
                return DataTables::of($query)
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

    return view('pages.komdashboard');
}



    public function profile()
    {
        return view('pages.profile');
    }

    public function changeAvatar(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            $path = "avatar/";
            $oldfile = $path.basename($user->avatar);
            Storage::disk('public')->delete($oldfile);
            $data['avatar'] = Storage::disk('public')->put($path, $request->file('avatar'));

            $user->update($data);
        }

        return redirect()->back();
    }

    public function removeAvatar()
    {
        $user = User::findOrFail(auth()->user()->id);

        $path = "avatar/";
        $oldfile = $path.basename($user->avatar);
        Storage::disk('public')->delete($oldfile);
        $data['avatar'] = NULL;

        $user->update($data);

        return redirect()->back();
    }
}
