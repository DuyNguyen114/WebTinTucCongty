<?php

namespace App\Http\Controllers\Auth;

// require 'vendor/autoload.php';
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
use Intervention\Image\ImageManagerStatic;
use App\Models\Slider;
// use Intervention\Image\Image;
// use Image;

class BackController extends Controller
{
    //
        public function __construct(){
            @session_start();

            $auth = Auth::user();

        }
    
        public function home(){
            return view('back.home.home');
        }

        public function staff_profile(){
            return view('back.staff.profile');
        }

        public function staff_profile_post(Request $request){

            $id = $request->input('id');
            $name = $request->input('name');
            $fullname = $request->input('fullname');
            $phone = $request->input('phone');
            $address = $request->input('address');
            $email = $request->input('email');
            $password = $request->input('password', '');

            if(strlen($password > 0)){
                $validated = $request->validate([
                    'name' => ['required', 'min:3'],
                    'fullname' => ['required'],
                    'phone' => ['required', 'size:10'],
                    'address' => ['required'],
                    'email' => ['required', 'unique:users'],
                    'password' => 'required|min:6',     
                ]);
            }else{
                $validated = $request->validate([
                    'name' => ['required', 'min:3'],
                    'fullname' => ['required'],
                    'phone' => ['required', 'size:10'],
                    'address' => ['required'],
                    'email' => ['required', 'unique:users'],    
                ]);
            }

            $user = User::findOrFail($id);

            $user->name = $name;
            $user->fullname = $fullname;
            $user->phone = $phone;
            $user->address = $address;
            $user->email = $email;       
            if (strlen($password) > 0) {
                $user->password = Hash::make($password);
            }

            $user->save();

            return redirect("/admin/staff/profile")->with('status', 'Cập nhật profile thành công !');

        }

        public function staff_list(){
            //lay ra danh sach nguoi dung
            // $list_users = DB::table('users')->get();
            $users = User::all();

            //lay ra chuc vu cua nguoi dung
            // foreach($users as $user){
            //     foreach($user->roles as $role){
            //         echo $user->name." vi tri: ".$role->name;
            //     }
            // }      
            return view('back.staff.list',['users' => $users]);
        }

        public function staff_add(  ){
            $user = Auth::user();

            return view('back.staff.add', ['user' => $user]);

        }

        public function staff_add_post(Request $request){

            $name = $request->input('name');
            $fullname = $request->input('fullname');
            $phone = $request->input('phone');
            $address = $request->input('address');
            $email = $request->input('email');
            $password = $request->input('password', '');
            $role_id = $request->input('role');


            if(strlen($password > 0)){
                $validated = $request->validate([
                    'name' => ['required', 'min:3'],
                    'fullname' => ['required'],
                    'phone' => ['required', 'size:10'],
                    'address' => ['required'],
                    'email' => ['required', 'unique:users'],
                    'password' => 'required|min:6',     
                ]);
            }else{
                $validated = $request->validate([
                    'name' => ['required', 'min:3'],
                    'fullname' => ['required'],
                    'phone' => ['required', 'size:10'],
                    'address' => ['required'],
                    'email' => ['required', 'unique:users'],    
                ]);
            }

            $new_user = new User;

            $new_user->name = $name;
            $new_user->fullname = $fullname;
            $new_user->phone = $phone;
            $new_user->address = $address;
            $new_user->email = $email;       
            if (strlen($password) > 0) {
                $new_user->password = Hash::make($password);
            }

            $Flag = $new_user->save();

            if($Flag){
                //
                $user_id = $new_user->id;
                
                $role = Role::find($role_id);
                $role->users()->attach($user_id);

                $users = User::all();
                return view('back.staff.list', ['users' => $users])->with('status', 'Thêm mới thành công!');
            }
        }

        //get: edit nhan vien
        public function staff_edit($id){
            $edit_user = User::find($id);
            $role_id = 0;
            foreach($edit_user->roles as $role){
                $role_id = $role->id;
                // dump($role); die;
            }
            return view('back.staff.edit', ['edit_user' => $edit_user, 'role_id' => $role_id]);
        }

