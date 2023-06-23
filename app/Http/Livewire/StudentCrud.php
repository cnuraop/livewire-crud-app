<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithFileUploads;

class StudentCrud extends Component
{

    use WithFileUploads;

    public $students, $name, $grade, $department,$image,$student_id;
    public $updateMode = false;

    public function render()
    {
        $this->students = Student::all();
        return view('livewire.student-crud');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->grade = '';
        $this->department = '';
        $this->image= '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'grade' => 'required',
            'department' => 'required',
            'image' => 'required|image|max:4024', 
        ]);

        $validatedData['image'] = $this->image->store('public/images');


        Student::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'grade' => $this->grade,
            'department' => $this->department,
            'image'=> $this->image->store('public/images')
        ]);
        session()->flash('message', $this->student_id ? 'Student updated.' : 'Student created.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->grade = $student->grade;
        $this->department = $student->department;
        $this->image = $student->image;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->store();
        $this->updateMode = false;
    }

    public function delete($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'Student deleted successfully.');
    }
}
