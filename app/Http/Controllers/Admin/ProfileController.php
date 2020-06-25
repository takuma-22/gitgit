<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller{
    public function add(){
        return view('admin.profile.create');
    }
    
    public function create(Request $request){
        
        $this->validate($request,Profile::$rules);
        
        $profiles= new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        
        $profiles->fill($form);
        $profiles->save();
        
        return redirect('admin/profile/create');
    }
    
    public function index(Request $request){
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Profile::where('name', $cond_title)->get();
        } 
            else {
                $posts = Profile::all();
            }
            return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
        
    }
    
    public function edit(Request $request){
        $profiles= Profile::find($request->id);
        return view('admin.profile.edit',['profile_form'=> $profiles]);
    }
    
    public function update(Request $request){
        $this->validate($request, Profile::$rules);
        $profiles= Profile::find($request->id);
        $profile_form = $request->all();
      
        unset($profile_form['_token']);
        $profiles->fill( $profile_form )->save();
        $profilehistory = new ProfileHistory;
        $profilehistory->profile_id = $profiles->id;
        $profilehistory->edited_at = Carbon::now();
        $profilehistory->save();
        return redirect('admin/profile/edit?id=' . $profiles->id );
      
    }
}
