<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\HoSoHocVien;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class FixfileController extends Controller
{
    public function vn_to_str ($str){
        $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach($unicode as $nonUnicode=>$uni){ 
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ','_',$str);
        return $str;
    }
/////// doi ten
    // public function index($skip){
    //     $hosos = DB::table('hoso_hocviens')->orderby('id','desc')->skip($skip)->take(10)->get();
    //     foreach ($hosos as $hoso) {
    //         $timestamp = strtotime($hoso->created_at);
    //         $year = date("Y", $timestamp);
    //         $month = date("m", $timestamp);   

    //         $arrscan = array();
    //         if($hoso->scan_file){
    //             $scan_file = json_decode($hoso->scan_file);      
    //             foreach($scan_file as $scan){
    //                 $scana = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'scan/'.$scan;
    //                 $scanb = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'scan/'.$this->vn_to_str($scan);
    //                 rename( $scana, $scanb);
    //                 $fileup = $this->vn_to_str($scan);
    //                 array_push($arrscan,$fileup); 
    //             }
    //         }

    //         $arrcmnd = array();
    //         if($hoso->cmnd_file){
    //             $cmnd_file = json_decode($hoso->cmnd_file);      
    //             foreach($cmnd_file as $cmnd){
    //                 $cmnda = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'cmnd/'.$cmnd;
    //                 $cmndb = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'cmnd/'.$this->vn_to_str($cmnd);
    //                 rename( $cmnda, $cmndb);
    //                 $fileup = $this->vn_to_str($cmnd);
    //                 array_push($arrcmnd,$fileup); 
    //             }
    //         }

    //         $arrll = array();
    //         if($hoso->ll_file){
    //             $ll_file = json_decode($hoso->ll_file);      
    //             foreach($ll_file as $ll){
    //                 $lla = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'ll/'.$ll;
    //                 $llb = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'ll/'.$this->vn_to_str($ll);
    //                 rename( $lla, $llb);
    //                 $fileup = $this->vn_to_str($ll);
    //                 array_push($arrll,$fileup); 
    //             }
    //         }

    //         $arrhc = array();
    //         if($hoso->hc_file){
    //             $hc_file = json_decode($hoso->hc_file);      
    //             foreach($hc_file as $hc){
    //                 $hca = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'hc/'.$hc;
    //                 $hcb = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'hc/'.$this->vn_to_str($hc);
    //                 rename( $hca, $hcb);
    //                 $fileup = $this->vn_to_str($hc);
    //                 array_push($arrhc,$fileup); 
    //             }
    //         }

    //         $arrvs = array();
    //         if($hoso->vs_file){
    //             $vs_file = json_decode($hoso->vs_file);      
    //             foreach($vs_file as $vs){
    //                 $vsa = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'vs/'.$vs;
    //                 $vsb = 'uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/'.'vs/'.$this->vn_to_str($vs);
    //                 rename( $vsa, $vsb);
    //                 $fileup = $this->vn_to_str($vs);
    //                 array_push($arrvs,$fileup); 
    //             }
    //         }

    //         DB::table('hoso_hocviens')
    //         ->where('id', $hoso->id)
    //         ->update([
    //             'scan_file' => json_encode($arrscan),
    //             'cmnd_file' => json_encode($arrcmnd),
    //             'll_file' => json_encode($arrll),
    //             'hc_file' => json_encode($arrhc),
    //             'vs_file' => json_encode($arrvs),
    //             ]);
    //         echo "edit file" . $hoso->id . '-' .$hoso->hoten. '<br>';
    //     }
    // }
    

// basecode64 to images
    public function index($skip){
        $hosos = DB::table('hoso_hocviens')->orderby('id','desc')->skip($skip)->take(20)->get();
        // DB::table('hoso_hocviens')
        // ->where('id', $hoso->id)
        // ->update([
        //     'scan_file' => json_encode($arrscan),
        //     'cmnd_file' => json_encode($arrcmnd),
        //     'll_file' => json_encode($arrll),
        //     'hc_file' => json_encode($arrhc),
        //     'vs_file' => json_encode($arrvs),
        //     ]);
        // echo "edit file" . $hoso->id . '-' .$hoso->hoten. '<br>';
        // Nghiem_3_1501.png/
        foreach ($hosos as $hoso) {
            //  echo $hoso->id.'&nbsp;'.$hoso->hinhanh.'<br>';

            $image = $hoso->hinhanh;
            $name_image = $this->vn_to_str($hoso->hoten);
            $timestamp_image = strtotime($hoso->created_at);
            $year_image = date("Y", $timestamp_image);
            $month_image = date("m", $timestamp_image);
            $day_image = date("d", $timestamp_image);
            if (strlen($image) >= 100){
                $id_image = $day_image.$month_image;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = $name_image."_".$id_image . '.png';    
                Storage::disk('local')->put("/".$year_image."/".$month_image."/".$imageName, base64_decode($image));
                // $hoso->hinhanh = $imageName;
            }else{
                $imageName = $image;
            }

            DB::table('hoso_hocviens')
            ->where('id', $hoso->id)
            ->update([
                'hinhanh' => $imageName,
            ]);
        }
    }
    
}
