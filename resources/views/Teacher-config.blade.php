<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .swal-btn {
            padding: 14px 40px !important;
            /* Ajusta o tamanho do botão */
            font-size: 18px !important;
            /* Ajusta o tamanho da fonte */
            border-radius: 8px !important;
            /* Bordas arredondadas */
            width: 100% !important;
            /* Faz o botão ocupar 100% da largura do pop-up */
            box-sizing: border-box !important;
            /* Garantir que o padding seja incluído na largura */
        }

        /* Ajusta a largura do pop-up para que o conteúdo e o botão se ajustem */
        .swal2-popup {
            min-width: 300px !important;
            /* Definindo uma largura mínima */
            width: auto !important;
            /* Ajuste a largura automaticamente */
        }

        /* Ajusta a largura do conteúdo para que o botão acompanhe */
        .swal2-html-container {
            max-width: 100% !important;
            /* Ajusta a largura máxima do conteúdo */
        }
    </style>

</head>

<body>

    <x-menu />

    @if(session('success'))
    <script>
        Swal.fire({
            position: "center", // Centraliza o alerta na tela
            icon: "success", // Tipo do ícone (sucesso)
            title: "{{ session('success') }}", // Mensagem que vem da sessão
            showConfirmButton: false, // Não mostra o botão de confirmação
            timer: 1500 // O alerta desaparece após 1.5 segundos
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        Swal.fire({
            position: "center", // Centraliza o alerta
            icon: 'error', // Ícone de erro
            title: 'Oops...', // Título do alerta
            html: '<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>', // Lista de erros
            showConfirmButton: true, // Mostra o botão de confirmação
            confirmButtonText: 'OK', // Texto do botão
            customClass: {
                confirmButton: 'swal-btn' // Classe customizada para o botão
            }
        });
    </script>
    @endif

    <!-- Layout com Menu fixo à esquerda e conteúdo principal -->


    <!-- Conteúdo Principal -->
    <div class="flex-1 p-6 ml-10 mt-16 ">

        <div class="flex-container flex flex-col items-center gap-4">

            <!-- Seção de Estudantes -->
            <div class="bg-gray-200 p-2 sm:p-3 rounded shadow mb-4  max-w-full sm:max-w-4xl">
                <h2 class="text-lg sm:text-xl font-medium text-center">Estudantes</h2>

                <!-- Importar Formulário -->
                <div class="bg-gray-200 p-2 sm:p-3 rounded shadow mb-4">
                    <h2 class="text-lg sm:text-xl font-medium">Importar</h2>
                    <form action="{{ route('import.students') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
                        @csrf
                        <div class="mb-2">
                            <label for="class" class="block text-xs sm:text-sm font-medium text-gray-700">Nome da Turma</label>
                            <input type="text" name="class" id="class" class="mt-1 block w-full px-2 py-1 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-2 flex flex-col">
                            <label for="file" class="block text-xs sm:text-sm font-medium text-gray-700">Selecione o Arquivo TXT</label>
                            <input type="file" name="file" id="file" accept=".txt" class="mt-1 block w-full" required>
                        </div>

                        <div class="flex justify-center items-center">
                            <button type="submit" class="bg-[#cc1c22] text-white px-3 py-1 rounded-md hover:bg-red-800 transition-colors duration-300">Importar Estudantes</button>
                        </div>
                    </form>
                </div>

                <!-- Filtro de Classe -->
                <form action="{{ route('teacher.config.filter') }}" method="POST" class="mb-4 ml-auto max-w-xl">
                    @csrf
                    <div class="flex items-center justify-between space-x-2">
                        <h2 class="text-lg sm:text-xl font-medium">Filtro de Classe:</h2>
                        <select name="class" id="class" class="form-select text-xs sm:text-sm rounded-md border-gray-300 px-2 py-1">
                            <option value="">Selecione uma classe</option>
                            @foreach($classes as $class)
                            <option value="{{ $class }}">{{ $class }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-[#cc1c22] text-white px-3 py-1 rounded-md hover:bg-red-800 transition-colors duration-300">Filtrar</button>
                    </div>
                </form>

                <!-- Deletar Classe -->
                <div class="mb-4 ml-auto max-w-xl">
                    @csrf
                    <div class="flex items-center justify-between space-x-2">
                        <h2 class="text-lg sm:text-xl font-medium">Deletar Classe:</h2>
                        <select name="class" id="selectedclass" class="form-select text-xs sm:text-sm rounded-md border-gray-300 px-2 py-1">
                            <option value="">Selecione uma classe</option>
                            @foreach($classes as $class)
                            <option value="{{ $class }}">{{ $class }}</option>
                            @endforeach
                        </select>
                        <button type="button" onclick="GetDelete()" class="bg-[#cc1c22] text-white px-3 py-1 rounded-md hover:bg-red-800 transition-colors duration-300">Deletar Classe</button>
                    </div>
                </div>
            </div>

            <!-- Tabela de Estudantes -->
            <div class="bg-gray-200 p-2 sm:p-3 rounded shadow mb-4">
                <div class="hidden sm:block">
                    <table class="min-w-full table-auto mt-3">
                        <thead class="bg-white">
                            <tr>
                                <th class="px-2 py-1 border text-xs sm:text-sm">RM</th>
                                <th class="px-2 py-1 border text-xs sm:text-sm">Nome</th>
                                <th class="px-2 py-1 border text-xs sm:text-sm">Turma</th>
                                <th class="px-2 py-1 border text-xs sm:text-sm">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($students as $student)
                            <tr>
                                <td class="px-2 py-1 border text-xs sm:text-sm">{{ $student->RM }}</td>
                                <td class="px-2 py-1 border text-xs sm:text-sm">{{ $student->name }}</td>
                                <td class="px-2 py-1 border text-xs sm:text-sm">{{ $student->class }}</td>
                                <td class="px-2 py-1 border flex items-center justify-start text-xs sm:text-sm">
                                    <form action="{{ route('Student.Edit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $student->id }}">
                                        <button type="submit" class="bg-white text-blue-500 font-semibold px-2 py-1 rounded-md border border-blue-500 hover:bg-white">Editar</button>
                                    </form>
                                    <button type="button" class="bg-[#cc1c22] text-white px-2 py-1 rounded-md" onclick="openDeleteModal('student', '{{ $student->id }}')">Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                            <form action="{{ route('students.store') }}" method="POST">
                                @csrf
                                <tr>
                                    <td class="px-2 py-1 border">
                                        <input type="text" name="RM" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="px-2 py-1 border">
                                        <input type="text" name="name" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="px-2 py-1 border">
                                        <input type="text" name="class" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="py-1 border flex justify-center items-center">
                                        <button type="submit" class="bg-[#cc1c22] text-white px-3 py-1 rounded-md">Adicionar</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>

                <!-- Versão em coluna para telas menores -->
                <div class="block sm:hidden">
                    @foreach($students as $student)
                    <div class="border-b border-gray-300 p-2">
                        <div><strong>RM:</strong> {{ $student->RM }}</div>
                        <div><strong>Nome:</strong> {{ $student->name }}</div>
                        <div><strong>Turma:</strong> {{ $student->class }}</div>
                        <div class="flex items-center mt-2">
                            <form action="{{ route('Student.Edit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $student->id }}">
                                <button type="submit" class="bg-white text-blue-500 font-semibold px-2 py-1 rounded-md border border-blue-500 hover:bg-white">Editar</button>
                            </form>
                            <button type=" button" class="bg-[#cc1c22] text-white px-2 py-1 rounded-md" onclick="openDeleteModal('student', '{{ $student->id }}')">Excluir</button>
                        </div>
                    </div>
                    @endforeach
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div class="border-b border-gray-300 p-2">
                            <div><strong>RM:</strong> <input type="text" name="RM" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div><strong>Nome:</strong> <input type="text" name="name" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div><strong>Turma:</strong> <input type="text" name="class" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div class="flex justify-center items-center mt-2">
                                <button type="submit" class="bg-[#cc1c22] text-white px-3 py-1 rounded-md">Adicionar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <style>
                @media (max-width: 590px) {
                    .hidden {
                        display: none;
                    }

                    .block {
                        display: block;
                    }
                }
            </style>

            <br>



            <!-- Seção de Secretaria -->
            <div class="bg-gray-200 p-2 rounded shadow mb-3 max-w-full">
                <h2 class="text-lg font-medium text-center">Secretaria</h2>

                <div class="hidden sm:block">
                    <table class="min-w-full table-auto mt-2 bg-white">
                        <thead>
                            <tr>
                                <th class="px-2 py-1 border">Nome</th>
                                <th class="px-2 py-1 border">Email</th>
                                <th class="px-2 py-1 border">Entrada</th>
                                <th class="px-2 py-1 border">Saída</th>
                                <th class="px-2 py-1 border">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($secretaries as $secretary)
                            <tr>
                                <td class="px-2 py-1 border">{{ $secretary->name }}</td>
                                <td class="px-2 py-1 border">{{ $secretary->email }}</td>
                                <td class="px-2 py-1 border">{{ \Carbon\Carbon::parse($secretary->entry_time)->format('H:i') }}</td>
                                <td class="px-2 py-1 border">{{ \Carbon\Carbon::parse($secretary->exit_time)->format('H:i') }}</td>
                                <td class="px-2 py-1 border flex items-center justify-start">
                                    <form action="{{ route('Secretary.Edit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $secretary->id }}">
                                        <button type="submit" class="bg-white text-blue-500 font-semibold px-2 py-1 rounded-md border border-blue-500 hover:bg-white">
                                            Editar
                                        </button>
                                    </form>
                                    <button type="button" class="bg-[#cc1c22] text-white px-2 py-1 rounded-md" onclick="openDeleteModal('secretary', '{{ $secretary->id }}')">Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                            <form action="{{ route('secretaries.store') }}" method="POST">
                                @csrf
                                <tr>
                                    <td class="px-2 py-1 border">
                                        <input type="text" name="name" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="px-2 py-1 border">
                                        <input type="email" name="email" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="px-2 py-1 border">
                                        <input type="time" name="entry_time" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="px-2 py-1 border">
                                        <input type="time" name="exit_time" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="py-1 border flex justify-center items-center">
                                        <button type="submit" class="bg-[#cc1c22] text-white px-3 py-1 rounded-md">Adicionar</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>

                <!-- Versão em coluna para telas menores -->
                <div class="block sm:hidden">
                    @foreach($secretaries as $secretary)
                    <div class="border-b border-gray-300 p-2">
                        <div><strong>Nome:</strong> {{ $secretary->name }}</div>
                        <div><strong>Email:</strong> {{ $secretary->email }}</div>
                        <div><strong>Entrada:</strong> {{ \Carbon\Carbon::parse($secretary->entry_time)->format('H:i') }}</div>
                        <div><strong>Saída:</strong> {{ \Carbon\Carbon::parse($secretary->exit_time)->format('H:i') }}</div>
                        <div class="flex items-center mt-2">
                            <form action="{{ route('Secretary.Edit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $secretary->id }}">
                                <button type="submit" class="bg-white text-blue-500 font-semibold px-2 py-1 rounded-md border border-blue-500 hover:bg-white">Editar</button>
                            </form>
                            <button type="button" class="bg-[#cc1c22] text-white px-2 py-1 rounded-md" onclick="openDeleteModal('secretary', '{{ $secretary->id }}')">Excluir</button>
                        </div>
                    </div>
                    @endforeach
                    <form action="{{ route('secretaries.store') }}" method="POST">
                        @csrf
                        <div class="border-b border-gray-300 p-2">
                            <div><strong>Nome:</strong> <input type="text" name="name" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div><strong>Email:</strong> <input type="email" name="email" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div><strong>Entrada:</strong> <input type="time" name="entry_time" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div><strong>Saída:</strong> <input type="time" name="exit_time" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div class="flex justify-center items-center mt-2">
                                <button type="submit" class="bg-[#cc1c22] text-white px-3 py-1 rounded-md">Adicionar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <style>
                @media (max-width: 590px) {
                    .hidden {
                        display: none;
                    }

                    .block {
                        display: block;
                    }
                }
            </style>

            <!-- Seção de Localizações -->
            <div class="bg-gray-200 p-3 rounded shadow mb-4 max-w-full">
                <h2 class="text-lg font-medium text-center">Localizações</h2>

                <div class="hidden sm:block">
                    <table class="min-w-full table-auto mt-3 bg-white">
                        <thead>
                            <tr>
                                <th class="px-3 py-1.5 border">Telhado</th>
                                <th class="px-3 py-1.5 border">Ambiente</th>
                                <th class="px-3 py-1.5 border">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($locations as $location)
                            <tr>
                                <td class="px-3 py-1.5 border">{{ $location->roof }}</td>
                                <td class="px-3 py-1.5 border">{{ $location->environment }}</td>
                                <td class="px-3 py-1.5 border flex items-center justify-start">
                                    <form action="{{ route('Location.Edit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $location->id }}">
                                        <button type="submit" class="bg-white text-blue-500 font-semibold px-3 py-1.5 rounded-md border border-blue-500 hover:bg-white">
                                            Editar
                                        </button>
                                    </form>

                                    <button type="button" class="bg-[#cc1c22] text-white px-3 py-1.5 rounded-md" onclick="openDeleteModal('location', '{{ $location->id }}')">Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                            <form action="{{ route('locations.store') }}" method="POST">
                                @csrf
                                <tr>
                                    <td class="px-3 py-1.5 border">
                                        <input type="text" name="roof" class="w-full px-2 py-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="px-3 py-1.5 border">
                                        <input type="text" name="environment" class="w-full px-2 py-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    </td>
                                    <td class="py-1.5 border flex justify-center items-center">
                                        <button type="submit" class="bg-[#cc1c22] text-white px-4 py-2 rounded-md">Adicionar</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>

                <!-- Versão em coluna para telas menores -->
                <div class="block sm:hidden">
                    @foreach($locations as $location)
                    <div class="border-b border-gray-300 p-2">
                        <div><strong>Telhado:</strong> {{ $location->roof }}</div>
                        <div><strong>Ambiente:</strong> {{ $location->environment }}</div>
                        <div class="flex items-center mt-2">
                            <form action="{{ route('Location.Edit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $location->id }}">
                                <button type="submit" class="bg-white text-blue-500 font-semibold px-2 py-1 rounded-md border border-blue-500 hover:bg-white">Editar</button>
                            </form>
                            <button type="button" class="bg-[#cc1c22] text-white px-2 py-1 rounded-md" onclick="openDeleteModal('location', '{{ $location->id }}')">Excluir</button>
                        </div>
                    </div>
                    @endforeach
                    <form action="{{ route('locations.store') }}" method="POST">
                        @csrf
                        <div class="border-b border-gray-300 p-2">
                            <div><strong>Telhado:</strong> <input type="text" name="roof" class="w-full px-2 py-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div><strong>Ambiente:</strong> <input type="text" name="environment" class="w-full px-2 py-1.5 border border-gray- 300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" /></div>
                            <div class="flex justify-center items-center mt-2">
                                <button type="submit" class="bg-[#cc1c22] text-white px-3 py-1 rounded-md">Adicionar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <style>
                @media (max-width: 590px) {
                    .hidden {
                        display: none;
                    }

                    .block {
                        display: block;
                    }
                }
            </style>
            <br>

            <!-- Modal de Edição -->
            <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center">
                <div class="bg-white p-6 rounded-md w-1/2">
                    <h2 class="text-2xl font-semibold mb-4">Editar Dados</h2>
                    <form id="editForm" action="#F" method="POST">
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
        function GetDelete() {
            const classSelect = document.getElementById('selectedclass');
            const selectedClass = classSelect.value;

            if (selectedClass === "") {
                alert("Por favor, selecione uma classe para excluir.");
                return;
            }
            // Redirecionar para a rota de exclusão com a classe selecionada
            window.location.href = `/Adm/config/delete-class/${selectedClass}`;
        }
        //script antigo
        // Função para abrir o modal de edição de aluno
        function openStudentEditModal(id, RM, name, class_) {
            document.getElementById('editModal').classList.remove('hidden');

            // Definir a ação do formulário dinamicamente
            const form = document.getElementById('editForm');
            form.action = `/student/${id}/update`;

            // Selecionar o container onde os campos de formulário serão adicionados
            const formFields = document.getElementById('formFields');

            // Preencher os campos do formulário com os dados do aluno
            formFields.innerHTML = `
            
        `;
        }

        // Função para abrir o modal de edição de localização
        function openLocationEditModal(id, roof, environment) {
            document.getElementById('editModal').classList.remove('hidden');

            // Definir a ação do formulário dinamicamente
            const form = document.getElementById('editForm');
            form.action = `/location/${id}/update`;

            // Selecionar o container onde os campos de formulário serão adicionados
            const formFields = document.getElementById('formFields');

            // Preencher os campos do formulário com os dados de localização
            formFields.innerHTML = `
            
        `;
        }

        // Função para abrir o modal de edição de secretária
        function openSecretaryEditModal(id, name, email, entry_time, exit_time) {
            document.getElementById('editModal').classList.remove('hidden');

            // Definir a ação do formulário dinamicamente
            const form = document.getElementById('editForm');
            form.action = `/secretary/${id}/update`;

            // Selecionar o container onde os campos de formulário serão adicionados
            const formFields = document.getElementById('formFields');

            // Preencher os campos do formulário com os dados da secretária
            formFields.innerHTML = `
            
        `;
        }

        // Função para fechar o modal
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

        const toggle = document.querySelector('.toggle');
        const body = document.body;

        // Função para aplicar o modo escuro com base na preferência armazenada
        function applyDarkMode() {
            const darkModeEnabled = localStorage.getItem('darkMode') === 'true';
            if (darkModeEnabled) {
                body.classList.add('dark-mode');
                toggle.classList.add('fa-sun');
                toggle.classList.remove('fa-moon');
            } else {
                body.classList.remove('dark-mode');
                toggle.classList.remove('fa-sun');
                toggle.classList.add('fa-moon');
            }
        }

        // Chama a função ao carregar a página
        applyDarkMode();

        toggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            toggle.classList.toggle('fa-sun');
            toggle.classList.toggle('fa-moon');

            // Armazena a preferência no localStorage
            const darkModeEnabled = body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', darkModeEnabled);
        });

        let zoomLevel = 1;
        const zoomInButton = document.getElementById('zoom-in');
        const zoomOutButton = document.getElementById('zoom-out');
        const mainContent = document.querySelector('.max-w-lg');

        zoomInButton.addEventListener('click', () => {
            zoomLevel += 0.1;
            mainContent.style.transform = `scale(${zoomLevel})`;
        });

        zoomOutButton.addEventListener('click', () => {
            zoomLevel = Math.max(0.5, zoomLevel - 0.1);
            mainContent.style.transform = `scale(${zoomLevel})`;
        });

        function checkSelection() {
            const typeProblem = document.getElementById('type_problem').value;
            const roof = document.getElementById('roof').value;

            // Verifica se ambos os campos estão selecionados
            if (typeProblem && roof) {
                // Redireciona para a rota GET com os parâmetros
                window.location.href = `/Student/called/${roof}/${typeProblem}`;
            }
        }
    </script>


</body>

</html>