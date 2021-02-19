@extends('layouts.app')

@section('body')


<a href="{{url()->previous()}}" class="btn btn-outline-secondary float-right">Back</a>
<br>

<div class="card mt-3">

    <form action="{{route('books.update', $data->getBookById()->id)}}" method="post">
        @csrf
        @method('PUT')

        <div class="card-header">
            <b>Update Book Details</b>
            <input type="submit" value="Save" class="btn-sm btn-primary float-right">
        </div>

        <div class="card-body">
            <div class="form-row pt-3 pr-3 pl-3">
                <div class="col-6">
                    <label for="title">Title <small>*</small></label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$data->getBookById()->title}}" required>
                </div>
                <div class="col-6">
                    <label for="authors">Author <small>(use , for multiple authors)</label>
                    <input type="text" name="authors" id="authors" class="form-control" 
                            value="{{old('authors', $data->getAuthorsOneLine())}}">
                </div>
            </div>

            <div class="form-row p-3">
                <div class="col-2">
                    <label for="pages">Pages</label>
                    <input type="number" name="pages" id="pages" class="form-control" value="{{$data->getBookById()->pages}}">
                </div>            
                <div class="col-2">
                    <label for="format_id">Format <small>*</small></label>
                    <select name="format_id" id="format_id" class="form-control" required>
                        @foreach ($data->getFormats() as $format)
                        <option value="{{$format->id}}" @if ($format->id == $data->getBookById()->format->id) selected @endif>{{$format->type}}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="col-4">
                    <label for="type_id">Type <small>*</small></label>
                    <select name="type_id" id="type_id" class="form-control">
                        @foreach ($data->getCategories() as $category)
                        <option value="{{$category->id}}" @if ($category->id == $data->getBookById()->type->id) selected @endif>{{$category->type}}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="col-1"></div>
                <div class="col-3">
                    <label for="language_code">Language</label>
                    <br>
                    @foreach ($data->getLanguages() as $lang)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="language_code" id="{{$lang->code}}" 
                                value="{{$lang->code}}" @if ($lang->code == $data->getBookById()->language->code) checked @endif>
                        <label class="form-check-label" for="{{$lang->code}}">{{$lang->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>

</div>
    
@endsection