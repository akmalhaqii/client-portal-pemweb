<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
            Data Proyek
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
                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input id="search-input" type="text" value="{{ $search }}"
                                   placeholder="Cari proyek..."
                                   class="pl-10 w-full sm:w-64 border-slate-200 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-shadow">
                        </div>
                        <select id="status-filter" class="border-slate-200 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-shadow">
                            <option value="">Semua Status</option>
                            <option value="planning" @selected($status === 'planning')>Planning</option>
                            <option value="ongoing" @selected($status === 'ongoing')>Ongoing</option>
                            <option value="completed" @selected($status === 'completed')>Completed</option>
                            <option value="cancelled" @selected($status === 'cancelled')>Cancelled</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('projects.export.pdf', request()->query()) }}" class="inline-flex items-center bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl hover:bg-slate-50 hover:text-red-600 transition-colors text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            PDF
                        </a>
                        <a href="{{ route('projects.export.excel', request()->query()) }}" class="inline-flex items-center bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl hover:bg-slate-50 hover:text-green-600 transition-colors text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Excel
                        </a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('projects.create') }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition-colors text-sm font-medium shadow-sm shadow-indigo-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Proyek
                            </a>
                        @endif
                    </div>
                </div>

                <div id="project-table" class="overflow-x-auto">
                    @include('projects.partials.table', ['projects' => $projects])
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        $(function () {
            let timer;
            function doSearch() {
                $('#project-table').css('opacity', '0.5');
                $.ajax({
                    url: '{{ route('projects.index') }}',
                    data: { search: $('#search-input').val(), status: $('#status-filter').val() },
                    success: function (html) { 
                        $('#project-table').html(html).css('opacity', '1'); 
                    }
                });
            }
            $('#search-input').on('keyup', function () {
                clearTimeout(timer);
                timer = setTimeout(doSearch, 400);
            });
            $('#status-filter').on('change', doSearch);

            $(document).on('click', '#project-table .pagination a', function (e) {
                e.preventDefault();
                $('#project-table').css('opacity', '0.5');
                $.get($(this).attr('href'), { search: $('#search-input').val(), status: $('#status-filter').val() }, function (html) {
                    $('#project-table').html(html).css('opacity', '1');
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
