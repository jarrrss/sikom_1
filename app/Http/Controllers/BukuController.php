<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Buku;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportExcelBuku;
use App\Imports\ImportDataBukuClass;

class BukuController extends Controller
{

    public function index()
    {
        $buku = Buku::all();
        return view('data_buku.index',compact('buku'));
    }


    public function create()
    {
        return view('data_buku.form_create');
    }


    public function store(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|max:4',
            ],
            [
                'judul.required' => 'judul wajib diisi',
                'penulis.required' => 'penulis wajib diisi',
                'penerbit.required' => 'penerbit wajib diisi',
                'tahun_terbit.required' => 'tahun terbit wajib diisi',
            ],
        );

        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
        ];

        Buku::create($data);
        return redirect()->route('buku.index')->with('success','Data Berhasil di Simpan');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $dt = Buku::find($id);
        return view('data_buku.form_edit',compact('dt'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|max:4',
            ],
            [
                'judul.required' => 'judul wajib diisi',
                'penulis.required' => 'penulis wajib diisi',
                'penerbit.required' => 'penerbit wajib diisi',
                'tahun_terbit.required' => 'tahun terbit wajib diisi',
            ],
        );

        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
        ];

        Buku::where('id',$id)->update($data);
        return redirect()->route('buku.index')->with('success','Data Berhasil di Edit');
    }



    public function destroy($id)
    {
        Buku::find($id)->delete();
        return back()->with('succes','Data Berhasil Di Hapus');
    }

    public function export_pdf(Request $request)
    {
        //DECLARE REQUEST
        $f1=$request->input('f1');
        //QUERY
        $data = Buku::select('*');
        if($f1){
            $data->where('kategori_id','=',''.$f1.'')->get();
        }
        $data = $data->get();

        // Pass parameters to the export view
        $pdf = PDF::loadview('data_buku.export_Pdf', ['data'=>$data]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // SET FILE NAME
        $filename = date('YmdHis') . '_data_buku';
        // Download the Pdf file
        return $pdf->download($filename.'.pdf');
    }

    public function export_excel(Request $request)
    {
        //DECLARE REQUEST

        //QUERY
        $data = Buku::select('*');

        $data = $data->get();

        $export = new ExportExcelBuku($data);
        // SET FILE NAME
        $filename = date('YmdHis') . '_data_buku';

        // Download the Excel file
        return Excel::download($export, $filename . '.xlsx');
    }

    public function import_excel(Request $request)
    {
        // /DECLARE REQUEST
        $file = $request->file('file');

        //VALIDATION FORM
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            if($file){
                // IMPORT DATA
                $import = new ImportDataBukuClass;
                Excel::import($import, $file);

                // SUCCESS
                $notimportlist="";
                if ($import->listgagal) {
                    $notimportlist.="<hr> Not Register : <br> {$import->listgagal}";
                }
                return back()
                ->with('success', 'Import Data berhasil,<br>
                Size '.$file->getSize().', File extention '.$file->extension().',
                Insert '.$import->insert.' data, Update '.$import->edit.' data,
                Failed '.$import->gagal.' data, <br> '.$notimportlist.'');

            } else {
                // ERROR
                return back()
                ->withInput()
                ->with('error','Gagal memproses!');
            }

  }
  catch(Exception $e){
   // ERROR
   return back()
            ->withInput()
            ->with('error','Gagal memproses!');
  }

    }
}
