<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Proyek</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                    <div class="flex gap-2">
                        <input id="search-input" type="text" value="{{ $search }}"
                               placeholder="Cari nama proyek..."
                               class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <select id="status-filter" class="border-gray-300 rounded-md shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="planning" @selected($status === 'planning')>Planning</option>
                            <option value="ongoing" @selected($status === 'ongoing')>Ongoing</option>
                            <option value="completed" @selected($status === 'completed')>Completed</option>
                            <option value="cancelled" @selected($status === 'cancelled')>Cancelled</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('projects.export.pdf', request()->query()) }}" class="bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700 text-sm">Export PDF</a>
                        <a href="{{ route('projects.export.excel', request()->query()) }}" class="bg-green-600 text-white px-3 py-2 rounded-md hover:bg-green-700 text-sm">Export Excel</a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('projects.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">+ Tambah Proyek</a>
                        @endif
                    </div>
                </div>

                <div id="project-table">
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
                $.ajax({
                    url: '{{ route('projects.index') }}',
                    data: { search: $('#search-input').val(), status: $('#status-filter').val() },
                    success: function (html) { $('#project-table').html(html); }
                });
            }
            $('#search-input').on('keyup', function () {
                clearTimeout(timer);
                timer = setTimeout(doSearch, 400);
            });
            $('#status-filter').on('change', doSearch);

            $(document).on('click', '#project-table .pagination a', function (e) {
                e.preventDefault();
                $.get($(this).attr('href'), { search: $('#search-input').val(), status: $('#status-filter').val() }, function (html) {
                    $('#project-table').html(html);
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
