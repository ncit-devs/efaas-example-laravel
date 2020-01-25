<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Jumbojett\OpenIDConnectClient;
use App\Helpers\OIDCHelper;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function signin_oidc(Request $request)
    {


        if (isset($request->error)) {
            if ($request->error == "access_denied") {
                return redirect('/');
            }
        }


        $oidc = OIDCHelper::auth();
        $sub = $oidc->getVerifiedClaims('sub');
        $user_info = $oidc->requestUserInfo();
        $request->session()->put('id_token', $oidc->getIdToken());


        //check if the user is already in the database
        $user = User::where('efaas_id', $sub)->where('idnumber', $user_info->idnumber)->first();

        // dd($user);

        if ($user != null) {
            if ($user->efaas_id == null) {
                $user->efaas_id = $sub;
                $user->save();
            }

            Auth::user($user);
            Auth::login($user, true);

            $redirect_url = $request->session()->pull('redirect_url', $this->redirectTo);

            return redirect($redirect_url);
        } else {

            $user = new User;
            $user->efaas_id = $user_info->sub;
            $user->name        = $user_info->name;
            $user->given_name  = $user_info->given_name;
            $user->family_name  = $user_info->family_name;
            $user->middle_name  = $user_info->middle_name;
            $user->gender  = $user_info->gender;
            $user->idnumber  = $user_info->idnumber;
            $user->email       = $user_info->email;
            $user->phone_number = $user_info->phone_number;
            $user->address = $user_info->address;
            $user->fname_dhivehi = $user_info->fname_dhivehi;
            $user->mname_dhivehi = $user_info->mname_dhivehi;
            $user->lname_dhivehi = $user_info->lname_dhivehi;
            $user->user_type = $user_info->user_type;
            $user->verification_level = $user_info->verification_level;
            $user->user_state = $user_info->user_state;
            $user->birthdate         = Carbon::createFromFormat('m/d/Y', $user_info->birthdate);
            $user->passport_number = $user_info->passport_number;
            $user->is_workpermit_active = $user_info->is_workpermit_active;
            $user->efaas_updated_at = $user_info->updated_at;
            $user->save();

            Auth::user($user);
            Auth::login($user, true);

            return redirect()->route('home', $user->id);
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $id_token_hint = $request->session()->get('id_token');
        $efaas_client_post_redirect_url = env("EFAAS_CLIENT_POST_REDIRECT_URL", "default");
        $efaas_url = env("EFAAS_URL", "somedefaultvalue");
        $signout_endpoint = $efaas_url . "/connect/endsession";
        return redirect($signout_endpoint . "?id_token_hint=" . $id_token_hint . "&post_logout_redirect_uri=" . $efaas_client_post_redirect_url);
    }

    public function unauthorized(Request $request)
    {
        return View('unauthorized');
    }
}
