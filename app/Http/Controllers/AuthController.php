<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\SignUpFormRequest;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;

class AuthController extends Controller {

	public function signUp( SignUpFormRequest $request ) {

		$user            = new User;
		$user->email     = $request->email;
		$user->name      = $request->name;
		$user->password  = bcrypt( $request->password );
		$user->google_id = $request->google_id ? $request->google_id : null;
		$user->save();

		return response( [
			'status' => 'success',
			'data'   => $user
		], 200 );
	}

	public function login( Request $request ) {
		$credentials = $request->only( 'email', 'password' );
		if ( ! $token = JWTAuth::attempt( $credentials ) ) {
			return response( [
				'status' => 'error',
				'error'  => 'invalid.credentials',
				'msg'    => 'Invalid Credentials.'
			], 400 );
		}

		return response( [
			'status' => 'success'
		] )
			->header( 'Authorization', $token );
	}

	public function user( Request $request ) {
		$user = User::find( Auth::user()->id );

		return response( [
			'status' => 'success',
			'data'   => $user
		] );
	}

	public function refresh() {
		return response( [
			'status' => 'success'
		] );
	}

	public function logout() {
		JWTAuth::invalidate();

		return response( [
			'status' => 'success',
			'msg'    => 'Logged out Successfully.'
		], 200 );
	}

	/*
	 * Redirect user to page auth Google
	 */

	public function redirectToProvider() {
		return Socialite::driver( 'google' )->redirect();
	}

	/*
	 * Get User info from Google
	 */
	public function handleProviderCallback() {

		$user = Socialite::driver( 'google' )->user();

		return redirect( "/#/signup?name=" . $user->name . "&email=" . $user->email . "&google_id=" . $user->id );
	}
}