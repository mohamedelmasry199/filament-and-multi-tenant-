<x-filament-panels::page>
    @if (count($posts) > 0)
        <div class="overflow-hidden rounded-xl border border-gray-200">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Title</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Body</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($posts as $post)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $post['id'] }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900 max-w-xs truncate">{{ $post['title'] }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500 max-w-md truncate">{{ $post['body'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="rounded-xl bg-gray-50 p-8 text-center text-sm text-gray-500">
            Click "Fetch Data" to load posts from the API.
        </div>
    @endif
</x-filament-panels::page>
