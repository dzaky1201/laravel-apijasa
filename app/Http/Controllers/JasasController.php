<?php

namespace App\Http\Controllers;
use App\Jasa;
use Illuminate\Http\Request;

class JasasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jasa::latest()->paginate(5);
        return view('index', compact('data'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik'  =>  'required',
            'nomor_hp'      =>  'required',
            'alamat'        =>  'required',
            'images'        =>  'required',
        ]);

        $images = $request->file('images');

        $new_name = rand() . '.' . $images->getClientOriginalExtension();
        $images->move(public_path('images'), $new_name);
        $form_data = array(
            'nama_pemilik'  =>  $request->nama_pemilik,
            'nomor_hp'      =>  $request->nomor_hp,
            'alamat'        =>  $request->alamat,
            'images'        =>  $new_name
        );

        Jasa::create($form_data);
        return redirect('jasa')->with('success', 'data added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jasa::findOrFail($id);
        return view('view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jasa::findOrFail($id);
        return view('edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $images = $request->file('images');
        if($images != '')
        {
            $request->validate([
            'nama_pemilik'  =>  'required',
            'nomor_hp'      =>  'required',
            'alamat'        =>  'required',
            'images'        =>  'images|max:2048'
            ]);

            $image_name = rand() . '.' . $images->getClientOriginalExtension();
            $images->move(public_path('images'), $image_name);
        }
        else
        {
            $request->validate([
            'nama_pemilik'  =>  'required',
            'nomor_hp'      =>  'required',
            'alamat'        =>  'required'
            ]);
        }
        $form_data = array(
            'nama_pemilik'  =>  $request->nama_pemilik,
            'nomor_hp'      =>  $request->nomor_hp,
            'alamat'        =>  $request->alamat,
            'images'        =>  $image_name
        );

        Jasa::whereId($id)->update($form_data);
        return redirect('jasa')->with('success', 'data berhasil diupdata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Jasa::findOrFail($id);
        $data->delete();

        return redirect('jasa')->with('success', 'data berhasil dihapus');
    }
}
