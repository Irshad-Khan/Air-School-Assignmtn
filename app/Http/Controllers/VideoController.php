<?php

namespace App\Http\Controllers;

use App\Http\Repositories\VideoRepository;
use App\Http\Requests\VideoStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = (new VideoRepository())->allWithPaginate(2);
        return view('videos.index', compact('videos'));
    }

    public function upload(VideoStoreRequest $request)
    {
        $file = $request->file('video');
        $filename = $file->getClientOriginalName();
        $path = public_path().'/uploads/';
        $file->move($path, $filename);
        $request->request->add(['user_id' => Auth::id()]);
        (new VideoRepository())->create(array_merge($request->except('video'), ['video' => $filename]));

        session()->flash('success', 'Video Uploaded Successfully');
        return redirect()->route('videos.index');
    }

    public function delete($id)
    {
        (new VideoRepository())->delete($id);
        session()->flash('success', 'Video Deleted Successfully');
        return redirect()->back();
    }
}
