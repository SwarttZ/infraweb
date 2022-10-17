<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use Image;
use Illuminate\Support\Facades\Hash;
use PDOException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user, Profile $profile)
    {
        $this->model = new Repository($user);
        $this->user = $user;
        $this->model = new Repository($profile);
        $this->profile = $profile;
    }

    public function profile()
    {
        $status = User::all();
        return view('backend.pages.users.profile', compact('status'));
    }
    public function index()
    {
        return view('backend.pages.users.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'nome.required' => 'Erro ao enviar dados verifique o campo nome',
            'email.required' => 'Erro ao enviar dados verifique o campo email',
            'password.required' => 'Erro ao enviar dados verifique o campo email',
            'email.unique' => 'Desculpe esse email já está em uso'
        ];

        $request->validate([
            'nome' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|max:255',
        ], $messages);

        User::create([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        alert()->success('Usuário criado com sucesso: ' . $request->nome);
        return back();
    }
    public function crop(Request $request)
    {
        if ($request->file('file')) {
            $this->profile->select()->where('user_id', '=', auth()->user()->id)->delete();
        }
        $file = $request->file('file');
        $extension = $file->extension();
        $imageName = $this->generateImageName($extension);
        $path = $this->getUploadPath();

        $upload = $file->move($path, $imageName);
        if ($upload) {
            $this->profile->getModel()->create([
                'user_id' => auth()->user()->id,
                'photo' => $imageName
            ])->save();
            return response()->json(['status' => 1, 'msg' => 'Imagem editada com sucesso.', 'name' => $imageName]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Tem algo errado tente novamente']);
        }
    }
    public function show()
    {
        $users = DB::table('users')
            ->paginate(15);

        return view('backend.pages.users.index', [
            'users' => $users,
        ]);
    }

    public function updatePassword(Request $request)
    {

        if ($request->password == $request->password2 && !empty($request->password) && !empty($request->password2)) {
            $user = $this->user->getModel()
                ->where('name', '=', $request->name)
                ->update([
                    'password' => Hash::make($request->password)
                ]);

            if ($user != null) {
                $result['resultado'] =  true;
                return response()->json($result);
            }

            $result['resultado'] =  false;
            return response()->json($result);
        }

        $result['resultado'] =  false;
        return response()->json($result);
    }
    private function generateImageName($ext)
    {
        return "img_" . date('Y-m-d-H-s') . '.' . $ext;
    }
    private function getUploadPath()
    {
        return public_path('backend/img/profile/');
    }
}
