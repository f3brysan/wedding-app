<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TujuanController extends Controller
{
    public function index(Request $request)
    {
        $getData = Tujuan::all();
        if ($request -> ajax()) {
            return DataTables::of($getData)
                                ->addColumn('action', function ($getData) {
                                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$getData->id.'" data-original-title="Kirim WA" class="text-white px-1 btn btn-success btn-sm kirim">Kirim WA</a>';
                                    $btn .= '&nbsp;';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$getData->id.'" data-original-title="Copy Link" class="px-1 btn btn-info btn-sm copy-link">Copy Link</a>';
                                    $btn .= '&nbsp;';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$getData->id.'" data-original-title="Hapus" class="text-white px-1 btn btn-danger btn-sm hapus-link">Hapus</a>';
                                    return $btn;
                                })
                                ->rawColumns(['action'])
                                ->addIndexColumn()
                                ->make(true);
        }
        return view('back.tujuan.index');
    }

    public function store(Request $request)
    {
        $telp = $request->telp;
        $chgTelp = "62" . substr($telp, 1);

        $insert = Tujuan::updateOrCreate(
            [
            'id' => $request->id
        ],
            [
            'nama' => $request->nama,
            'telp' => $chgTelp,
            'slug' => Str::slug($request->nama)
        ]
        );

        return response()->json($insert);
    }
}
