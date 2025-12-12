<x-client.layout title="Edit Your Account">
    <form action="{{ route('user.update') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg max-w-3xl mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-300 mb-2">Name</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 bg-gray-700 text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" required value="{{ old('name', $user->name) }}">
            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-300 mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 bg-gray-700 text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" required value="{{ old('email', $user->email) }}">
            @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-300 mb-2">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 bg-gray-700 text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('password')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        <x-utils.form.phone :user="$user" />

        <div class="flex justify-end space-x-4">
            <a href="{{ route('home') }}" class="px-6 py-2 bg-gray-700 text-gray-200 rounded-md shadow hover:scale-105 transition">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-md shadow hover:scale-105 transition">Update</button>
        </div>
    </form>
</x-client.layout>
