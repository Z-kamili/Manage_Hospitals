<?php
namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Models\Section as ModelsSection;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{
 
      public function index()
     {

        $sections = ModelsSection::all();
        return view('Dashboard.Sections.index',compact('sections'));

     }
       public function store($request)
       {
               
        ModelsSection::create([
            'name' => $request->input('name'),
        ]);

        session()->flash('add');
        return redirect()->route('Sections.index');

             

       }

       public function update($request)
       {
        
        $section = ModelsSection::findOrFail($request->id);
        $section->update([

            'name' => $request->input('name'),

        ]);
        session()->flash('edit');
        return redirect()->route('Sections.index');

       }

       public function destroy($request){

        ModelsSection::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('Sections.index');

       }
 

}