<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Page;
use App\Models\Post;
use Socialite;
use Auth;

class UserController extends Controller
{
    public function redirectToFacebook()
    {
        try
        {
            return Socialite::driver('facebook')->redirect();
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function facebookCalback()
    {
        if(isset(auth()->user()->email))
        {
            $user = Socialite::driver('facebook')->user();
            session(['facebook_user'=>$user]);
            return redirect('/getpages/facebook/callback');
        }
        else
        {
            $user = Socialite::driver('facebook')->user();
            session(['facebook_user'=>$user]);
            return redirect('/facebook/login');
        }
    }

    public function facebookSignin()
    {
        try
        {
            $facebookId = User::where('facebook_id', session('facebook_user')->id)->first();
            session(['facebook_user_token' => session('facebook_user')->token]);
            if($facebookId)
            {
                Auth::login($facebookId);
                return redirect('/posts');
            }
            else
            {
                $profile_picture_end_point = "https://graph.facebook.com/v15.0/me?fields=picture&access_token=".session('facebook_user_token');
                $response = Http::get($profile_picture_end_point);
                $array = $response->json();
                $createUser = User::create([
                    'name' => session('facebook_user')->name,
                    'email' => session('facebook_user')->email,
                    'profile_photo_path' => $array['picture']['data']['url'],
                    'facebook_id' => session('facebook_user')->id,
                    'password' => Hash::make('rachid123'),
                ]);
                Auth::login($createUser);
                return redirect('/posts');
            }
        }
        catch (Exception $exception)
        {
            dd($exception->getMessage());
        }
    }

    public function pages()
    {
        return view('pages');
    }

    public function connect_to_facebook_pages()
    {
        if(session('facebook_user_token')!=null)
        {
            try
            {
                return Socialite::driver('facebook')->scopes(['pages_show_list','pages_manage_posts','pages_read_engagement'])->redirect();
            } catch(Exception $e){
                dd($e->getMessage());
            }
        }
        else
        {
            return redirect('/login');
        }
    }

    public function connect_to_facebook_pages_callback()
    {
        try
        {
            session(['facebook_user_token' => session('facebook_user')->token]);
            $response = Http::get('https://graph.facebook.com/me/accounts?access_token='.session('facebook_user_token'));
            $array = $response->json();

            DB::table('pages')->delete();

            foreach($array['data'] as $page)
            {
                Page::create([
                    'facebook_page_id' => $page['id'],
                    'facebook_page_name' => $page['name'],
                    'facebook_page_access_token' => $page['access_token'],
                    'user_id' => auth()->user()->id
                ]);
            }

            return redirect('/pages');
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function add_post()
    {
        return view('add_post');
    }

    public function edit_post(Post $post)
    {
        return view('edit_post')->with(['post'=>$post]);
    }

}
