@extends('layouts.app')

@section('body')

<div class="card mt-3">

    <form action="{{route('books.store')}}" method="POST">
        @csrf

        <div class="card-header">
            <b>Add New Book</b>
            <input type="submit" value="Save" class="btn-sm btn-primary float-right">
        </div>

        <div class="card-body">

            @include('layouts.errorMessage')

            <div class="form-row pt-3 pr-3 pl-3">
                <div class="col-6">
                    <label for="title">Title <small>*</small></label>
                    <input type="text" name="title" id="title" value="{{old('title')}}"
                            class="form-control @error('title') is-invalid @enderror"
                            required autofocus placeholder="title">
                </div>

                <div class="col-6">
                    <label for="authors">Author <small>(use , for multiple authors)</small></label>
                    <input type="text" name="authors" id="authors" value="{{old('authors')}}"
                            class="form-control @error('authors') is-invalid @enderror"
                            placeholder="name+surname">
                </div>

                
            </div>

            <div class="form-row p-3">
                <div class="col-2">
                    <label for="pages">Pages</label>
                    <input type="number" name="pages" id="pages" value="{{old('pages')}}"
                            class="form-control @error('pages') is-invalid @enderror">
                </div>

                <div class="col-2">
                    <label for="format_id">Format <small>*</small></label>
                    <select id="format_id" name="format_id"
                            class="form-control @error('format_id') is-invalid @enderror"
                            required>
                        <option></option>
                        @foreach ($formats as $format)
                            <option value="{{$format->id}}" @if (old('format_id') == $format->id) selected @endif>
                                {{$format->type}} 
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-4">
                    <label for="type_id">Type <small>*</small></label>
                    <select id="type_id" name="type_id" 
                            class="form-control @error('type_id') is-invalid @enderror"
                            required>
                        <option value=""></option>
                        @foreach ($categories as $category) 
                        <option value="{{$category->id}}" @if (old('type_id') == $category->id) selected @endif>
                            {{$category->type}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-1"></div>

                <div class="col-3">
                    <label for="">Language</label><br>
                    @foreach ($languages as $lang)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="language_code" id="{{$lang->code}}" 
                                value="{{$lang->code}}" 
                                @if (old('language_code'))
                                    @if (old('language_code') == $lang->code) checked @endif
                                @else
                                    @if ($loop->first) checked @endif
                                @endif>
                        <label class="form-check-label" for="{{$lang->code}}">{{$lang->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>

</div>
    

{{-- books list --}}
<div class="card mt-5">
    <div class="card-header">
        <b>Books</b>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Pages</th>
                    <th scope="col">Type</th>
                    <th scope="col">Author</th>
                    <th scope="col">Format / Lang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr onclick="window.location='{{route('books.show', $book->id)}}'" class="pointer">
                    <td>{{$book->title}}</td>
                    <td>{{$book->pages}}</td>
                    <td>{{$book->type->type}}</td>
                        
                    <td>
                    @foreach ($book->authors as $author)
                        {{$author->name}}@if (!$loop->last), @endif
                    @endforeach
                    </td>
                   
                    <td>{{$book->format->type}} / {{$book->language->code}}</td>   
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection