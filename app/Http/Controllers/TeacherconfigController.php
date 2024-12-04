<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\location;
use App\Models\secretary;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

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

        Log::info('Editando estudante.', [
            'student_id' => $Student->id ?? 'Não encontrado',
            'request_id' => $request->id,
        ]);

        $Student = Student::find($request->id);
        return view('Teacher-EditStudent', ['Student' => $Student]);
    }

    public function EditSecretary(Request $request)
    {

        Log::info('Editando secretária.', [
            'secretary_id' => $Secretary->id ?? 'Não encontrado',
            'request_id' => $request->id,
        ]);

        $Secretary = Secretary::find($request->id);
        return view('Teacher-EditSecretary', ['Secretary' => $Secretary]);
    }

    public function EditLocation(Request $request)
    {

        Log::info('Editando localização.', [
            'location_id' => $Location->id ?? 'Não encontrado',
            'request_id' => $request->id,
        ]);

        $Location = Location::find($request->id);
        return view('Teacher-EditLocation', ['Location' => $Location]);
    }

    public function GetdeleteClass($class)
    { 
        return view('Teacher-DelClass', ['class' => $class]);
    }

    public function deleteClass(Request $request)
    {

        $class = $request->input('class');

        Log::info('Deletando classe.', [
            'class' => $class,
        ]);

        if (!$class) {
            return back()->with('error', 'Selecione uma classe para deletar.');
        }

        Student::where('class', $class)->delete();

        Log::info('Classe excluída com sucesso.', [
            'class' => $class,
        ]);

        return redirect()->route('teacher.config')->with('success', 'Classe apagada com sucesso!');
    }


    public function storeStudent(Request $request)
    {
        $request->validate([
            'RM' => 'required|unique:students,RM|regex:/^\d{11}$/',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
        ], [
            'RM.required' => 'O campo RM é obrigatório.',
            'name.required' => 'O campo Nome é obrigatorio',
            'class.required' => 'O campo Turma é obrigatorio',
            'RM.unique' => 'O RM informado já está registrado no sistema.',
            'RM.regex' => 'O RM deve conter exatamente 11 dígitos numéricos.',
        ]);

        Log::info('Criando estudante.', [
            'RM' => $request->RM,
            'name' => $request->name,
            'class' => $request->class,
        ]);

        Student::create([
            'RM' => $request->RM,
            'name' => $request->name,
            'class' => $request->class,
        ]);

        Log::info('Estudante criado com sucesso.', [
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

        Log::info('Estudante atualizado com sucesso.', [
            'student_id' => $student->id,
            'RM' => $validated['RM'],
            'name' => $validated['name'],
            'class' => $validated['class'],
        ]);

        return redirect()->route('teacher.config')->with('success', 'Estudante atualizado com sucesso!');
    }

    public function destroyStudent($id)
    {
 
        $student = Student::findOrFail($id);

        Log::info('Excluindo estudante.', [
            'student_id' => $student->id,
            'RM' => $student->RM,
            'name' => $student->name,
        ]);

        $student->delete();

        Log::info('Estudante excluído com sucesso.', [
            'student_id' => $student->id,
        ]);

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

        Log::info('Localização criada com sucesso.', [
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

        Log::info('Localização atualizada com sucesso.', [
            'location_id' => $location->id,
            'roof' => $validated['roof'],
            'environment' => $validated['environment'],
        ]);

        return redirect()->route('teacher.config')->with('success', 'Localização atualizada com sucesso!');
    }

    public function destroyLocation($id)
    {
        $location = Location::findOrFail($id);

        Log::info('Excluindo localização.', [
            'location_id' => $location->id,
            'roof' => $location->roof,
            'environment' => $location->environment,
        ]);

        $location->delete();

        Log::info('Localização excluída com sucesso.', [
            'location_id' => $location->id,
        ]);

        return redirect()->route('teacher.config')->with('success', 'Localização excluída com sucesso!');
    }

    public function importStudents(Request $request)
    {
        $request->validate([
            'class' => 'required|string|max:255',  // Valida o nome da turma
            'file' => 'required|file|mimes:txt',  // Valida o tipo de arquivo
        ]);

        $file = $request->file('file');

        Log::info('Importando estudantes de arquivo.', [
            'class' => $request->input('class'),
            'file_name' => $file->getClientOriginalName(),
        ]);

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

            $parts = preg_split('/\s+/', $line, 2); 

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

        Log::info('Importação de estudantes concluída com sucesso.', [
            'class' => $className,
            'students_imported' => count($lines),
        ]);

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

        Log::info('Criando secretária.', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'entry_time' => $validated['entry_time'],
            'exit_time' => $validated['exit_time'],
        ]);

        Secretary::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'entry_time' => $validated['entry_time'],
            'exit_time' => $validated['exit_time'],
        ]);

        Log::info('Secretária criada com sucesso.', [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('teacher.config')->with('success', 'Secretária criada com sucesso!');
    }

    public function updateSecretary(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:secretaries,email,' . $id,
            'entry_time' => 'required',
            'exit_time' => 'required',
        ]);

        $secretary = Secretary::findOrFail($id);

        Log::info('Atualizando secretária.', [
            'secretary_id' => $secretary->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'entry_time' => $validated['entry_time'],
            'exit_time' => $validated['exit_time'],
        ]);

        $secretary->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'entry_time' => $validated['entry_time'],
            'exit_time' => $validated['exit_time'],
        ]);

        Log::info('Secretária atualizada com sucesso.', [
            'secretary_id' => $secretary->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('teacher.config')->with('success', 'Secretária atualizada com sucesso!');
    }

    public function destroySecretary($id)
    {
        $secretary = Secretary::findOrFail($id);

        Log::info('Excluindo secretária.', [
            'secretary_id' => $secretary->id,
            'name' => $secretary->name,
            'email' => $secretary->email,
        ]);

        $secretary->delete();

        Log::info('Secretária excluída com sucesso.', [
            'secretary_id' => $secretary->id,
        ]);

        return redirect()->route('teacher.config')->with('success', 'Secretária excluída com sucesso!');
    }
}
