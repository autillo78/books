@extends('layouts.app')

@section('body')


<a href="{{url()->previous()}}" class="btn btn-outline-secondary float-right">Back</a>
<br>

<div class="card mt-3">

    <form action="{{route('books.update', $book->id)}}" method="post">
        @csrf
        @method('PUT')

        <div class="card-header">
            <b>Update Book Details</b>
            <input type="submit" value="Save" class="btn-sm btn-primary float-right">
        </div>

        <div class="card-body">
            <div class="form-row pt-3 pr-3 pl-3">
                <div class="col-6">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$book->title}}" required>
                </div>
                <div class="col-6">
                    <label for="authors">Author</label>
                    <input type="text" name="authors" id="authors" class="form-control" 
                            value="@foreach ($book->authors as $author){{$author->name}}@if (!$loop->last),@endif @endforeach" required>
                </div>
            </div>

            <div class="form-row p-3">
                <div class="col-2">
                    <label for="pages">Pages</label>
                    <input type="number" name="pages" id="pages" class="form-control" value="{{$book->pages}}">
                </div>            
                <div class="col-2">
                    <label for="format_id">Format</label>
                    <select name="format_id" id="format_id" class="form-control" required>
                        @foreach ($formats as $format)
                        <option value="{{$format->id}}" @if ($format->id == $book->format->id) selected @endif>{{$format->type}}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="col-4">
                    <label for="type_id">Type</label>
                    <select name="type_id" id="type_id" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if ($category->id == $book->type->id) selected @endif>{{$category->type}}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="col-1"></div>
                <div class="col-3">
                    <label for="language_code">Language</label>
                    <br>
                    @foreach ($languages as $lang)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="language_code" id="{{$lang->code}}" 
                                value="{{$lang->code}}" @if ($lang->code == $book->language->code) checked @endif>
                        <label class="form-check-label" for="{{$lang->code}}">{{$lang->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>

</div>
    
@endsection