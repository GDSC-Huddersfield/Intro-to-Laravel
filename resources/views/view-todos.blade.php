@extends('layouts.app')

@section('body')
    <div class="grid place-items-center mt-2">
        @foreach ($todos as $todo)
            <div class="w-full max-w-md">
                <div class="bg-white shadow-lg rounded mb-4 border-2 border-blue-500 relative">
                    <div >
                        <div class="m-2 underline">
                            {{$todo->name}}
                        </div>
                        <div class="m-2 mt-0 text-sm text-gray-400">
                            {{$todo->description}}
                        </div>
                    </div>
                    <div class="absolute inset-y-0 right-0">
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('status-update', [
                            'todo' => $todo->id,
                            'status' => !$todo->done
                        ])}}">
                            {!! $todo->done ? "Mark as not done" : "Mark as done" !!}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
