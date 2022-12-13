<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\BaseController;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['roles'] = 'staff';
        $user = User::create($input);
        $success['token'] =  $user->createToken('JuruParkir')->plainTextToken;
        $success['name'] =  $user->name;
        $success['id_user'] =  $user->id;

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user                 = Auth::user();
            $success['token']     = $user->createToken('JuruParkir')->plainTextToken;
            $success['name']      = $user->name;
            $success['username']  = $user->username;
            $success['email']     = $user->email;
            $success['id_user']   = $user->id;
            $success['id_lokasi'] = $user->id_lokasi;
            $success['lokasi']    = $user->lokasi->lokasi ?? 'Asta';
            $success['url_photo'] = $user->url_photo;
            $success['logo']      = 'https://appjukir.initdproject.web.id/img/ms-icon-70x70.png';
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function teams($id)
    {
        try {
            $result = User::where('id_lokasi', $id)->take(10)->get();
            if (count($result) > 0) {
                return $this->sendResponse($result, 'Get data teams successfully.');
            }
            return $this->sendError('404.', ['error' => 'Data Tidak Ditemukan!']);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError('Unauthorised.', ['error' => $th->getMessage()]);
        }
    }

    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'id_user' => 'required',
            'url_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4096',
        ]);
        try {
            $image_path = $request->file('url_photo')->store('image', 'public');

            $data = User::findOrFail($request->id_user);
            $data->createToken('JuruParkir')->plainTextToken;
            $data->url_photo = '/storage/' . $image_path;
            $data->save();
            return $this->sendResponse($data, 'Upload profile image successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError('Gagal.', ['error' => $th->getMessage()]);
        }
    }

    public function editPassword(Request $request)
    {
        $this->validate($request, [
            'id_user'      => 'required',
            'old_password' => 'required',
            'password'     => 'required|min:6',
            'c_password'   => 'required',
        ]);
        $data = User::findOrFail($request->id_user);
        $hashedPassword = $data->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (Hash::check($request->password, $hashedPassword)) {
                return $this->sendError('Gagal.', ['error' => 'Kata Sandi tidak boleh sama dengan yang lama!']);
            } elseif($request->password !== $request->c_password){
                return $this->sendError('Gagal.', ['error' => 'Ulangi kata sandi harus sama!']);
            }else {
                $data->password = Hash::make($request->password);
                $data->save();
                return $this->sendResponse($data, 'Kata sandi berhasil diubah!');
            }
        } else {
            return $this->sendError('Gagal.', ['error' => 'Kata sandi lama tidak cocok']);
        }
    }

    public function editUser(Request $request)
    {
        $this->validate($request, [
            'id_user'   => 'required',
            'name'      => 'required',
            'username'  => 'required',
            'url_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4096',
        ]);
        try {
            $image_path = $request->file('url_photo')->store('image', 'public');
            $data = User::findOrFail($request->id_user);
            $data->name  = $request->name;
            $data->username = $request->username;
            $data->url_photo = '/storage/' . $image_path;
            $data->save();
            return $this->sendResponse($data, 'User Profile updated successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError('Gagal.', ['error' => $th->getMessage()]);
        }
    }
}
