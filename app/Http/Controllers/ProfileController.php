<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UserRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['title'] = 'Профіль';
        $data['page'] = 'index';
        $data['title_page'] = 'Профіль користувача';
        $data['content'] = 'profile/index';
        $data['user'] = User::find(Auth::id());
        return view('layouts/admin_layout', $data);
    }

    public function update_profile_ajax(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Це не Ajax запит!',
            ]);
        } elseif ($request->method() !== 'POST') {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Це не POST запит!',
            ]);
            return;
        } elseif (!$request->all()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Дані не прийшли!',
            ]);
        }

        $request->validate($this->rules());

        $result = User::find($request->input('id'));

        $this->set_data($result, $request);

        $result->save();

        if ($result->wasChanged()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Дані оновлено!',
            ]);
        } else {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Ви нічого не оновляли!',
            ]);
        }
    }

    private function rules()
    {
        $rules = [
            'name' => 'required|min:2|max:255',
            'surname' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255|email',
        ];
        return $rules;
    }

    private function set_data($result, $request)
    {
        $result->name = $request->name;
        $result->surname = $request->surname;
        $result->email = $request->email;
        return $result;
    }
}
