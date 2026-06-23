<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
            Data Klien
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex justify-between items-center relative" x-transition>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-emerald-700 font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
                    <div class="relative w-full md:w-96">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input id="search-input" type="text" value="{{ $search }}"
                               placeholder="Cari nama, perusahaan, atau telepon..."
                               class="pl-10 w-full border-slate-200 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-shadow">
                    </div>

                    <div class="flex">
                        <a href="{{ route('clients.create') }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-200 text-sm font-medium whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            Tambah Klien
                        </a>
                    </div>
                </div>

                <div id="client-table" class="overflow-x-auto">
                    @include('clients.partials.table', ['clients' => $clients])
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        $(function () {
            let searchTimer;
            $('#search-input').on('keyup', function () {
                clearTimeout(searchTimer);
                const value = $(this).val();
                
                $('#client-table').css('opacity', '0.5');
                
                searchTimer = setTimeout(function () {
                    $.ajax({
                        url: '{{ route('clients.index') }}',
                        data: { search: value },
                        success: function (html) {
                            $('#client-table').html(html).css('opacity', '1');
                        }
                    });
                }, 400);
            });

            $(document).on('click', '#client-table .pagination a', function (e) {
                e.preventDefault();
                $('#client-table').css('opacity', '0.5');
                const url = $(this).attr('href');
                $.get(url, { search: $('#search-input').val() }, function (html) {
                    $('#client-table').html(html).css('opacity', '1');
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
