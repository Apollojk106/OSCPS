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

    <x-menu />

    <!-- Layout com Menu fixo à esquerda e conteúdo principal -->
    <div class="flex min-h-screen">

        <!-- Conteúdo Principal -->
        <div class="flex-1 p-6">

            <!-- Seção de Estudantes -->
            <div class="bg-gray-200 p-4 rounded shadow mb-4">
                <h2 class="text-xl font-semibold">Estudantes</h2>
                <table class="min-w-full table-auto mt-4">
                    <thead class="bg-white">
                        <tr>
                            <th class="px-4 py-2 border">RM</th>
                            <th class="px-4 py-2 border">Nome</th>
                            <th class="px-4 py-2 border">Turma</th>
                            <th class="px-4 py-2 border">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($students as $student)
                        <tr>
                            <td class="px-4 py-2 border">{{ $student->RM }}</td>
                            <td class="px-4 py-2 border">{{ $student->name }}</td>
                            <td class="px-4 py-2 border">{{ $student->class }}</td>
                            <td class="px-4 py-2 border">
                                <a href="#" class="text-blue-500 hover:text-blue-700" onclick="openEditModal('student', '{{ $student->id }}', '{{ $student->RM }}', '{{ $student->name }}', '{{ $student->class }}')">Editar</a>
                                <button type="button" class="ml-4" onclick="openDeleteModal('student', '{{ $student->id }}')">Excluir</button>
                            </td>
                        </tr>
                        @endforeach
                        <form action="{{ route('students.store') }}" method="POST">
                            @csrf
                            <tr>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="RM" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="class" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                </td>
                                <td class="py-2 border flex justify-center items-center">
                                    <button type="submit" class="p-2 text-white rounded">Adicionar</button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
                <div class="bg-gray-200 p-4 rounded shadow mb-4">
                    <h2 class="text-xl font-semibold">Importar</h2>
                    <form action="{{ route('import.students') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4 ">
                            <label for="class" class="block text-sm font-medium text-gray-700">Nome da Turma</label>
                            <input type="text" name="class" id="class" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4 flex justify-center items-center">
                            <label for="file" class="block text-sm font-medium text-gray-700">Selecione o Arquivo TXT</label>
                            <input type="file" name="file" id="file" accept=".txt" class="mt-1 block w-full" required>
                        </div>

                        <div class="flex justify-center items-center">
                            <button type="submit" class="text-white px-4 py-2 rounded-md">Importar Estudantes</button>
                        </div>
                    </form>
                </div>
            </div>

            <br>

            <!-- Seção de Localizações -->
            <div class="bg-gray-200 p-4 rounded shadow mb-4">
                <h2 class="text-xl font-semibold">Localizações</h2>
                <table class="min-w-full table-auto mt-4 bg-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Telhado</th>
                            <th class="px-4 py-2 border">Ambiente</th>
                            <th class="px-4 py-2 border">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($locations as $location)
                        <tr>
                            <td class="px-4 py-2 border">{{ $location->roof }}</td>
                            <td class="px-4 py-2 border">{{ $location->environment }}</td>
                            <td class="px-4 py-2 border">
                                <a href="#" class="text-blue-500 hover:text-blue-700" onclick="openEditModal('student', '{{ $student->id }}', '{{ $student->RM }}', '{{ $student->name }}', '{{ $student->class }}')">Editar</a>
                                <button type="button" class="ml-4" onclick="openDeleteModal('location', '{{ $location->id }}')">Excluir</button>
                            </td>
                        </tr>
                        @endforeach
                        <form action="{{ route('locations.store') }}" method="POST">
                            @csrf
                            <tr>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="roof" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="environment" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                </td>
                                <td class="py-2 border flex justify-center items-center">
                                    <button type="submit" class="p-2 text-white rounded">Adicionar</button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>

            <!-- Modal para editar dados -->
            <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center">
                <div class="bg-white p-6 rounded-md w-1/2">
                    <h2 class="text-2xl font-semibold mb-4">Editar Dados</h2>
                    <form id="editForm" action="#" method="POST">
                        @csrf
                        <div id="formFields"></div>
                        <div class="mt-4">
                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Salvar</button>
                            <button type="button" class="ml-2 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" onclick="closeModal()">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal para excluir dados -->
            <div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center">
                <div class="bg-white p-6 rounded-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Tem certeza que deseja excluir?</h2>
                    <div class="flex justify-end">
                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600" onclick="deleteData()">Excluir</button>
                        <button type="button" class="ml-4 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" onclick="closeDeleteModal()">Cancelar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Função para abrir o modal de edição
        function openEditModal(type, id, RM = '', name = '', class_ = '', roof = '', environment = '') {
            document.getElementById('editModal').classList.remove('hidden');

            // Definir a ação do formulário e os campos dinamicamente
            const form = document.getElementById('editForm');
            form.action = `/${type}/${id}/update`; // Defina a URL dinamicamente
            const formFields = document.getElementById('formFields');

            // Preencher os campos de edição com os dados do estudante ou localização
            if (type === 'student') {
                formFields.innerHTML = `
                <label class="block mb-2">RM:</label>
                <input type="text" name="RM" class="w-full mb-4 p-2 border rounded-md" value="${RM}" required>
                <label class="block mb-2">Nome:</label>
                <input type="text" name="name" class="w-full mb-4 p-2 border rounded-md" value="${name}" required>
                <label class="block mb-2">Turma:</label>
                <input type="text" name="class" class="w-full mb-4 p-2 border rounded-md" value="${class_}" required>
            `;
            } else if (type === 'location') {
                formFields.innerHTML = `
                <label class="block mb-2">Telhado:</label>
                <textarea name="roof" class="w-full mb-4 p-2 border rounded-md" required>${roof}</textarea>
                <label class="block mb-2">Ambiente:</label>
                <textarea name="environment" class="w-full mb-4 p-2 border rounded-md" required>${environment}</textarea>
            `;
            }
        }

        // Função para fechar o modal de edição
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Função para abrir o modal de exclusão
        function openDeleteModal(type, id) {
            document.getElementById('deleteModal').classList.remove('hidden');
            window.deleteData = function() {
                // A lógica para excluir o item seria colocada aqui (por exemplo, fazendo uma requisição Ajax ou redirecionamento para um endpoint de exclusão)
                window.location.href = `/${type}/${id}/delete`;
            }
        }

        // Função para fechar o modal de exclusão
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>

</body>

</html>