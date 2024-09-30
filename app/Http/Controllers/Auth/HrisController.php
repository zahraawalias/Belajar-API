<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class HrisController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Masukan EMail Onekalbe',
            'email.email' => 'EMail Tidak Valid',
            'password.required' => 'Masukan Password'
        ]);

        $kredensil = $request->only('email', 'password');

        // check User
        $user = User::where('email', $request->email)->first();
        if (!empty($user) && $user->role == 'admin') {
            # code...
            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                return redirect()->route('home')->with('success', 'Selamat Datang');
            } else {
                return redirect()->route('login')->with('error', 'Login Gagal Silahkan Ulangi');
            }
        } else {
            $data = $this->hris($request);
            if (empty($data['accessToken']) || $data['accessToken'] == null) {
                # code...
                return redirect()->route('login')->with('error', $data ?? 'Response Not Found');
            } else {
                # code...
                $this->getAccount($data, $request);

                if (Auth::attempt($kredensil)) {
                    $user = Auth::user();
                    return redirect()->route('home')->with('success', 'Selamat Datang');
                } else {
                    return redirect()->route('login')->with('error', 'Login Gagal Silahkan Ulangi');
                }
            }
        }
    }

    private function getAccount($data, $request)
    {
        try {
            DB::beginTransaction();

            $response = explode('.', $data['accessToken']);
            $result = base64_decode($response[1]);
            $response = json_decode($result, true);
            $check = User::where('employeId', $response['NIK'])->first();
            if (empty($check)) {
                # code...
                User::create([
                    'employeId' => $response['NIK'],
                    'fullname' => $response['Name'],
                    'email' => $request->email,
                    'phone' => $response['EmpHandPhone'] ?? 'NA',
                    'email_backup' => $request['Email'],
                    'role' => strtolower($response['JobLvlName']),
                    'jobTitle' => $response['JobTtlName'],
                    'groupName' => $response['DeptName'],
                    'password' => Hash::make($request->password),
                ]);
            } else {
                $check->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            DB::commit();
            return [
                'employeId' => $response['NIK'],
                'fullname' => $response['Name'],
                'email' => $request->email,
                'phone' => $response['EmpHandPhone'] ?? 'NA',
                'email_backup' => $request['Email'],
                'role' => strtolower($response['JobLvlName']),
                'jobTitle' => $response['JobTtlName'],
                'groupName' => $response['DeptName'],
            ];
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th);
            DB::rollBack();
            return null;
        }
    }

    private function hris($request)
    {
        $credentials = [
            'username' => $request->email,
            'password' => $request->password,
            'getprofile' => true
        ];

        // Kirim permintaan ke endpoint API login

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api-global-it-pharma-production-3scale-apicast-staging.apps.alpha.kalbe.co.id/api/v1/GlobalLogin/Login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($credentials),
            CURLOPT_HTTPHEADER => array(
                'app_id: a8ecd84f',
                'app_key: 1cb9d7c6d267a904ab461ad65d49458e',
                'Content-Type: application/json',
                'X-API-Key: SQA45CsPgqRCeyoO0ZzeKK6BFG1vpR1vy7r-gvPiEw4'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $token = json_decode($response, true);
        return $token;
    }

}
