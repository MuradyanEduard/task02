@extends('layouts.app')

@section('content')
    <div class="m-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        @if (session()->has('message'))
            <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium"> {{ session()->get('message') }} </span>
            </div>
        @endif
        <a href="#">
            <img class="rounded-t-lg" src="{{ asset('images/book.jpg') }}" alt="" />
        </a>
        <div class="p-5">
            <form id="form-edit" action="{{ route('book.update', $book) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                        Title</label>
                    <input type="text" id="title" name="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" required value='{{ $book->title }}'>
                </div>

                @error('title')
                    <div class="mb-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                        role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                        Count</label>
                    <input type="number" id="count" name="count"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="10" required value='{{ $book->count }}'>
                </div>

                @error('count')
                    <div class="mb-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                        role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="decimal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                        Price</label>
                    <input type="number" id="price" name="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="10.000" required value='{{ $book->price }}'>
                </div>

                @error('price')
                    <div class="mb-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                        role="alert">
                        {{ $message }}
                    </div>
                @enderror
                @if (auth('web')->user()->role != App\Models\User::ROLE_AUTHOR)
                    <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Authors:</h2>
                    <select class="js-example-basic-multiple" name="authors[]" multiple="multiple">
                        @foreach ($book->authors as $author)
                            <option value="{{ $author->id }}" selected>{{ $author->name }}</option>
                        @endforeach
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                @else
                    <select name="authors[]" hidden></select>
                @endif
                @error('authors')
                    <div class="mb-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                        role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <a href="#" onclick="event.preventDefault(); document.getElementById('form-edit').submit();"
                    class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Edit
                    <i class="fa fa-edit w-4 h-4 ml-2 -mr-1"></i>
                    <input type="submit" value=" ">
                </a>
            </form>

        </div>
    </div>
@endsection

<script>
    addEventListener("load", (event) => {
        $(".js-example-basic-multiple option").each(function() {
            $(this).siblings('[value="' + this.value + '"]').remove();
        });
    });
</script>
