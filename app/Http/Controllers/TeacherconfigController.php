<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use App\Models\secretary;
use App\Models\Student;

class TeacherconfigController extends Controller
{

    public function index()
    {
        $classes = Student::distinct()->pluck('class');

        $students = Student::limit(3)->get();

        $locations = Location::all();

        $secretaries = secretary::all();

        return view('Teacher-config', compact('students', 'locations', 'classes', 'secretaries'));
    }

    public function filter(Request $request)
    {

        $classes = Student::distinct()->pluck('class');
        $students = Student::where('class', $request->class)->get();
        $locations = Location::all();
        $secretaries = secretary::all();

        return view('Teacher-config', compact('students', 'locations', 'classes', 'secretaries'));
    }

    public function EditStudent(Request $request)
    {
        $Student = Student::find($request->id);

        return view('Teacher-EditStudent', ['Student' => $Student]);
    }

    public function EditSecretary(Request $request)
    {
        $Secretary = Secretary::find($request->id);
        return view('Teacher-EditSecretary', ['Secretary' => $Secretary]);
    }

    public function EditLocation(Request $request)
    {
        $Location = Location::find($request->id);
        return view('Teacher-EditLocation', ['Location' => $Location]);
    }

    public function deleteClass(Request $request)
    {
        $class = $request->input('class');

        if (!$class) {
            return back()->with('error', 'Selecione uma classe para deletar.');
        }

        Student::where('class', $class)->delete();

        return redirect()->route('teacher.config')->with('success', 'Classe apagada com sucesso!');
    }


    public function storeStudent(Request $request)
    {
        $request->validate([
            'RM' => 'required|unique:students,RM|regex:/^\d{11}$/',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
        ]);

        Student::create([
            'RM' => $request->RM,
            'name' => $request->name,
            'class' => $request->class,
        ]);

        return redirect()->route('teacher.config')->with('success', 'Estudante criado com sucesso!');
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'RM' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
        ]);

        $student->update($validated);

        return redirect()->route('teacher.config')->with('success', 'Estudante atualizado com sucesso!');
    }

    public function destroyStudent($id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()->route('teacher.config')->with('success', 'Estudante excluído com sucesso!');
    }

    public function storeLocation(Request $request)
    {
        $request->validate([
            'roof' => 'required|string|max:255',
            'environment' => 'required|string|max:255',
        ]);

        Location::create([
            'roof' => $request->roof,
            'environment' => $request->environment,
        ]);

        return redirect()->route('teacher.config')->with('success', 'Localização adicionada com sucesso!');
    }

    public function updateLocation(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $validated = $request->validate([
            'roof' => 'required|string|max:255',
            'environment' => 'required|string|max:255',
        ]);

        $location->update($validated);

        return redirect()->route('teacher.config')->with('success', 'Localização atualizada com sucesso!');
    }

    public function destroyLocation($id)
    {
        $location = Location::findOrFail($id);

        $location->delete();

        return redirect()->route('teacher.config')->with('success', 'Localização excluída com sucesso!');
    }

    public function importStudents(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'class' => 'required|string|max:255',  // Valida o nome da turma
            'file' => 'required|file|mimes:txt',  // Valida o tipo de arquivo
        ]);

        // Recupera o arquivo do request
        $file = $request->file('file');

        // Lê o conteúdo do arquivo
        $content = file_get_contents($file->getRealPath());


        // Normaliza as quebras de linha (independente do sistema)
        $content = str_replace("\r\n", "\n", $content);  // Para corrigir no Windows
        $content = str_replace("\r", "\n", $content);   // Para corrigir no Windows também

        // Divide o conteúdo do arquivo em linhas
        $lines = explode("\n", $content);

        // Extrai a turma do request
        $className = $request->input('class');

        // Processa cada linha e salva no banco de dados
        foreach ($lines as $line) {
            // Ignora linhas vazias
            if (empty(trim($line))) {
                continue;
            }

            $parts = explode(' ', trim($line), 2);  

            if (count($parts) < 2) {
                continue;
            }

            $RM = $parts[0];
            $name = $parts[1];

            if (!Student::where('RM', $RM)->exists()) {
                Student::create([
                    'RM' => $RM,
                    'name' => $name,
                    'class' => $className,
                ]);
            }
        }

        return redirect()->route('teacher.config')->with('success', 'Estudantes importados com sucesso!');
    }

    public function storeSecretary(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:secretaries,email',
            'entry_time' => 'required|date_format:H:i',
            'exit_time' => 'required|date_format:H:i',
        ]);

        Secretary::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'entry_time' => $validated['entry_time'],
            'exit_time' => $validated['exit_time'],
        ]);

        return redirect()->route('secretaries.index')->with('success', 'Secretária criada com sucesso!');
    }

    public function updateSecretary(Request $request, $id)
    {
        dd($request);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:secretaries,email,' . $id, 
            'entry_time' => 'required',
            'exit_time' => 'required',
        ]);

        $secretary = Secretary::findOrFail($id);

        $secretary->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'entry_time' => $validated['entry_time'],
            'exit_time' => $validated['exit_time'],
        ]);

        return redirect()->route('secretaries.index')->with('success', 'Secretária atualizada com sucesso!');
    }

    public function destroySecretary($id)
    {
        $secretary = Secretary::findOrFail($id);

        $secretary->delete();

        return redirect()->route('secretaries.index')->with('success', 'Secretária excluída com sucesso!');
    }
}
