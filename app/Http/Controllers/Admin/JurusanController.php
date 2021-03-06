<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $jurusan = Jurusan::where('nama', 'LIKE', "%$keyword%")
                ->orWhere('artikel', 'LIKE', "%$keyword%")
                ->orWhere('galeri', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $jurusan = Jurusan::latest()->paginate($perPage);
        }

        return view('admin.jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'artikel' => 'required']);

        $requestData = $request->all();

        if ($image = $request->file('galeri')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $requestData['galeri'] = "$profileImage";
        }
        
        Jurusan::create($requestData);

        return redirect('admin/jurusan')->with('flash_message', 'Jurusan added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        return view('admin.jurusan.show', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        return view('admin.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'artikel' => 'required']);

        $requestData = $request->all();
        
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($requestData);

        return redirect('admin/jurusan')->with('flash_message', 'Jurusan updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Jurusan::destroy($id);

        return redirect('admin/jurusan')->with('flash_message', 'Jurusan deleted!');
    }
}
