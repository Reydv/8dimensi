<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class ChartController extends Controller
{
    public function penyebaranCount(Request $request) {
        // Get the specific string from the request or hard-code it
        $ink = $request->input('inklusif', 'Inklusif');
        $pel = $request->input('peolopor', 'Pelopor');
        $teg = $request->input('tegas', 'Tegas');
        $pem = $request->input('pemikir', 'Pemikir');
        $renHat = $request->input('rendah hati', 'Rendah Hati');
        $afi = $request->input('afirmasi', 'Afirmasi');
        $pen = $request->input('penggerak', 'Penggerak');
        $berw = $request->input('berwibawa', 'Berwibawa');

        // Define the table name and column name
        $tableName = 'jawabans';
        $inkCol = 'dimensi_kepemimpinan';
        $pelCol = 'dimensi_kepemimpinan';
        $tegCol = 'dimensi_kepemimpinan';
        $pemCol = 'dimensi_kepemimpinan';
        $renHatCol = 'dimensi_kepemimpinan';
        $afiCol = 'dimensi_kepemimpinan';
        $penCol = 'dimensi_kepemimpinan';
        $berwCol = 'dimensi_kepemimpinan';

        // Perform the count operation
        $inklusif = DB::table($tableName)->where($inkCol, $ink)->count();
        $pelopor = DB::table($tableName)->where($pelCol, $pel)->count();
        $tegas = DB::table($tableName)->where($tegCol, $teg)->count();
        $pemikir = DB::table($tableName)->where($pemCol, $pem)->count();
        $rendahHati = DB::table($tableName)->where($renHatCol, $renHat)->count();
        $afirmasi = DB::table($tableName)->where($afiCol, $afi)->count();
        $penggerak = DB::table($tableName)->where($penCol, $pen)->count();
        $berwibawa = DB::table($tableName)->where($berwCol, $berw)->count();

        // Return view with the data
        return [
            'inklusif'=>$inklusif,
            'pelopor'=>$pelopor,
            'tegas'=>$tegas,
            'pemikir'=>$pemikir,
            'rendahHati'=>$rendahHati,
            'afirmasi'=>$afirmasi,
            'penggerak'=>$penggerak,
            'berwibawa'=>$berwibawa,
        ];
    }

    public function jeniskelaminCount(Request $request) {
        // Get the specific string from the request or hard-code it
        $lakila = $request->input('laki', 'laki');
        $perem = $request->input('perempuan', 'perempuan');

        // Define the table name and column name
        $tableName = 'users';
        $lakilaCol = 'jenis_kelamin';
        $peremCol = 'jenis_kelamin';

        // Perform the count operation
        $laki = DB::table($tableName)->where($lakilaCol, $lakila)->count();
        $perempuan = DB::table($tableName)->where($peremCol, $perem)->count();

        // Return view with the data
        return [
            'laki' => $laki,
            'perempuan' => $perempuan,
        ];
    }

    public function dashboardchart(){
        $request = new Request();

        $penyebaranData = $this->penyebaranCount($request);
        $jeniskelaminData = $this->jeniskelaminCount($request);

        $client = new Client();
        $response = $client->get('https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => 'a'
            ],
        ]);

        $datas = json_decode($response->getBody(), true);

        $finalData = [];
        
        foreach ($datas['rajaongkir']['results'] as $data) {
            $finalData[] = $data['city_name'] . ', ' . $data['province'];
        }

        return view('dashboard', [
            'penyebaranData' => $penyebaranData,
            'jeniskelaminData' => $jeniskelaminData,
            'domisilis' => $finalData,
        ]);
    }

}
