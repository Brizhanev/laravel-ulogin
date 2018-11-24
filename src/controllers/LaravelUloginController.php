<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class LaravelUloginController extends BaseController
{

  public function postUlogin()
  {
    $_user = json_decode(
      file_get_contents('http://ulogin.ru/token.php?token=' . request()->input('token') . '&host=' . $_SERVER['HTTP_HOST']),
      true
    );

    $validate = Validator::make([], []);

    if (isset($_user['error'])) {

      $validate->errors()->add('error', $_user['error']);

      return view(app('config')->get('laravel-ulogin.ulogin-error'), ['errors' => $validate->errors()]);

    }

    $check = ULogin::where('identity', '=', $_user['identity'])->first();

    if ($check) {

      Auth::loginUsingId($check->user_id, true);

      return Redirect::back();

    }

    $rules = array(
      'network' => 'required|max:255',
      'identity' => 'required|max:255|unique:ulogin',
      'email' => 'required',
    );

    $messages = array(
      'email.unique' => trans('laravel-ulogin::laravel-ulogin.email_already_registered'),
    );

    $validate = Validator::make($_user, $rules, $messages);

    if ($validate->passes()) {
      $password = str_random(8);

      $user = User::where('email', '=', $_user['email'])->first();

      if (!$user) {
        $user = new User();
        $user->name = $_user['last_name'] . ' ' . $_user['first_name'];
        $user->email = $_user['email'];
        $user->password = Hash::make($password);
        $user->save();
      }

      $ulogin = new ULogin();

      $ulogin->user_id = $user->id;
      $ulogin->network = $_user['network'];
      $ulogin->identity = $_user['identity'];
      $ulogin->email = $_user['email'];
      $ulogin->first_name = $_user['first_name'];
      $ulogin->last_name = $_user['last_name'];
      $ulogin->nickname = '';
      $ulogin->photo = $_user['photo'];
      $ulogin->photo_big = $_user['photo_big'];
      $ulogin->profile = $_user['profile'];
      $ulogin->access_token = isset($_user['access_token']) ? $_user['access_token'] : '';
      $ulogin->country = isset($_user['country']) ? $_user['country'] : '';
      $ulogin->city = isset($_user['city']) ? $_user['city'] : '';

      $ulogin->save();

      Auth::loginUsingId($user->id);

      return redirect()->back();

    } else {
      return view(app('config')->get('laravel-ulogin.ulogin-error'), ['errors' => $validate->errors()]);
    }
  }

}