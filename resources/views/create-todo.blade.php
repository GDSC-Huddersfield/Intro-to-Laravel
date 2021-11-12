@extends('layouts.app')

@section('body')
    <div class='grid place-items-center h-screen mt-2'>
        <div class="w-full max-w-xs">
            <div class="grid place-items-center bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4 border-2 border-blue-500">
                <div class="block text-gray-700 text-sm font-bold mb-2">
                    Create TODO
                </div>
                <form action={{route("todo.store")}} method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Name
                        </label>
                        <input id="name" name="name" type="text" placeholder="Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Description
                        </label>
                        <input id="description" name="description" type="text" placeholder="Description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <input type="submit" value="Create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                </form>
            </div>
        </div>
    </div>
@endsection
