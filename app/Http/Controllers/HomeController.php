<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller{

    function pusat(){
        $data['menu'] = 'pusat';
        $data['title'] = 'Hasil Hitung DPR RI';
        return view('pusat',$data);
    }

    function provinsi(){
        $data['menu'] = 'provinsi';
        $data['title'] = 'Hasil Hitung DPR Provinsi';
        return view('provinsi',$data);
    }

    function daerah(){
        $data['menu'] = 'daerah';
        $data['title'] = 'Hasil Hitung DPR Kab./Kota';
        return view('daerah',$data);
    }

    function donate(){
        $data['menu'] = 'donate';
        $data['title'] = 'Donasi';
        return view('donate',$data);
    }

    function tos(){
        $data['menu'] = 'tos';
        $data['title'] = 'Terms of Services';
        return view('tos',$data);
    }

    function getKursiPusat($kode){
        $data = DB::select("SELECT * from tbl_dapilpusat td where kode_dapilpusat=$kode");
        return response()->json($data[0]);
    }

    function getKursiProvinsi($kode){
        $data = DB::select("SELECT * from tbl_dapilprov td WHERE nama_dapilprov='$kode'");
        return response()->json($data[0]);
    }

    function getKursiDaerah($kode){
        $data = DB::select("SELECT * from tbl_dapildprd td where nama_kota='$kode'");
        return response()->json($data[0]);
    }

}
