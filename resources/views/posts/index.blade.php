<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="actions">
                <a href="{{ route('clears') }}"
                    class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Clears
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 shadow-md rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left border-b">Driver</th>
                                    <th class="px-4 py-2 text-left border-b">Latency (seconds)</th>
                                    <th class="px-4 py-2 text-left border-b">Throughput (req/sec)</th>
                                    <th class="px-4 py-2 text-left border-b">Total Records</th>
                                    <th class="px-4 py-2 text-left border-b">Count (This Page)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b">{{ $result['driver'] }}</td>
                                        <td class="px-4 py-2 border-b">{{ $result['latency'] }}</td>
                                        <td class="px-4 py-2 border-b">{{ $result['throughput'] }}</td>
                                        <td class="px-4 py-2 border-b">{{ $result['total_records'] }}</td>
                                        <td class="px-4 py-2 border-b">{{ $result['count'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 shadow-md rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left border-b">#</th>
                                    <th class="px-4 py-2 text-left border-b">Title</th>
                                    <th class="px-4 py-2 text-left border-b">Description</th>
                                    <th class="px-4 py-2 text-left border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 border-b">{{ $post->title }}</td>
                                        <td class="px-4 py-2 border-b">
                                            {{ Str::limit($post->description, 100) }}
                                        </td>
                                        <td class="px-4 py-2 border-b">
                                            Delete
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="my-10">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
