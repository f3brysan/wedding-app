<?php

namespace App\Http\Controllers\F;

use App\Models\Galery;
use App\Models\Ucapan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Tujuan;

class UndanganController extends Controller
{
    public function index()
    {
        $galery = Galery::all();
        return view('front.index', compact('galery'));
    }

    public function show($slug)
    {
        $penerima = Tujuan::where('slug', $slug)->first();
        $galery = Galery::all();
        return view('front.index', compact('galery', 'penerima'));
    }

    public function api_ucapan(Request $request)
    {
        $getData = Ucapan::orderBy('created_at', 'DESC')->get();
        // return $getData;
        if ($request -> ajax()) {
            return DataTables::of($getData)
                                ->addColumn('ucapan', function ($getData) {
                                    return '<blockquote class="blockquote">
                                    <p>'.$getData->ucapan.'</p>
                                  </blockquote>
                                  <figcaption class="blockquote-footer">
                                    <p class="text-right" style="color:red;">- '.$getData->nama.'</p>
                                  </figcaption>';
                                })
                                ->rawColumns(['ucapan'])
                                ->addIndexColumn()
                                ->make(true);
        }
    }

    public function store(Request $request)
    {
        if ($request->nama == null or $request->nama == '') {
            $nama = "Hamba Tuhan";
        } else {
            $nama = $request->nama;
        }

        $insert = Ucapan::updateOrCreate(
            [
            'id' => $request->id
        ],
            [
            'ucapan' => $request->ucapan,
            'nama' => $nama
        ]
        );

        return response()->json($insert);
    }

    public function api_galery()
    {
        $data = Galery::all();

        return response()->json($data);
    }
}
