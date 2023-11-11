<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::orderBy('name')
            ->get()
            ->pluck('name', 'id');

        return view('pengguna.index', compact('role'));
    }

    public function data()
    {
        $query = User::orderBy('name')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('role_id', function ($query) {
                return $query->role_id->name;
            })
            ->addColumn('action', function ($query) {
                return '
                <div class="d-flex justify-content-around">
                    <a href="' . route('users.detail', $query->id) . '" class="btn btn-success"><i class="fas fa-search"></i></a>
                    <button onclick="editForm(`' . route('users.show', $query->id) . '`)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteData(`' . route('users.destroy', $query->id) . '`)"><i class="fas fa-trash"></i></button>
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
