<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::orderBy('name', 'asc')
            ->get()
            ->pluck('name', 'id');

        return view('user.index', compact('role'));
    }

    public function data()
    {
        $user = User::orderBy('role_id', 'asc')->get();

        return datatables($user)
            ->addIndexColumn()
            ->editColumn('role', function ($user) {
                return $user->role->name;
            })
            ->addColumn('action', function ($user) {
                return '
            <div class="d-flex justify-content-around">
                <button onclick="editForm(`' . route('pengguna.show', $user->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" onclick="deleteData(`' . route('pengguna.destroy', $user->id) . '`)"><i class="fas fa-trash"></i></button>
            </div>
            ';
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $request['password'] = bcrypt($request->password);
        $request['email_verified_at'] = now();
        $request['remember_token'] = Str::random(10);

        $user = User::create($request->all());
        return response()->json(['data' => $user, 'message' => 'Data Berhasil Ditambah!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return response()->json(['data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|min:4',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // if (!$request->filled('password')) {
        //     $request->offsetUnset('password');
        // } else {
        //     $user->password = bcrypt($request->password);
        // }

        // if ($request->filled('password')) {
        //     $user->password = bcrypt($request->password);
        // }

        $request['password'] = $request->filled('password') ? bcrypt($request->password) : $user->password;

        $request['email_verified_at'] = now();

        $user->update($request->all());
        return response()->json(['data' => $user, 'message' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id)->delete();

        return response()->json(['data' => $user, 'message' => 'Data Berhasil Dihapus!']);
    }
}
