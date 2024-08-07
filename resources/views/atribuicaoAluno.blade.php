<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Resumos') }}
            </h2>
    </x-slot>
    <!DOCTYPE html>
    <html lang="pt-br">
        <body>
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2>Atribuição de aluno à turma</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>
