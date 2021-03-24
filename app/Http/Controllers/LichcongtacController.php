<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Lichcongtac;
use App\User;
use Redirect;
use Validator;
use App\Section;
use Calendar;
use Illuminate\Support\Facades\Auth;
class LichcongtacController extends Controller
{        
    public function index(){      
        $events = Lichcongtac::all();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = \Calendar::event(
                $event->event_name,
                false,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date.' +1 day'),
                $event->id,
                [
                    'color' => $event->color,
                ]
            );
    	}
    	$calendar_details = \Calendar::addEvents($event_list); 
 
        return view('admin.lichcongtac.lichcongtac', compact('calendar_details') );
    }
    public function addEvent(Request $request)
    {
        $name = Auth::user()->name;
        $event =new Lichcongtac;
        $event->event_name = $name.': '.$request['event_name'];
        $event->color = $request['color'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->save();

        return redirect('lichcongtac')->with('status','Thêm "' . $request->event_name. '" thành công');
    }
    public function getaddEvent(){      
        return view('admin.lichcongtac.addlichcongtac' );
    }
    public function listEvent(){      
        $lichcongtac=Lichcongtac::orderBy('id','desc')->get();
        return view('admin.lichcongtac.danhsachlichcongtac',['lichcongtac'=>$lichcongtac]);
    }
    public function delete($id){
        Lichcongtac::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }
    public static function saveLichcongtac($request,$item,$action){
        DB::beginTransaction();
        try {    
            $item->event_name = $request->event_name;
            $item->color = $request->color;
            $item->start_date = $request->start_date;
            $item->end_date = $request->end_date;
            $item->save();   
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function getEditEvent($id){
        $item = Lichcongtac::find($id);
        return view('admin.lichcongtac.editlichcongtac',['item' => $item]);
    }
    public function postEditEvent(Request $request,$id){
        $item = Lichcongtac::find($id);
        $item->event_name =$request['event_name'];
        $item->color = $request['color'];
        $item->start_date = $request['start_date'];
        $item->end_date = $request['end_date'];
        if($this->saveLichcongtac($request,$item,"edit")){
            return redirect('lichcongtac/'.$item->id.'/edit')->with('status','Đã sửa "' . $request->event_name. '" thành công!');
        }
        return redirect('lichcongtac/'.$item->id.'/edit')->with('status','Đã sửa "' . $request->event_name. '" không thành công!');
    }


}
