<?php

namespace App\Http\Controllers\Auth;

// require 'vendor/autoload.php';

use App\Events\ViewNew;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Newletter;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Illuminate\Support\collection;
use App\Models\System;
use Facade\FlareClient\Stacktrace\File;
use App\Models\Page;
use App\Models\Social;
use App\Models\News;
use App\Models\Slider;
// use Intervention\Image\Image;
use Image;
use Illuminate\Support\Str;


class FrontController extends Controller
{
    //
    public function __construct(){
        @session_start();

        $logo = System::where('code', 'logo')->first();
        view()->share('logo', $logo);

        $favicon = System::where('code', 'favicon')->first();
        view()->share('favicon', $favicon);

        $copyright = System::where('code', 'copyright')->first();
        view()->share('copyright', $copyright);

        $social = Social::where('status', 1)->get();
        view()->share('mang_xh', $social);

        $page = Page::where('status', 1)->get();
        view()->share('page', $page);
    }

    public function home(){ 
        $page_info = Page::where('status', 1)->where('alias', '/')->selectRaw('name, images, MetaTitle, MetaDescription, MetaKeyword')->first();
        $social = Social::where('status', 1)->get(); 
        $about = "is founded on 2009 by Sir Hevn D'monyx, and ran by him and his team ever since. Sir Hevn is a Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
        $news = News::where('status', 1)->orderBy('views', 'desc')->limit(4)->get();
        $news_sale = News::where('Cat_id', 2)->orderBy('id', 'desc')->limit(4)->get();
        $newest = News::where('Cat_id', 1)->orderBy('id', 'desc')->limit(6)->get();

        $slider = Slider::where('status', 1)->orderBy('sort', 'asc')->get(); 
        return view('front.home.home', ['news' => $news, 'about' => $about, 'social' => $social, 'news_sale' => $news_sale, 'newest' =>$newest, 'slider' => $slider, 'page_info' => $page_info]);
    }

    public function about(){
        $page_info = Page::where('status', 1)->where('alias', 've-chung-toi')->selectRaw('name, images, MetaTitle, MetaDescription, MetaKeyword, description, alias')->first();
        return view('front.about.about', ['page_info' => $page_info]);
    }

    public function trend(Request $request){
        //lay ra danh muc bang bien $slug dc truyen bang phuong thuc get
        $category = Page::where('status', 1)->where('alias', 'xu-huong-thoi-trang')->first();
        if(isset($request->sort) && $request->sort == 'luotxem'){
            $list = News::where('status', 1)->where('Cat_id', 1)->orderBy('views', 'desc')->selectRaw('name, alias, images, smallDescription')->paginate(12);
            $sort = 'luotxem';
        } else{
            $list = News::where('status', 1)->where('Cat_id', 1)->orderBy('id', 'desc')->selectRaw('name, alias, images, smallDescription')->paginate(12);
            $sort = 'tinmoi';
        }     
        return view('front.slug.slug', ['category' => $category, 'list' => $list, 'sort' => $sort]);
    }

    public function discount(Request $request){
        //lay ra danh muc bang bien $slug dc truyen bang phuong thuc get
        $category = Page::where('status', 1)->where('alias', 'khuyen-mai')->first();
        if(isset($request->sort) && $request->sort == 'luotxem'){
            $list = News::where('status', 1)->where('Cat_id', 2)->orderBy('views', 'desc')->selectRaw('name, alias, images, smallDescription')->paginate(12);
            $sort = 'luotxem';
        } else{
            $list = News::where('status', 1)->where('Cat_id', 2)->orderBy('id', 'desc')->selectRaw('name, alias, images, smallDescription')->paginate(12);
            $sort = 'tinmoi';
        }
        return view('front.slug.slug', ['category' => $category, 'list' => $list, 'sort' => $sort]);
    }

    public function slugHTML(Request $request, $slug){
        $new = News::where('status', 1)->where('alias', $slug)->selectRaw('id, name, MetaTitle, MetaDescription, MetaKeyword, images, description, created_at, views')->first();
        event(new ViewNew($new));
        return view('front.news.new', ['new'=>$new]);
    }

    public function contact(){
        $page_info = Page::where('status', 1)->where('alias', 'lien-he')->selectRaw('name, images, MetaTitle, MetaDescription, MetaKeyword, description')->first();
        $map = System::where('status', 1)->where('code', 'map')->selectRaw('description')->first();
        return view('front.contact.contact', ['page_info' => $page_info, 'map' => $map]);
    }

    //subscribe email
    public function subEmail(Request $request){
        if($request->mail != ''){
            $newletter = Newletter::where('email', $request->mail)->first();
            if(isset($newletter)){
                echo 'email đã tồn tại!';
            } else{
                $newletter = new Newletter;
                $newletter->email = $request->mail;
                $newletter->save();
                echo 'Đăng ký thành công!';
            }

        } else{ echo 'Xảy ra lỗi, vui lòng thử lại sau!';}
    }

    public function contactSendEmail(Request $request){
        if($request->name != '' && $request->mail != '' && $request->phone != '' && $request->message != ''){
            $contact = new Contact;
            $contact->name = $request->name;
            $contact->email = $request->mail;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();

            echo ('Chúng tôi đã nhận được email của bạn!');
        }
        else{
            echo('Vui lòng điền đầy đủ thông tin!');
          }
    }

    public function search(Request $request){
        $page_info = Page::where('status', 0)->where('alias', 'tim-kiem')->selectRaw('name, images, MetaTitle, MetaDescription, MetaKeyword, description')->first();
        if(isset($request->keyword) && $request->keyword != NULL){
            $search_list = News::where('status', 1)->where('name', 'like', '%'.$request->keyword.'%')->selectRaw('name, alias, images, smallDescription')->paginate(12);
        } else{
            $search_list = NULL;
        }
        return view('front.search.search', ['page_info' => $page_info, 'search_list' => $search_list]);
    }
}
