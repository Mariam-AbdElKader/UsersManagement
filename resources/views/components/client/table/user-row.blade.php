<tr class="border-b border-gray-700 hover:bg-gray-700">
    <td class="py-3 px-4">{{ $user->id }}</td>
    <td class="py-3 px-4">{{ $user->name }}</td>
    <td class="py-3 px-4">{{ $user->email }}</td>
    <td class="py-3 px-4">
        @if ($user->is_admin)
            <span title="Admin"><i class="fas fa-check text-green-500 text-xl"></i></span>
        @else
            <span title="Client"><i class="fas fa-times text-red-500 text-xl"></i></span>
        @endif
    </td>
    <td class="py-3 px-4">{{ $user->country_code . ' ' . $user->phone }}</td>
    {{-- <td class="py-3 px-4">{{ $user->created_at->diffForHumans() }}</td>
    <td class="py-3 px-4">{{ $user->updated_at->diffForHumans() }}</td> --}}
    <td class="py-3 px-4">
        <a href="{{ route('users.show', $user) }}" class="text-yellow-400 hover:underline mr-2">Show</a>
    </td>
</tr>
