<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\location;
use App\Models\secretary;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class TeacherconfigController extends Controller
{

    public function index()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $classes = Student::distinct()->pluck('class');

        $students = Student::limit(3)->get();

        $locations = Location::all();

        $secretaries = secretary::all();

        return view('Teacher-config', compact('students', 'locations', 'classes', 'secretaries'));
    }

    public function filter(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $classes = Student::distinct()->pluck('class');
        $students = Student::where('class', $request->class)->get();
        $locations = Location::all();
        $secretaries = secretary::all();

        return view('Teacher-config', compact('students', 'locations', 'classes', 'secretaries'));
    }

    public function EditStudent(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $Student = Student::find($request->id);
        return view('Teacher-EditStudent', ['Student' => $Student]);
    }

    public function EditSecretary(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $Secretary = Secretary::find($request->id);
        return view('Teacher-EditSecretary', ['Secretary' => $Secretary]);
    }

    public function EditLocation(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $Location = Location::find($request->id);
        return view('Teacher-EditLocation', ['Location' => $Location]);
    }

    public function deleteClass(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $class = $request->input('class');

        if (!$class) {
            return back()->with('error', 'Selecione uma classe para deletar.');
        }

        Student::where('class', $class)->delete();

        return redirect()->route('teacher.config')->with('success', 'Classe apagada com sucesso!');
    }


    public function storeStudent(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

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
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

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
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()->route('teacher.config')->with('success', 'Estudante excluído com sucesso!');
    }

    public function storeLocation(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

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
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

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
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('teacher.config')->with('success', 'Localização excluída com sucesso!');
    }

    public function importStudents(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        // Validação dos campos
        $request->validate([
            'class' => 'required|string|max:255',  // Valida o nome da turma
            'file' => 'required|file|mimes:pdf',  // Valida que o arquivo seja PDF
        ]);

        // Recupera o arquivo do request
        $file = $request->file('file');

        // Cria uma instância do parser do PDF
        $parser = new Parser();
        $pdf = $parser->parseFile($file->getRealPath());

        // Obtém o texto do PDF
        $content = $pdf->getText();

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

            // Usa a expressão regular para verificar se a linha contém um RM de 11 dígitos seguido de um nome
            if (preg_match('/^\d{11}\s+(.+)$/', trim($line), $matches)) {
                // Captura o RM e o nome
                $RM = substr($line, 0, 11);  // RM são os primeiros 11 caracteres
                $name = $matches[1];  // O nome do aluno é capturado pela expressão regular

                // Verifica se o RM já existe no banco e cria o aluno caso não exista
                if (!Student::where('RM', $RM)->exists()) {
                    Student::create([
                        'RM' => $RM,
                        'name' => $name,
                        'class' => $className,  // O nome da turma pode ser extraído de alguma variável
                    ]);
                }
            }
        }

        return redirect()->route('teacher.config')->with('success', 'Estudantes importados com sucesso!');
    }

    public function storeSecretary(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

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

        return redirect()->route('teacher.config')->with('success', 'Secretária criada com sucesso!');
    }

    public function updateSecretary(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

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

        return redirect()->route('teacher.config')->with('success', 'Secretária atualizada com sucesso!');
    }

    public function destroySecretary($id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $secretary = Secretary::findOrFail($id);
        $secretary->delete();

        return redirect()->route('teacher.config')->with('success', 'Secretária excluída com sucesso!');
    }
}
