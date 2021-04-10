<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Schedule;
use App\Models\Lesson;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use \Carbon\Carbon;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){
        date_default_timezone_set('Europe/Istanbul');
        $user = Auth::user();   
        // return 'Hi';
        if($user->type == 1){ // İdareci sayfası
            //return view('backend.dashboard')->with('user', $user->name);
            $dayName= date('l'); 
            $toDay = ''; 
            if($dayName == 'Monday') {$toDay = 'mon'; $frontDay = "Pazartesi";}
            elseif($dayName == 'Tuesday') {$toDay = 'tue'; $frontDay = "Salı";}
            elseif($dayName == 'Wednesday') {$toDay = 'wen'; $frontDay = "Çarşamba";}
            elseif($dayName == 'Thursday') {$toDay = 'thu'; $frontDay = "Perşembe";}
            elseif($dayName == 'Friday') {$toDay = 'fri'; $frontDay = "Cuma";}
            elseif($dayName == 'Saturday') {$toDay = 'sat'; $frontDay = "Cumartesi";}
            elseif($dayName == 'Sunday') {$toDay = 'sun'; $frontDay = "Pazar";}
            
            $dersiVarmi = Schedule::where('teacher', $user->id)->where($toDay, 1)->exists();
            if($dersiVarmi)
                return view('choose')->with('user', $user->name);
            else
                return view('backend.dashboard')->with('user', $user->name);
        }
        elseif($user->type == 2){ // Öğretmen sayfası
            $dayName= date('l'); 
            $toDay = ''; 
            $classes = []; $branches = []; $classes = []; $lessons = [];
            if($dayName == 'Monday') {$toDay = 'mon'; $frontDay = "Pazartesi";}
            elseif($dayName == 'Tuesday') {$toDay = 'tue'; $frontDay = "Salı";}
            elseif($dayName == 'Wednesday') {$toDay = 'wen'; $frontDay = "Çarşamba";}
            elseif($dayName == 'Thursday') {$toDay = 'thu'; $frontDay = "Perşembe";}
            elseif($dayName == 'Friday') {$toDay = 'fri'; $frontDay = "Cuma";}
            elseif($dayName == 'Saturday') {$toDay = 'sat'; $frontDay = "Cumartesi";}
            elseif($dayName == 'Sunday') {$toDay = 'sun'; $frontDay = "Pazar";}

            $schedule = Schedule::where('teacher', $user->id)->where($toDay, 1)->get();
            // $lesson = DB::table('lessons')->select('name')->where('id', $schedule[0]['lesson'])->first()->name;
            // return $lesson;
            $data = [];
            for($i=0;$i<count($schedule);$i++){
                $class = $schedule[$i]['class'];
                $branch = $schedule[$i]['branch'];
                $lesson = $schedule[$i]['lesson']; // ders adı için
                $lessonId = $schedule[$i]['lesson']; // ders id si
                $scheduleId = $schedule[$i]['id'];
                $lesson = DB::table('lessons')->select('name')->where('id', $lesson)->first()->name; // ders adı
                $info = DB::table('classes')->select('tur', 'department')->where('class', $class)->where('branch', $branch)->first();
                $students = DB::table('students')->select('number')->where('class', $class)->where('branch', $branch)->orderBy('number', 'asc')->get();
                $todayRolls = DB::table('rollcalls')->select('state')->where('class', $class)->where('branch', $branch)->where('schedule', $scheduleId)->whereDate('created_at', Carbon::today())->orderBy('number', 'asc')->get();
                $data[$i] = [
                    'id' => $schedule[$i]['id'],
                    'class' => $class . ' / ' . $branch,
                    'lesson' => $lesson,
                    'lessonId' => $lessonId,
                    'alan' => $info->department,
                    'tur' => $info->tur,
                    'students' => $students,
                    'scheduleId' => $scheduleId,
                    'status' => $todayRolls,
                ];
            } 
            $lessonsAll = DB::table('schedules')
                        ->join('lessons', 'schedules.lesson', '=', 'lessons.id')
                        ->select(DB::raw('schedules.lesson,concat(schedules.class, "/", schedules.branch) as class, lessons.name, schedules.id'))
                        ->where('teacher', $user->id)
                        ->orderBy('class', 'asc')
                        ->get();
            // dd($data);
            return view('home')->with('user', $user->name)->with('data', $data)->with('day', $frontDay)->with('lessonsAll', $lessonsAll);
        }
        elseif($user->type == 0){
            return 'Hem Yönetici Hem Öğretmen Sayfası';
        }
               
    }
    
    
    public function admin(){
        $user = Auth::user(); 
        return view('backend.dashboard')->with('user', $user->name);
    }

    public function frontEnd(){
        $user = Auth::user();   
        $dayName= date('l'); 
        $toDay = ''; 
        $classes = []; $branches = []; $classes = []; $lessons = [];
        if($dayName == 'Monday') {$toDay = 'mon'; $frontDay = "Pazartesi";}
        elseif($dayName == 'Tuesday') {$toDay = 'tue'; $frontDay = "Salı";}
        elseif($dayName == 'Wednesday') {$toDay = 'wen'; $frontDay = "Çarşamba";}
        elseif($dayName == 'Thursday') {$toDay = 'thu'; $frontDay = "Perşembe";}
        elseif($dayName == 'Friday') {$toDay = 'fri'; $frontDay = "Cuma";}
        elseif($dayName == 'Saturday') {$toDay = 'sat'; $frontDay = "Cumartesi";}
        elseif($dayName == 'Sunday') {$toDay = 'sun'; $frontDay = "Pazar";}

        $schedule = Schedule::where('teacher', $user->id)->where($toDay, 1)->get();
        // $lesson = DB::table('lessons')->select('name')->where('id', $schedule[0]['lesson'])->first()->name;
        // return $lesson;
        $data = [];
        for($i=0;$i<count($schedule);$i++){
            $class = $schedule[$i]['class'];
            $branch = $schedule[$i]['branch'];
            $lesson = $schedule[$i]['lesson']; // ders adı için
            $lessonId = $schedule[$i]['lesson']; // ders id si
            $scheduleId = $schedule[$i]['id'];
            $lesson = DB::table('lessons')->select('name')->where('id', $lesson)->first()->name; // ders adı
            $info = DB::table('classes')->select('tur', 'department')->where('class', $class)->where('branch', $branch)->first();
            $students = DB::table('students')->select('number')->where('class', $class)->where('branch', $branch)->orderBy('number', 'asc')->get();
            $todayRolls = DB::table('rollcalls')->select('state')->where('class', $class)->where('branch', $branch)->where('schedule', $scheduleId)->whereDate('created_at', Carbon::today())->orderBy('number', 'asc')->get();
            $data[$i] = [
                'id' => $schedule[$i]['id'],
                'class' => $class . ' / ' . $branch,
                'lesson' => $lesson,
                'lessonId' => $lessonId,
                'alan' => $info->department,
                'tur' => $info->tur,
                'students' => $students,
                'scheduleId' => $scheduleId,
                'status' => $todayRolls,
            ];
            
            $lessonsAll = DB::table('schedules')
                        ->join('lessons', 'schedules.lesson', '=', 'lessons.id')
                        ->select(DB::raw('schedules.lesson,concat(schedules.class, "/", schedules.branch) as class, lessons.name, schedules.id'))
                        ->where('teacher', $user->id)
                        ->orderBy('class', 'asc')
                        ->get();
        } 
        // dd($data);
        return view('home')->with('user', $user->name)->with('data', $data)->with('day', $frontDay)->with('lessonsAll', $lessonsAll);;
    }
    
    public function getStats(Request $request){
        $user = Auth::user();
        if($request->ajax()){
            // return $request;
            $sch = $request->sch;
            $stats = DB::table('rollcalls')
                        ->select(DB::raw("number, round((sum(state) / (select count(distinct created_at) from rollcalls where schedule = '$sch')) * 100) as ortalama"))
                        ->where('schedule', $request->sch)
                        
                        ->groupBy('number')
                        ->get();
            return $stats;
        }
    }
    
    public function getDateBase(Request $request){
        if($request->ajax()){
            //return $request->date;
            $data = DB::table('rollcalls')->whereDate('created_at', $request->date)->get();
            //return $data;
            $schBuffer = '';
            $extracted = [];
            //for($i=0; i<count($data);$i++){
            //    $here = 0; $notHere = 0; $total = 0;
            //}
            $totalRate = 0;
            foreach($data as $key => $item){
                $here = 0; $notHere = 0; $total = 0;
                if($schBuffer != $item->schedule){
                    $lesson = DB::table('lessons')->select('name')->where('id', $item->lesson)->first()->name;
                    $teacher = DB::table('users')->select('name')->where('id', $item->teacher)->first()->name;
                    $saveTime = Carbon::parse($item->created_at)->format('H:i');
                    $class = $item->class . '/' . $item->branch;
                    $buff = [];
                    /*
                    foreach($data as $sub){
                        //$sub->class == $item->class && $sub->branch == $item->branch 
                        if($sub->schedule == $item->schedule){
                            array_push($buff, $sub);
                        }
                    }
                    */
                    for($i=0; $i<count($data);$i++){
                        if($data[$i]->schedule == $item->schedule){
                            array_push($buff, $data[$i]);
                        }
                    }
                    //return array_search('1', array_column($buff, 'state'));
                    if(in_array('1', array_column($buff, 'state'))){
                        $here = array_count_values(array_column($buff, 'state'))[1];
                    }
                    else
                        $here = 0;
                        
                    if(in_array('0', array_column($buff, 'state'))){
                        $notHere = array_count_values(array_column($buff, 'state'))[0];
                    }
                    else
                        $notHere = 0;
                    
                    $total = $here + $notHere;
                    if($here != 0)
                        $rate = ($here / $total) * 100;
                    else
                        $rate = 0;
                    
                    $totalRate += $rate;
                    $row = [
                        'lesson' => $lesson,
                        'teacher' => $teacher,
                        'class' => $class,
                        'heres' => $here,
                        'notHere' => $notHere,
                        'rate' => round($rate),
                        'saveTime' => $saveTime
                    ];
                    array_push($extracted, $row) ;
                    $schBuffer = $item->schedule; // bunu sakın silme!
                }
            }
            if(count($extracted) != 0)
                $totalRate = floor($totalRate / count($extracted));
            else
                $totalRate = 0;
            return [$extracted, $totalRate];
        }   
    }

    public function getLessonBase(Request $request){
        if($request->ajax()){
            // return $request;
            $data = DB::table('rollcalls')->whereDate('created_at', $request->date)->where('class', $request->cls)->where('branch', $request->branch)->get();
            $schBuffer = '...';
            $extracted = [];
            foreach($data as $key => $item){
                if($schBuffer != $item->schedule){
                    $lesson = DB::table('lessons')->select('name')->where('id', $item->lesson)->first()->name;
                    $teacher = DB::table('users')->select('name')->where('id', $item->teacher)->first()->name;
                    $saveTime = Carbon::parse($item->created_at)->format('H:i');
                    $class = $item->class . '/' . $item->branch;
                    $buff = []; $gelmeyenler = [];
                    /*
                    foreach($data as $sub){ // tüm diziden mevcut sınıf ayrılıyor
                        if($sub->class == $item->class && $sub->branch == $item->branch){
                            array_push($buff, $sub);
                        }
                    }*/
                     for($i=0; $i<count($data);$i++){
                        if($data[$i]->schedule == $item->schedule){
                            array_push($buff, $data[$i]);
                        }
                    }
                    foreach($buff as $subb){
                        if($subb->state == 0){
                            array_push($gelmeyenler, $subb->number);
                        }
                    }
                    
                    //$here = array_count_values(array_column($buff, 'state'))[1]; // gelenlerin sayısı
                    //$notHere = array_count_values(array_column($buff, 'state'))[0]; // gelmeyenlerin sayısı
                    
                    if(in_array('1', array_column($buff, 'state'))){
                        $here = array_count_values(array_column($buff, 'state'))[1];
                    }
                    else
                        $here = 0;
                        
                    if(in_array('0', array_column($buff, 'state'))){
                        $notHere = array_count_values(array_column($buff, 'state'))[0];
                    }
                    else
                        $notHere = 0;
                    
                    $total = $here + $notHere; 
                    
                    //$rate = ($here / $total) * 100; // katılım oranı
                    if($here != 0)
                        $rate = ($here / $total) * 100;
                    else
                        $rate = 0;
                    $row = [
                        'lesson' => $lesson,
                        'teacher' => $teacher,
                        'class' => $class,
                        'heres' => $here,
                        'notHere' => $notHere,
                        'rate' => '% ' . round($rate),
                        'gelmeyenler' => implode(', ', $gelmeyenler),
                        'saveTime' => $saveTime
                    ];
                    array_push($extracted, $row) ;
                    $schBuffer = $item->schedule; // bunu sakın silme!
                }
            }


            return $extracted;
        }   
    }

    public function classes(){
        $classes = DB::table('classes')->get();
        return view('backend.classes')->with('classes', $classes);
    }   

    public function addClass(Request $request){
        if($request->ajax()){
            $data = array(
                'class' => $request->cls,
                'branch' => $request->branch,
                'department' => $request->dep,
                'tur' => $request->tur
            );
            $isExist = DB::table('classes')->where('class', $data['class'])->where('branch', $data['branch'])->exists();
            if($isExist != 1)
                $id = DB::table('classes')->insert($data);
            else{
                return 'var';
            }
            if($id > 0){
                echo 'Add Success';
            }
            else{
                echo 'hata!';
            }
        }
    }

    public function delClass(Request $request){
        if($request->ajax()){
            $id = $request->id;
            DB::table('classes')
                ->where('id', $request->id)
                ->delete();
            echo 'Deleted!';
        }
    }

    public function editClass(Request $request){
        if($request->ajax()){
            return 'Daha Hazır Değil';
        }
    }

    public function fetchClass(Request $request){
        if($request->ajax())
        {
            $data = DB::table('classes')
                    // ->groupBy('class')
                    ->orderBy('class','asc')
                    ->orderBy('branch','asc')
                    ->get();
            echo json_encode($data);
        }
        // $classes = DB::table('classes')->get();
        // return view('backend.classes')->with('classes', $classes);
    }

    public function addStudent(){
        $students = DB::table('students')->get();
        return view('backend.studentAdd')->with('students', $students);
    } 

    public function fetchStudents(Request $request){
        if($request->ajax())
        {
            $data = DB::table('students')
                    ->where('class', $request->cls)
                    ->where('branch', $request->branch)
                    ->orderBy('number','asc')
                    ->get();
            $info = DB::table('classes')
                    ->select('department', 'tur')
                    ->where('class', $request->cls)
                    ->where('branch', $request->branch)
                    ->get();
            return json_encode(array(
                'data' => $data,
                'info' => $info
            ));
            //return json_encode($data);
        }
        // $classes = DB::table('classes')->get();
        // return view('backend.classes')->with('classes', $classes);
    }

    public function saveStudents(Request $request){
        if($request->ajax()){
            $data = array(
                'number' => $request->number,
                'class' => $request->cls,
                'branch' => $request->branch,
            );
            if($request->type == 1){ // ekle
                $isExist = DB::table('students')->where('number', $request->number)->first();
                if($isExist == null){
                    $id = DB::table('students')->insert($data);
                    if($id > 0){
                        echo 'Add Success';
                    }
                    else{
                        echo 'hata!';
                    }
                }
                else{
                    return 0;
                } 
            }
            else if($request->type == 2){ // taşı
                $id = DB::table('students')->where('number', $request->number)->update(['class' => $request->cls, 'branch' => $request->branch]);
                if($id > 0){
                    echo 'Add Success';
                }
                else{
                    echo 'hata!';
                }
            }
             
        }
    }

    public function delStudent(Request $request){
        if($request->ajax()){
            $id = $request->id;
            DB::table('students')
                ->where('id', $request->id)
                ->delete();
            echo 'Deleted!';
        }
    }

    public function teachers(){
        $teachers = DB::table('users')->where('type', '2')->get();
        return view('backend.teachers')->with('classes', $teachers);
    } 

    public function fetchTeachers(Request $request){
        if($request->ajax())
        {
            $data = DB::table('users')->where('type', '2')->orWhere('type', '1')->orderBy('branch', 'asc')->orderBy('name', 'asc')->get();
            echo json_encode($data);
        }
        // $classes = DB::table('classes')->get();
        // return view('backend.classes')->with('classes', $classes);
    }

    public function addTeacher(Request $request){
        
        // $data = [
        //     'name' => $request->name,
        //     'type' => 2,
        //     'branch' => $request->branch,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ];
        // return $request->branch;
        $isExist = User::where('email', $request->email)->first();
        if($isExist === null){
            return DB::table('users')->insert([
                'name' => $request->name,
                'type' => $request->yetki,
                'branch' => $request->branch,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }
        else{
            return 'email var!';
        }
        
      
       
        
        

        // $students = DB::table('users')->get();
        // return view('backend.studentAdd')->with('students', $students);
    } 

    public function delTeacher(Request $request){
        if($request->ajax()){
            $id = $request->id;
            DB::table('users')
                ->where('id', $request->id)
                ->delete();
            echo 'Deleted!';
        }
    }

    public function updateTeacher(Request $request){
        //$isExist = User::where('email', $request->email)->first();
        // return $request;
        return DB::table('users')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'branch' => $request->branch,
                        'type' => $request->yetki,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
    } 

    public function lessons(){
        $lessons = DB::table('lessons')->get();
        return view('backend.lessons')->with('lessons', $lessons);
    }   

    public function addLesson(Request $request){
        if($request->ajax()){
            $data = array(
                'name' => $request->lesson,
            );
            
            $isExist = DB::table('lessons')->where('name', $data['name'])->exists();
            if($isExist != 1)
                $id = DB::table('lessons')->insert($data);
            else{
                return 'var';
            }
            
            if($id > 0){
                echo 'Add Success';
            }
            else{
                echo 'hata!';
            }
        }
    }

    public function delLesson(Request $request){
        if($request->ajax()){
            $id = $request->id;
            DB::table('lessons')
                ->where('id', $request->id)
                ->delete();
            echo 'Deleted!';
        }
    }

    public function fetchLessons(Request $request){
        if($request->ajax())
        {
            $data = DB::table('lessons')
                    ->orderBy('name','asc')
                    ->get();
            echo json_encode($data);
        }
        // $classes = DB::table('classes')->get();
        // return view('backend.classes')->with('classes', $classes);
    }

    public function updateLesson(Request $request){
        if($request->ajax()){
            return DB::table('lessons')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->lesson,
            ]);
        }
    }

    public function assign(){
        $schedules = DB::table('schedules')->get();
        $lessons = DB::table('lessons')->orderBy('name', 'asc')->get();
        $teachers = DB::table('users')->where('type', '2')->orWhere('type', '1')->get();

        return view('backend.assign')->with('schedules', $schedules)->with('lessons', $lessons)->with('teachers', $teachers);
    }   

    public function addAssign(Request $request){
        if($request->ajax()){
            $data = array(
                'teacher' => $request->teacher,
                'lesson' => $request->lesson,
                'class' => $request->cls,
                'branch' => $request->branch,
                'mon' => $request->mon,
                'tue' => $request->tue,
                'wen' => $request->wen,
                'thu' => $request->thu,
                'fri' => $request->fri,
                'sat' => $request->sat,
                'sun' => $request->sun,
            );
            // return $data;
            $isExist = Schedule::where('lesson', $request->lesson)->where('class', $request->cls)->where('branch', $request->branch)->first();
            
            if($isExist == null){
                $id = Schedule::insert($data);
                if($id > 0){
                    echo 'Add Success';
                }
                else{
                    echo 'hata!';
                }
            }
            else{
                return 'isFull';
            }
            
        }
    }

    public function delAssign(Request $request){
        if($request->ajax()){
            $id = $request->id;
            DB::table('schedules')
                ->where('id', $request->id)
                ->delete();
            echo 'Deleted!';
        }
    }

    public function fetchAssign(Request $request){
        if($request->ajax()){

            $schedules = DB::table('schedules')
                        ->orderBy('id','asc')
                        ->get();
            // return $schedules;
            $teachers = []; $lessons = []; $data = [];
            foreach($schedules as $item){
                $teacher = User::select('name')->where('id', $item->teacher)->first();
                $lesson = Lesson::select('name')->where('id', $item->lesson)->first();
                array_push($teachers, $teacher->name);
                array_push($lessons, $lesson->name);
            }
            for($i = 0; $i < count($schedules); $i++){
                $days = [
                    $schedules[$i]->mon, 
                    $schedules[$i]->tue, 
                    $schedules[$i]->wen, 
                    $schedules[$i]->thu, 
                    $schedules[$i]->fri, 
                    $schedules[$i]->sat, 
                    $schedules[$i]->sun, 
                ];
                $days = implode(',', $days);
                $buffer = [
                    'class' => $schedules[$i]->class,
                    'branch' => $schedules[$i]->branch,
                    'lesson' => $lessons[$i],
                    'teacher' => $teachers[$i],
                    'edit' => '<td> <button class="edit btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal" data-lesson="' . $schedules[$i]->lesson . '" data-teacher="' . $schedules[$i]->teacher . '" data-branch="' . $schedules[$i]->branch . '" data-class="' . $schedules[$i]->class . '" data-days="' . $days . '" data-id="' . $schedules[$i]->id . '">Düzenle</button></td>',
                    'delete' => '<td> <button class="delete btn btn-danger btn-sm" data-id="' . $schedules[$i]->id . '">X</button></td>',
                ];
                array_push($data, $buffer);
            }
            return $data;
        }
    }

    public function updateAssign(Request $request){
        if($request->ajax()){
            $data = array(
                'teacher' => $request->teacher,
                'lesson' => $request->lesson,
                'class' => $request->cls,
                'branch' => $request->branch,
                'mon' => $request->mon,
                'tue' => $request->tue,
                'wen' => $request->wen,
                'thu' => $request->thu,
                'fri' => $request->fri,
                'sat' => $request->sat,
                'sun' => $request->sun,
            );
            // return $data;
            
            $id = DB::table('schedules')->where('id', $request->id)->update($data);
            if($id > 0){
                echo 'Add Success';
            }
            else{
                echo 'hata!';
            }
            
        }
    }

    public function setRollCall(Request $request){
        if($request->ajax()){
            // return $request;
            $call = $request->roll;
            $info = explode(' / ', $request->class);
            $class = $info[0]; $branch = $info[1];
            $data = []; $state;
            foreach($call as $item){
                if($item[1] == 'true') $state= 1;
                else $state = 0;
                $row = [
                    'number' => $item[0],
                    'state' => $state,
                    'class' => $class,
                    'branch' => $branch,
                    'teacher' => $request->teacher,
                    'schedule' => $request->scheduleId,
                    'lesson' => $request->lesson,
                ]; 
                array_push($data, $row);
            }
            // return $data;
            // kendime not: eğer bu sınıf bu şubeden, bu "schedule id" den bugün için kayıt var ise insert değil update yapacaksın!
            // ders ve öğretmeni ekle
            $isSetToday = DB::table('rollcalls')->where('class', $class)->where('branch', $branch)->where('schedule', $request->scheduleId)->whereDate('created_at', Carbon::today())->exists();
            if($isSetToday != null){ // bugün için bu derse kayıt girilmiş ise yani UPDATE olayı!!!
                // update i burada yazacksın
                // $bir = DB::table('rollcalls')->whereDate('created_at', Carbon::today())->update($data);
                $todayRolls = DB::table('rollcalls')->select('number')->where('class', $class)->where('branch', $branch)->where('schedule', $request->scheduleId)->whereDate('created_at', Carbon::today())->orderBy('number', 'asc')->get();
                // return [$todayRolls, $data];
                for($i=0; $i<count($data); $i++){
                    for($j=0; $j<count($todayRolls); $j++){
                        if($todayRolls[$j]->number == $data[$i]['number']){
                            try{
                                DB::table('rollcalls')->where('number', $data[$i]['number'])->where('schedule', $data[$i]['schedule'])->whereDate('created_at', Carbon::today())->update(['state' => $data[$i]['state'], 'updated_at' => Carbon::now('Europe/Istanbul')->toDateTimeString()]);
                            }
                            catch(Exception $e){
                                return $e->getMessage();
                            }
                        } 
                    }
                }
                return 'OK';
            }
            else{ // bugün bu derse ilk kez kayıt girilecek ise
                $what = DB::table('rollcalls')->insert($data);
                if($what != 1)
                    return 'Sistem Hatası Yaşandı Lütfen Daha Sonra Tekrar Deneyin...';
                else
                    return 'OK';
            }
                       
        }
    }
}