        public function staff_edit_post(Request $request, $id, $old_role_id){

            $name = $request->input('name');
            $fullname = $request->input('fullname');
            $phone = $request->input('phone');
            $address = $request->input('address');
            $email = $request->input('email');
            $password = $request->input('password', '');
            $role_id = $request->input('role');


            if(strlen($password > 0)){
                $validated = $request->validate([
                    'name' => ['required', 'min:3'],
                    'fullname' => ['required'],
                    'phone' => ['required', 'size:10'],
                    'address' => ['required'],
                    'email' => ['required'],
                    'password' => 'required|min:6',  
                    'role' => 'required',   
                ]);
            }else{
                $validated = $request->validate([
                    'name' => ['required', 'min:3'],
                    'fullname' => ['required'],
                    'phone' => ['required', 'size:10'],
                    'address' => ['required'],
                    'email' => ['required'],    
                    'role' => 'required',
                ]);
            }

            $edit_user = User::find($id);

            $edit_user->name = $name;
            $edit_user->fullname = $fullname;
            $edit_user->phone = $phone;
            $edit_user->address = $address;
            $edit_user->email = $email;       
            if (strlen($password) > 0) {
                $edit_user->password = Hash::make($password);
            }

            $Flag = $edit_user->save();

            if($Flag){
                //
                $user_id = $edit_user->id;
                
                if($role_id != $old_role_id){
                    $role = Role::find($role_id);
                    $role->users()->attach($user_id);
                    $old_role = Role::find($old_role_id);
                    $old_role->users()->detach($user_id);
                }
                $users = User::all();
                return view('back.staff.list', ['users' => $users])->with('status', 'Chỉnh sửa thành công!');
            }else{
                return view('back.staff.list')->with('status', 'Chỉnh sửa không thành công!');
            }
        }

        public function staff_delete($id){
            $edit_user = User::findOrFail($id);
            foreach($edit_user->roles as $role){
                $role_id = $role->id;
                // dump($role); die;
            }
            return view('back.staff.delete', ['edit_user' => $edit_user, 'role_id' => $role_id])->with('status', 'Xóa nhân viên này?');
        }

        public function staff_destroy($id){

            $user = User::findOrFail($id);
            $user->delete();
            $users = User::all();
            return view('back.staff.list', ['users' => $users])->with('status', 'Xóa thành công!');

        }

        //system
        public function system(){

            $data = [];
            $name = System::where('status', 1)->where('code', 'name')->first();
            $logo = System::where('status', 1)->where('code', 'logo')->first();
            $favicon = System::where('status', 1)->where('code', 'favicon')->first();
            $phone = System::where('status', 1)->where('code', 'phone')->first();
            $email = System::where('status', 1)->where('code', 'email')->first();
            $address = System::where('status', 1)->where('code', 'address')->first();
            $copyright = System::where('status', 1)->where('code', 'copyright')->first();
            $map = System::where('status', 1)->where('code', 'map')->first();

            $data['name'] = $name;
            $data['logo'] = $logo;
            $data['favicon'] = $favicon;
            $data['phone'] = $phone;
            $data['email'] = $email;
            $data['address'] = $address;
            $data['copyright'] = $copyright;
            $data['map'] = $map;
            
            return view('back.system.system', $data);
        }

