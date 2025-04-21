<x-layout>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto px-4">
        <x-page-heading>
            <div class="flex justify-between">
                <p>Products</p>

                <a href="{{route('clear-cache')}}" class="bg-blue-400 py-2 px-3 text-sm font-normal rounded shadow">
                    Cache Clear
                </a>
            </div>
        </x-page-heading>

        <div class="grid grid-cols-3 gap-4">
            <div class="rounded-xl bg-gray-300 shadow p-4">
                <h2 class="text-lg font-semibold">No Cache</h2>
                <p class="font-semibold py-2 underline">Time: {{ number_format($noCacheTime * 1000, 2) }} ms</p>
                <ul>
                    @foreach ($productsNoCache as $product)
                        <li class="p-2 bg-gray-800 text-white my-2 shadow rounded">
                            {{ $product->name }} - ${{ $product->price }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-xl bg-gray-400 shadow p-4">
                <h2 class="text-lg font-semibold">File Cache</h2>
                <p class="font-semibold py-2 underline">Time: {{ number_format($fileCacheTime * 1000, 2) }} ms</p>
                <ul>
                    @foreach ($productsFileCache as $product)
                        <li class="p-2 bg-gray-800 text-white my-2 shadow rounded">
                            {{ $product->name }} - ${{ $product->price }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-xl bg-gray-300 shadow p-4">
                <h2 class="text-lg font-semibold">Redis Cache</h2>
                <p class="font-semibold py-2 underline">Time: {{ number_format($redisCacheTime * 1000, 2) }} ms</p>
                <ul>
                    @foreach ($productsRedisCache as $product)
                        <li class="p-2 bg-gray-800 text-white my-2 shadow rounded">
                            {{ $product->name }} - ${{ $product->price }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-layout>
