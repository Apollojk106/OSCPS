<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100">

    <x-header />

    <!-- Modal de Edição -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-md w-1/2">
            <h2 class="text-2xl font-semibold mb-4">Editar Dados</h2>
            <form action="{{route('student.update', $Student->id)}}" method="POST">
                @csrf
                <div id="formFields">
                    <label class="block mb-2">RM:</label>
                    <input type="text" name="RM" class="w-full mb-4 p-2 border rounded-md" value="{{$Student->RM}}" required>
                    <label class="block mb-2">Nome:</label>
                    <input type="text" name="name" class="w-full mb-4 p-2 border rounded-md" value="{{$Student->name}}" required>
                    <label class="block mb-2">Turma:</label>
                    <input type="text" name="class" class="w-full mb-4 p-2 border rounded-md" value="{{$Student->class}}" required>
                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Salvar</button>
                    <button type="button" class="ml-2 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" onclick="window.location.href='/Adm/config'">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

</body>