        public function system_post(Request $request){

            $data = [];
            $new_name = $request->input('name');
            $logo = $request->input('logo');
            $favicon = $request->input('favicon');
            $new_phone = $request->input('phone');
            $new_email = $request->input('email');
            $new_address = $request->input('address');
            $new_copyright = $request->input('copyright');
            $new_map = $request->input('map');

            System::where('code', 'name')->update(['description' => $new_name]);
            System::where('code', 'phone')->update(['description' => $new_phone]);
            System::where('code', 'email')->update(['description' => $new_email]);
            System::where('code', 'address')->update(['description' => $new_address]);
            System::where('code', 'copyright')->update(['description' => $new_copyright]);
            System::where('code', 'map')->update(['description' => $new_map]);

            if(!empty($request->file('logo'))){
                $logo = System::where('code', 'logo')->first();
                $name = $request->file('logo')->getClientOriginalName();
                $request->file('logo')->move('be-assets/img/system/', $name);

                $logo->description = $name;
                $logo->save();
            }

            if(!empty($request->file('favicon'))){
                $favicon = System::where('code', 'favicon')->first();
                $name = $request->file('favicon')->getClientOriginalName();
                $request->file('favicon')->move('be-assets/img/system/', $name);

                $favicon->description = $name;
                $favicon->save();
            }

            $name = System::where('status', 1)->where('code', 'name')->first();
            $logo = System::where('status', 1)->where('code', 'logo')->first();
            $favicon = System::where('status', 1)->where('code', 'favicon')->first();
            $phone = System::where('status', 1)->where('code', 'phone')->first();
            $email = System::where('status', 1)->where('code', 'email')->first();
            $address = System::where('status', 1)->where('code', 'address')->first();
            $copyright = System::where('status', 1)->where('code', 'copyright')->first();
            $map = System::where('status', 1)->where('code', 'map')->first();

            $data['name'] = $name;
            $data['logo'] = $logo;
            $data['favicon'] = $favicon;
            $data['phone'] = $phone;
            $data['email'] = $email;
            $data['address'] = $address;
            $data['copyright'] = $copyright;
            $data['map'] = $map;
            
            return view('back.system.system', $data)->with('status', 'Cập nhật hệ thống thành công!');
        }

        public function page_list(){
            $page = Page::all();
            return view('back.page.page_list',['page' => $page]);
        }

        public function page_edit(Request $request, $id){
            $page = Page::findOrFail($id);
            return view('back.page.page_edit', ['page' => $page]);
        }

        public function page_edit_post(Request $request, $id){
            $page = Page::findOrFail($id);
            $page->name = $request->input('name');
            $page->alias = $request->input('alias');
            $page->status = $request->input('status');
            $page->font = $request->input('font');
            $page->sort = $request->input('sort');
            $page->MetaTitle = $request->input('MetaTitle');
            $page->MetaDescription = $request->input('MetaDescription');
            $page->MetaKeyword = $request->input('MetaKeyword');
            $page->description = $request->input('description');

            if($request->hasFile("images")){
                $file = $request->file("images");
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit.'_'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());
                $endfile = ['png', 'jpg', 'svg', 'jpeg'];

                if(!in_array($duoi, $endfile)){
                    return back()->with(['flash_level' => 'danger', 'flash_message' => 'Không hỗ trợ kiểu ảnh này!']);
                }

                if($page->images != ''){
                    if(file_exists('be-assets/img/page/'.$page->images)){
                        unlink('be-assets/img/page/'.$page->images);
                    }
                }

                // $img = base_path('public/cat7.jpg'); dd($img);

                // $img = Image::make('public/cat7.jpg');dd($img);

                $filePath = 'be-assets/img/page/'.date('Ymd');
                if(!file_exists($filePath)){
                    mkdir('be-assets/img/page/'.date('Ymd'));
                }

                $file->move($filePath, $name);
                $img_name = $filePath.'/'.$name; echo($img_name);
                // die;
                // $img->fit(400, 300);
                // $img->save('/be-assets/img/news'.date('Ymd').'/'.$name);
                $img = ImageManagerStatic::make($img_name)->resize(300,250);
                $img->save(); 
                // die;
                // if(file_exists('be-assets/images/news/'.$name)){
                //     unlink('be-assets/images/news/'.$name);
                // }

                $page->images = date('Ymd').'/'.$name;
            }

            $page->save();

            $page = Page::all();

