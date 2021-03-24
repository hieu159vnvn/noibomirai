<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Video;
use App\User;

class VideoController extends Controller
{        
    public function getVideo(){    
        $video = Video::orderBy('id','desc')->get();
        return view('admin.miraihuman.video.video',['video' => $video]);
    }
    public function getAddVideo(){ 
        return view('admin.miraihuman.video.add_video');
    } 
    public static function saveVideo($request,$video,$action){
        DB::beginTransaction();
        try {    
            $video->ten = $request->ten;
            $video->tenjp = $request->tenjp;
            $video->video = strstr($request->video, 'miraiuploads/');  
            $video->loai = $request->loai;
            $video->link = $request->link;
            $video->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $video->sapxep = 0;
            }else{
                $video->sapxep = $request->sapxep;
            }           
            $video->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddVideo(Request $request){
        $video = new Video;
        $video->slug =  str_slug($request->ten, '-');
        if($this->saveVideo($request,$video,"add")){
            $lastid = Video::orderBy('id', 'desc')->first();
            return redirect('video/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('video')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditVideo($id){
        $video = Video::find($id);
        return view('admin.miraihuman.video.edit_video',['video' => $video]);
    }
    public function postEditVideo(Request $request,$id){
        $video = Video::find($id);
        $video->slug =  str_slug($request->slug, '-');
        if($this->saveVideo($request,$video,"edit")){
            return redirect('video/'.$video->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('video/'.$video->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeleteVideo($id){
        Video::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $video = Video::find($id);
        $video->stt = $request->status;
        $video->save();
        return $request->status;
    }

}
