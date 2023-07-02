<?php

namespace App\Http\Controllers\B\Master;

use App\Models\Galery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class GaleryController extends Controller
{
    public function index(Request $request)
    {
        $getData = Galery::all();
        if ($request -> ajax()) {
            return DataTables::of($getData)
                                ->addColumn('pic_view', function ($getData)  {
                                    return '<img src="'.asset($getData->picture).'" alt="..." class="img-thumbnail" width="100px">';
                                })
                                ->addColumn('action', function ($getData) {
                                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$getData->id.'" data-original-title="Hapus" class="edit btn btn-danger btn-sm hapus">Hapus</a>';                                    
                                    return $btn;
                                })
                                ->rawColumns(['action', 'pic_view'])
                                ->addIndexColumn()
                                ->make(true);
        }
        return view('back.galery.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

           ]);

        if ($request->file('image')) {
            $path =$request->file('image')->store('/images/gallery', ['disk' =>   'my_files']);
        } else {
            $check = Galery::where('id', $request->id)->first();
            if ($check) {
                $path = $check->image;
            } else {
                $path = null;
            }
        }

        $insert = Galery::updateOrCreate(
            [
            'id' => $request->id
        ],
            [
            'picture' => $path
        ]
        );

        return response()->json($insert);
    }
}
