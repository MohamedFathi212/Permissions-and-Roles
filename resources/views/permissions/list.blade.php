<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('permissions') }}
        </h2>
        <a href="{{ route('permissions.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Create</a>
    </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left" width="200">Created</th>
                        <th class="px-6 py-3 text-left" width="200">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if($permissions->isNotEmpty())
                    @foreach ($permissions as $permission )
                    <tr class="border-b">
                        <td class="px-6 py-3 text-left">
                            {{ $permission->id }}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{ $permission->name }}

                        </td>
                        <td class="px-6 py-3 text-left">

                            {{ \Carbon\Carbon::parse($permission->created_at)->format('d m,y') }}

                        </td>
                        <td class="px-6 py-3 text-left">
                            <a href="{{ route('permissions.edit',$permission->id) }}" class="bg-green-700 text-sm rounded-md text-white px-5 py-2 hover:bg-green-600">Edit</a>
                            <a href="javascript:void(0);" onclick="deletePermission({{ $permission->id }})" class="bg-red-600 text-sm rounded-md text-white px-5 py-2 hover:bg-red-500">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            <div class="my-3">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id) {
                if (confirm("Are you sure you want to delete this record?")) {
                    $.ajax({
                        url: `/permissions/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(xhr) {
                            alert('Failed to delete the permission.');
                        }
                    });
                }
            }
        </script>
    </x-slot>

</x-app-layout>
