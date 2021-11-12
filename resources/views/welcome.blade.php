@extends('layouts.app')

@section('body')
    <div class='grid place-items-center h-screen mt-2'>
        <div class="w-full max-w-xs">
            <div class="grid place-items-center bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4 border-2 border-blue-500">
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('todo.create')}}">
                    Create Todo
                </a>
            </div>
            <div class="flex space-x-4 w-full">
                <a href="{{route('todo.index', ["type" => "current"])}}" class="text-gray-400 grid place-items-center flex-1">
                    <div class="text-center">
                        Current Todos:
                    </div>
                    <div class="text-center text-2xl">
                        {{ $currentTodo }}
                    </div>
                </a>
                <a href="{{route('todo.index', ["type" => "finished"])}}" class="text-gray-400 grid place-items-center flex-1">
                    <div class="text-center">
                        Finished Todos:
                    </div>
                    <div class="text-center text-2xl">
                        {{ $finishedTodo }}
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
