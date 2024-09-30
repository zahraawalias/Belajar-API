<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LigaController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('https://ligaindonesia-api.vercel.app/api/v1/teams');
            $data = $response->json();

            // dd($data);

            if (!$data['success']) {
                # code...
                return abort(404);
            }


            return view('liga', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            dd('error ges');
        }
    }

    public function detail($team_id)
    {
        try {
            $response = Http::get('https://ligaindonesia-api.vercel.app//api/v1/team/profile/' . $team_id);
            $data = $response->json();

            // dd($data);

            if (!$data['success']) {
                # code...
                return abort(404);
            }


            return view('liga', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            dd('error ges');
        }
    }

    public function players($team_id)
    {
        try {
            // Mengambil data pemain berdasarkan team_id
            $response = Http::get('https://ligaindonesia-api.vercel.app/api/v1/team/players/' . $team_id);
            $data = $response->json();

            if (!$data['success']) {
                return abort(404);
            }

            // Mengambil detail tim juga untuk ditampilkan di halaman pemain
            $teamResponse = Http::get('https://ligaindonesia-api.vercel.app/api/v1/team/profile/' . $team_id);
            $teamData = $teamResponse->json();

            return view('players', compact('data', 'teamData'));
        } catch (\Throwable $th) {
            dd('Error retrieving data.');
        }
    }

}
