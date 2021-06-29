<?php
namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Models\Appointment;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $doctors = Doctor::with('doctorappointments')->get();
        return view('Dashboard.Doctors.index',compact('doctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add',compact('sections','appointments'));
    }


    public function store($request){

        DB::beginTransaction();

        try {

            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->price = $request->price;
            $doctors->status = 1;
            $doctors->save();

            // store trans
            $doctors->name = $request->name;
            $doctors->save();
            // insert pivot tABLE
            $doctors->doctorappointments()->attach($request->appointments);


            //Upload img
            $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\Doctor');

            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.create');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    
    public function edit($id){
    
      $sections = Section::all();
      $appointments = Appointment::all();
      $doctor = Doctor::findorFail($id);
      return view('Dashboard.Doctors.edit',compact('sections','appointments','doctor'));

    }

    public function update($request)
    {
        DB::beginTransaction();

        try {

            $doctor = Doctor::findorfail($request->id);

            $doctor->email = $request->email;
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->save();
            // store trans
            $doctor->name = $request->name;
            $doctor->save();

            // update pivot tABLE
            $doctor->doctorappointments()->sync($request->appointments);

            // update photo
            if ($request->has('photo')){
                // Delete old photo
                if ($doctor->image){
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->back();

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
       
        if($request->page_id==1){

            if($request->filename){
     
              $this->Delete_attachment('upload_image','doctors/'.$request->filename,$request->id,$request->filename);
            }
               Doctor::destroy($request->id);
               session()->flash('delete');
               return redirect()->route('Doctors.index');
           }
     
     
           //---------------------------------------------------------------
     
           else{
     
     //
     
           }
     
     
         
    }


    public function update_password($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'password'=>Hash::make($request->password)
            ]);

            session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function update_status($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'status'=>$request->status
            ]);
            session()->flash('edit');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





}