            return view('back.page.page_list', ['page' => $page]);
        }


        //Social
        public function social_list(){
            $social = Social::all();
            return view('back.social.social_list', ['social' => $social]);
        }

        public function social_edit($id){
            $social = Social::findOrFail($id);
            return view('back.social.social_edit', ['social' => $social]);
        }

        public function social_edit_post(Request $request ,$id){
            $social = Social::findOrFail($id);
            $social->name = $request->input('name');
            $social->status = $request->input('status');
            $social->font = $request->input('font');
            $social->sort = $request->input('sort');
            $social->alias = $request->input('alias');
            $social->save();
            $social = Social::all();

            return view('back.social.social_list', ['social' => $social]);
        }


        //email khuyen mai
        public function newletters_list(){
            $newletters = Newletter::all();
            return view('back.newletters.newletters_list', ['newletters' => $newletters]);
        }

        public function newletters_edit($id){
            $newletter = Newletter::findOrFail($id);
            return view('back.newletters.newletters_edit', ['newletter' => $newletter]);
        }

        public function newletters_edit_post(Request $request ,$id){
            $email = $request->input('email');
            $seen = $request->input('seen');
 
            Newletter::where('id', $id)->update(['email' => $email, 'seen' => $seen]);
            $newletters = Newletter::all();

            return view('back.newletters.newletters_list', ['newletters' => $newletters]);
        }

        public function newletters_delete($id){
            $newletter = Newletter::findOrFail($id);
            $newletter->delete();
            $newletters = Newletter::all();

            return redirect("/admin/newletters/list", ['newletters' => $newletters]);
        }

        //lien he
        public function contact_list(){
            $contact = Contact::orderBy('id', 'desc')->get();
            return view('back.contact.contact_list', ['contact' => $contact]);
        }

        public function contact_edit($id){
            $contact = Contact::findOrFail($id);
            return view('back.contact.contact_edit', ['contact' => $contact]);
        }

        public function contact_edit_post(Request $request ,$id){

            $name = $request->input('name'); 
            $email = $request->input('email'); 
            $phone = $request->input('phone'); 
            $message = $request->input('message');

            Contact::where('id', $id)->update(['name' => $name, 'email' => $email, 'phone' => $phone, 'message' => $message]);
 
            $contact = Contact::all();

            return view('back.contact.contact_list', ['contact' => $contact]);
        }

        public function contact_delete($id){
            $contact = Contact::findOrFail($id);
            $contact->delete();
            $contact = Contact::all();

            return view("back.contact.contact_list", ['contact' => $contact]);
        }

        //
        public function news_cat_list(){
            $news_cat = NewsCategory::all();
            return view('back.news.cat_list', ['news_cat' => $news_cat]);
        }

        public function news_cat_getedit($id){
            $newCategory = NewsCategory::findOrFail($id);
            return view('back.news.cat_edit', ['newCategory' => $newCategory]);
        }

        public function news_cat_edit(Request $request, $id){
            $name = $request->input('name');
            $status = $request->input('status');

            $newCategory = NewsCategory::findOrFail($id);
            $newCategory->name = $name;
            $newCategory->status = $status;
            $newCategory->save();;
            $news_cat = NewsCategory::all();
            return view('back.news.cat_list', ['news_cat' => $news_cat]);
        }

        //
        public function news_list(){
            // $news = DB::table('news')->orderBy('id', 'DESC')->get();
            // orderBy lay tin tu moi nhat den cu nhat
            $news = News::orderBy('id', 'desc')->get();
            return view('back.news.list', ['news' => $news]);
        }

        public function news_add(){
            $newsCategory = DB::table('news_cat')->get();
            // $newsCategory = NewsCategory::all();dd($newsCategory);
            return view('back.news.add', ['newsCategory' => $newsCategory]);
        }

        public function news_add_post(Request $request){
            $news = new News;
            $news->name = $request->input('name');
            $news->alias = $request->input('alias');
            $news->Cat_id = $request->input('Cat_id');
            $news->status = $request->input('status');
            $news->MetaTitle = $request->input('MetaTitle');
            $news->MetaDescription = $request->input('MetaDescription');
            $news->MetaKeyword = $request->input('MetaKeyword');
            $news->smallDescription = $request->input('smallDescription');
            $news->description = $request->input('description');

            if($request->hasFile("images")){
                $file = $request->file("images");
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit.'_'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());
                $endfile = ['png', 'jpg', 'svg', 'jpeg'];

                if(!in_array($duoi, $endfile)){
                    return back()->with(['flash_level' => 'danger', 'flash_message' => 'Không hỗ trợ kiểu ảnh này!']);
                }

                // $img = base_path('public/cat7.jpg'); dd($img);

                // $img = Image::make('public/cat7.jpg');dd($img);

                $filePath = 'be-assets/img/news/'.date('Ymd');
                if(!file_exists($filePath)){
                    mkdir('be-assets/img/news/'.date('Ymd'));
                }

                $file->move($filePath, $name);
                $img_name = $filePath.'/'.$name; echo($img_name);
                // die;
                // $img->fit(400, 300);
                // $img->save('/be-assets/img/news'.date('Ymd').'/'.$name);
                $img = ImageManagerStatic::make($img_name)->resize(240,140);
                $img->save(); 
                // die;
                // if(file_exists('be-assets/images/news/'.$name)){
                //     unlink('be-assets/images/news/'.$name);
                // }

                $news->images = date('Ymd').'/'.$name;
            }

            $news->save();
            
            $news = News::orderBy('id', 'desc')->get();
            return view('back.news.list', ['news' => $news]);
        }
        
        public function news_edit($id){
            // $news = DB::table('news')->orderBy('id', 'DESC')->get();
            // orderBy lay tin tu moi nhat den cu nhat
            $news = News::findOrFail($id); 
            $news_cat = NewsCategory::all();
            return view('back.news.edit', ['news' => $news, 'newsCategory' => $news_cat]);
        }

        public function news_edit_post(Request $request, $id){
            $news = News::findOrFail($id);
            $news->name = $request->input('name');
            $news->alias = $request->input('alias');
            $news->Cat_id = $request->input('Cat_id');
            $news->status = $request->input('status');
            $news->MetaTitle = $request->input('MetaTitle');
            $news->MetaDescription = $request->input('MetaDescription');
            $news->MetaKeyword = $request->input('MetaKeyword');
            $news->smallDescription = $request->input('smallDescription');
            $news->description = $request->input('description');

            if($request->hasFile("images")){
                $file = $request->file("images");
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit.'_'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());
                $endfile = ['png', 'jpg', 'svg', 'jpeg'];

                if(!in_array($duoi, $endfile)){
                    return back()->with(['flash_level' => 'danger', 'flash_message' => 'Không hỗ trợ kiểu ảnh này!']);
                }

                if($news->images != ''){
                    if(file_exists('be-assets/img/news/'.$news->images)){
                        unlink('be-assets/img/news/'.$news->images);
                    }
                }

                $filePath = 'be-assets/img/news/'.date('Ymd');
                if(!file_exists($filePath)){
                    mkdir('be-assets/img/news/'.date('Ymd'));
                }

                $file->move($filePath, $name);
                $img_name = $filePath.'/'.$name; echo($img_name);
                // die;
                // $img->fit(400, 300);
                // $img->save('/be-assets/img/news'.date('Ymd').'/'.$name);
                $img = ImageManagerStatic::make($img_name)->resize(240,140);
                $img->save(); 
                // die;
                // $img->fit(400, 300);
                // $img->save('/be-assets/img/news'.date('Ymd').'/'.$name);

                // if(file_exists('be-assets/images/news/'.$name)){
                //     unlink('be-assets/images/news/'.$name);
                // }

                $news->images = date('Ymd').'/'.$name;
            }
            
            $news->save();
            
            $news = News::orderBy('id', 'desc')->get();
            return view('back.news.list', ['news' => $news]);
        }

        public function news_delete($id){
            $new = News::findOrFail($id);
            $newsCategory = NewsCategory::all();
            return view('back.news.delete', ['news' => $new, 'newsCategory' => $newsCategory]);
        }

        public function news_destroy($id){
            $new = News::findOrFail($id);
            if(file_exists('be-assets/img/news/'.$new->images)){
                unlink('be-assets/img/news/'.$new->images);
            }
            $new->delete();
            $new = News::all();
            return view('back.news.list', ['news' => $new]);
        }


        //
        public function slider_list(){
            // $news = DB::table('news')->orderBy('id', 'DESC')->get();
            // orderBy lay tin tu moi nhat den cu nhat
            $sliders = Slider::where('status', 1)->orderBy('id', 'desc')->get();
            return view('back.slider.list', ['sliders' => $sliders]);
        }

        public function slider_add(){
            // $newsCategory = NewsCategory::all();dd($newsCategory);
            return view('back.slider.add');
        }

        public function slider_add_post(Request $request){
            $slider = new Slider;
            $slider->name = $request->input('name');
            $slider->alias = $request->input('alias');
            $slider->status = $request->input('status');
            $slider->sort = $request->input('sort');

            if($request->hasFile("images")){
                $file = $request->file("images");
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit.'_'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());
                $endfile = ['png', 'jpg', 'svg', 'jpeg'];

                if(!in_array($duoi, $endfile)){
                    return back()->with(['flash_level' => 'danger', 'flash_message' => 'Không hỗ trợ kiểu ảnh này!']);
                }

                // $img = base_path('public/cat7.jpg'); dd($img);

                // $img = Image::make('public/cat7.jpg');dd($img);

                $filePath = 'be-assets/img/slider/'.date('Ymd');
                if(!file_exists($filePath)){
                    mkdir('be-assets/img/slider/'.date('Ymd'));
                }

                $file->move($filePath, $name);
                $img_name = $filePath.'/'.$name;
                // die;
                // $img->fit(400, 300);
                // $img->save('/be-assets/img/news'.date('Ymd').'/'.$name);
                $img = ImageManagerStatic::make($img_name)->resize(1366,540);
                $img->save(); 
                // die;
                // if(file_exists('be-assets/images/news/'.$name)){
                //     unlink('be-assets/images/news/'.$name);
                // }

                $slider->images = date('Ymd').'/'.$name;
            }

            $slider->save();
            
            $sliders = Slider::where('status', 1)->orderBy('id', 'desc')->get();
            return view('back.slider.list', ['sliders' => $sliders]);
        }
        
        public function slider_edit($id){
            // $news = DB::table('news')->orderBy('id', 'DESC')->get();
            // orderBy lay tin tu moi nhat den cu nhat
            $slider = Slider::findOrFail($id); 
            return view('back.slider.edit', ['slider' => $slider]);
        }

        public function slider_edit_post(Request $request, $id){
            $slider = Slider::findOrFail($id);
            $slider->name = $request->input('name');
            $slider->alias = $request->input('alias');
            $slider->status = $request->input('status');
            $slider->sort = $request->input('sort');

            if($request->hasFile("images")){
                $file = $request->file("images");
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit.'_'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());
                $endfile = ['png', 'jpg', 'svg', 'jpeg'];

                if(!in_array($duoi, $endfile)){
                    return back()->with(['flash_level' => 'danger', 'flash_message' => 'Không hỗ trợ kiểu ảnh này!']);
                }

                // $img = base_path('public/cat7.jpg'); dd($img);

                // $img = Image::make('public/cat7.jpg');dd($img);

                $filePath = 'be-assets/img/slider/'.date('Ymd');
                if(!file_exists($filePath)){
                    mkdir('be-assets/img/slider/'.date('Ymd'));
                }

                $file->move($filePath, $name);
                $img_name = $filePath.'/'.$name;
                // die;
                // $img->fit(400, 300);
                // $img->save('/be-assets/img/news'.date('Ymd').'/'.$name);
                $img = ImageManagerStatic::make($img_name)->resize(1366,540);
                $img->save(); 
                // die;
                // if(file_exists('be-assets/images/news/'.$name)){
                //     unlink('be-assets/images/news/'.$name);
                // }

                $slider->images = date('Ymd').'/'.$name;
            }

            $slider->save();
            
            $sliders = Slider::where('status', 1)->orderBy('id', 'desc')->get();
            return view('back.slider.list', ['sliders' => $sliders]);
        }

        public function slider_delete($id){
            $slider = Slider::findOrFail($id);
            return view('back.slider.delete', ['slider' => $slider]);
        }

        public function slider_destroy($id){
            $slider = Slider::findOrFail($id);
                if(file_exists('be-assets/img/slider/'.$slider->images)){
                    unlink('be-assets/img/slider/'.$slider->images);
                }
            $slider->delete();
            $sliders = Slider::where('status', 1)->orderBy('id', 'desc')->get();
            return view('back.slider.list', ['sliders' => $sliders]);
        }

}



