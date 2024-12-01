<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminCatalogController extends Controller
{

    public function index()
    {
        $catalogs = Catalog::orderBy('created_at', 'DESC')->get();

        return view('admin.catalogs.list', [
            'catalogs' => $catalogs
        ]);
    }

    public function create()
    {
        return view('admin.catalogs.create');
    }

    public function edit($id)
    {
        $catalog = Catalog::findOrFail($id);
        return view('admin.catalogs.edit', [
            'catalog' => $catalog
        ]);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'type' => 'required|min:5',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.catalogs.create')->withInput()->withErrors($validator);
        }

        $catalog = new Catalog();
        $catalog->name = $request->name;
        $catalog->type = $request->type;
        $catalog->stock = $request->stock;
        $catalog->price = $request->price;
        $catalog->description = $request->description;
        $catalog->save();

        if ($request->hasFile('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            $adminPath = public_path('uploads/catalogs');

            // INI YANG DULU
            // Direktori di proyek client
            // $clientPath = base_path('../client/public/uploads/catalogs');

            $image->move($adminPath, $imageName);

            // if (File::exists($adminPath . '/' . $imageName)) {
            //     File::copy($adminPath . '/' . $imageName, $clientPath . '/' . $imageName);
            // }

            $catalog->image = $imageName;
            $catalog->save();
        }

        return redirect()->route('admin.catalogs.list')->with('success', 'Berhasil menambahkan katalog.');
    }

    public function update($id, Request $request)
    {
        $catalog = Catalog::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'type' => 'required|min:5',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.catalogs.edit', $catalog->id)->withInput()->withErrors($validator);
        }

        $catalog->name = $request->name;
        $catalog->type = $request->type;
        $catalog->stock = $request->stock;
        $catalog->price = $request->price;
        $catalog->description = $request->description;

        if ($request->hasFile('image')) {
            $adminPath = public_path('uploads/catalogs/' . $catalog->image);
            // $clientPath = base_path('../client/public/uploads/catalogs/' . $catalog->image); // Sesuaikan path ini

            if (File::exists($adminPath)) {
                File::delete($adminPath);
            }


            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;


            $image->move(public_path('uploads/catalogs'), $imageName);

            // if (File::exists(public_path('uploads/catalogs/' . $imageName))) {
            //     File::copy(public_path('uploads/catalogs/' . $imageName), base_path('../client/public/uploads/catalogs/' . $imageName));
            // }

            $catalog->image = $imageName;
        }

        $catalog->save();

        return redirect()->route('admin.catalogs.list')->with('success', 'Berhasil memperbarui katalog.');
    }


    public function destroy($id)
    {
        $catalog = Catalog::findOrFail($id);

        // delete image
        File::delete(public_path('uploads/catalogs/' . $catalog->image));

        $catalog->delete();

        return redirect()->route('admin.catalogs.list')->with('success', 'Berhasil hapus katalog.');
    }

}
