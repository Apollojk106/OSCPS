<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use App\Models\Student;

class TeacherconfigController extends Controller
{

    public function index()
    {
        $students = Student::all();
        $locations = Location::all();

        return view('Teacher-config', compact('students', 'locations'));
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
        $request->validate([
            'class' => 'required|string|max:255',  // Valida o nome da turma
            'file' => 'required|file|mimes:txt',  // Valida o tipo de arquivo
        ]);

        $file = $request->file('file');

        // Lê o conteúdo do arquivo
        $content = file_get_contents($file->getRealPath());

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

            $parts = preg_split('/\s{2,}/', $line);  // Usa dois ou mais espaços como delimitador

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
}
