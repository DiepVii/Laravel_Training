<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Gallery_image;
use Exception;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function welcome()
    {
        $admin = Admin::all();
        return view('welcome')->with(compact('admin'));
    }
    public function add_manage()
    {
        return view('admin.add_manage');
    }
    public function save_manage(Request $request)
    {
        $data = $request->all();

        if (isset($data['image'])) {
            $file = $request->file('image');

            $rand = '';;
            for ($x = 0; $x < 5; $x++) {
                $rand .= rand(0, 9999);
            }
            $file_name = $rand . $file->getClientOriginalName();
            $request->image->move(public_path('/frontend/images/'), $file_name);
            $file_path = ('/frontend/images/') . $file_name;
            // echo($file_path);
            $user = Admin::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'image' => $file_path,
            ]);
        } else {
            $user = Admin::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
            ]);
        }

        return redirect('/');
    }
    public function edit_manage($id)
    {
        $admin = Admin::find($id);
        return view('admin.edit_manage')->with(compact('admin'));
    }
    public function update_manage(Request $request, $id)
    {
        $data = $request->all();
        $admin = Admin::find($id);
        Admin::where('id', $id)
            ->update([
                'name' => $data['name'],
                'phone' => $data['phone']
            ]);
        if (isset($data['image'])) {
            $file = $request->file('image');

            $rand = '';;
            for ($x = 0; $x < 5; $x++) {
                $rand .= rand(0, 9999);
            }
            $file_name = $rand . $file->getClientOriginalName();
            $request->image->move(public_path('/frontend/images/'), $file_name);
            $file_path = ('/frontend/images/') . $file_name;
            // echo($file_path);
            if (isset($admin->image)) {
                unlink(public_path($admin->image));
            }
            $admin->image = $file_path;
        }
        $admin->save();
        return redirect('/');
    }
    public function delete_manage($id)
    {
        $admin = Admin::find($id);
        if (isset($admin->image)) {
            unlink(public_path($admin->image));
        }
        $admin->delete();
        return redirect('/');
    }
    public function view_gallery_image($id)
    {
        $gallery_count = Gallery_image::where('admin_id', $id)->count();
        $gallery = Gallery_image::where('admin_id', $id)->get();
        return view('gallery_image.show_gallery_image')->with(compact('id', 'gallery_count', 'gallery'));
    }

    public function save_gallery_image(Request $request)
    {
        $data = $request->all();
        $rand = '';;
        for ($x = 0; $x < 5; $x++) {
            $rand .= rand(0, 9999);
        }
        if (isset($data['images'])) {
            $files = $request->file('images');
            $path = public_path() . '/frontend/images/' . $data['id'];
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path, $mode = 0777, true, true);
            }
            foreach ($files as $file) {
                $file_name = $rand . $file->getClientOriginalName();
                $file->move($path, $file_name);
                $file_path = ('frontend/images/') . $data['id'] . '/' . $file_name;
                Gallery_image::create([
                    'gallery_image' => $file_path,
                    'admin_id' => $data['id'],
                    'gallery_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->back();
    }
    public function edit_gallery_image(Request $request)
    {
        $data = $request->all();
        $gallery = Gallery_image::find($data['id']);
        $rand = '';;
        for ($x = 0; $x < 5; $x++) {
            $rand .= rand(0, 9999);
        }
        $files = $request->file('image');
        $path = public_path() . '/frontend/images/' . $gallery->admin_id;

        $file_name = $rand . $files->getClientOriginalName();
        $files->move($path, $file_name);
        $file_path = ('frontend/images/') . $gallery->admin_id . '/' . $file_name;

        unlink(public_path($gallery->gallery_image));
        // update database
        $gallery->gallery_name = $file_name;
        $gallery->gallery_image = $file_path;
        $gallery->save();


        return redirect()->back();
    }

    public function delete_gallery_image($id)
    {
        $gallery = Gallery_image::find($id);
        $gallery->delete();
        unlink(public_path($gallery->gallery_image));
        return redirect()->back();
    }
}
