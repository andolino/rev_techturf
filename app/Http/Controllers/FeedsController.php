<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Request;
use App\Models\Teachers;
use App\Models\Students;
use App\Models\TeacherFeeds;
use App\Models\TeacherFeedsAttachments;
use Auth;
use DB;

class FeedsController extends Controller{


    public function postTeacherFeeds(Request $request){
        // return response()->json(['message'=>'route reached'], 200);

        if ($request->file('file')) {
            /**
             * For Single Upload
             */
            //get name of file$file     = $request->file('file');
            // $filename = $file->getClientOriginalName();
            // //strip out all spaces
            // $filename = str_replace(' ', '', $filename);
            
            // $path = $file->storeAs('uploads/teachers-feeds', $filename);
            // //store
            // // $path = $request->file('file')->store('uploads/teachers-feeds');
            // if ($path) {
            //     return response()->json(['message' => 'file uploaded'], 200);
            // }

            /**
             * Multiple file uplaod
             */
            $files = $request->file('file');
            if (!is_array($files)) {
                $files = [$files];
            }

            $teachersFeeds = TeacherFeeds::create([
                'teacher_id' => $request->teacher_id,
                'feed_title' => '',
                'feed_body' => $request->feed_body
            ]);
            $teachersFeeds->save();
            //get last insert id
            $teacher_newsfeed_id = $teachersFeeds->id;
            
            //loop through the array
            for ($i=0; $i < count($files); $i++) { 
                $file = $files[$i];
                $filename = $file->getClientOriginalName();
                $filename = str_replace(' ', '', $filename);
                $path = $file->storeAs('uploads/teachers-feeds', $filename);
                $teacherFeedsAttchmts = TeacherFeedsAttachments::create([
                    'teacher_newsfeed_id' => $teacher_newsfeed_id,
                    'file' => $filename,
                ]);
                $teacherFeedsAttchmts->save();
            }
            return response()->json(['message' => 'file uploaded', 'data' => $request->all()], 200);
        } else{
            return response()->json(['message' => 'error uploading file'], 503);
        }
    }

    public function displayTeacherFeeds(Request $request){
        $teachers_id = $request->teachers_id;
        $data = DB::select(DB::raw("SELECT 
                                        tn.*,
                                        tna.file,
                                        t.lastname,
                                        t.firstname,
                                        t.middlename,
                                        t.rate_per_hr,
                                        t.email,
                                        GROUP_CONCAT(DISTINCT tna.file ORDER BY tna.file DESC SEPARATOR '==') as attmnts
                                    FROM teacher_newsfeed tn
                                    LEFT JOIN teacher_newsfeed_attachments tna ON tna.teacher_newsfeed_id = tn.id
                                    LEFT JOIN teachers t ON t.id = tn.teacher_id
                                    WHERE tn.teacher_id = $teachers_id 
                                    GROUP BY tn.id ORDER BY tn.id DESC"));
                                    // GROUP_CONCAT(DISTINCT test_score
                                    // ORDER BY test_score DESC SEPARATOR ' ')
        return response()->json($data);
    }





}
