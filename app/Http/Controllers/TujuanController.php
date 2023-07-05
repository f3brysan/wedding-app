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
                                ->addColumn('baca_undangan', function ($getData) {
                                    if ($getData->is_open == true) {
                                        return 'Sudah';
                                    } else {
                                        return 'Belum';
                                    }
                                    
                                })
                                ->addColumn('action', function ($getData) {
                                    $wame = 'https://api.whatsapp.com/send/?phone='.$getData->telp.'&text=';
                                    $pesanWA = 
'Assalamualaikum Wr. Wb.
Tanpa mengurangi rasa hormat. Kami mengundang Bapak/Ibu/Saudara/i '.$getData->nama.' untuk hadir pada acara pernikahan kami.

Pada tanggal 15 Juli 2023,
Bertempat di Gedung Serbaguna UNESA Ketintang Jl. Ketintang Pratama, Surabaya, Jawa Timur.
Mohon maaf undangan hanya dibagikan melalui pesan ini, Bapak/Ibu/Saudara/i '.$getData->nama.' dapat mengklik tautan berikut untuk menuju undangan pernikahan kami

linaputri.febrysan.com/nikah/'.$getData->slug.'.

Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu. Atas kehadiran dan doa restunya, kami mengucapkan terima kasih.
Wassalamualaikum Wr. Wb.
Lina Putri & Febry San';
                                    $urlencode = urlencode($pesanWA);
                                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$getData->id.'" data-msg="'.$wame.$urlencode.'" data-original-title="Kirim WA" class="text-white px-1 btn btn-success btn-sm kirimwa">Kirim WA</a>';                                                                       
                                    $btn .= '&nbsp;';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$getData->id.'" data-original-title="Hapus" class="text-white px-1 btn btn-danger btn-sm hapus-link">Hapus</a>';
                                    return $btn;
                                })
                                ->rawColumns(['action','baca_undangan'])
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
