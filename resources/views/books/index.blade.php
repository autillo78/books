@extends('layouts.app')

@section('body')

<div class="card mt-3">

    <div class="card-header">
        Add New Book
    </div>

    <div class="card-body">
       
        <form action="{{route('books.store')}}" method="POST">
            @csrf

            <div class="row">
                <div class="col-11">

                    <div class="form-row pt-3 pr-3 pl-3">
                        <div class="col-6">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title"
                                    class="form-control @error('name') is-invalid @enderror"
                                    required autofocus placeholder="title">
                        </div>

                        <div class="col-6">
                            <label for="author">Author <small>(use , for multiple authors)</small></label>
                            <input type="text" name="author" id="author"
                                    class="form-control @error('author') is-invalid @enderror"
                                    placeholder="name+surname">
                        </div>

                        
                    </div>

                    <div class="form-row p-3">
                        <div class="col-2">
                            <label for="pages">Pages</label>
                            <input type="number" name="pages" id="pages"
                                    class="form-control @error('pages') is-invalid @enderror"
                                    required>
                        </div>

                        <div class="col-2">
                            <label for="format">Format</label>
                            <select id="format" name="format" 
                                    class="form-control @error('format') is-invalid @enderror"
                                    required>
                                <option></option>
                                <option value="paper">Paper</option>
                                <option value="ebook">eBook</option>
                                <option value="other">Other</option>
                            </select>
                                    
                        </div>
                        
                        <div class="col-4">
                            <label for="type">Type</label>
                            <select id="type" name="type" 
                                    class="form-control @error('type') is-invalid @enderror"
                                    required>
                                <option value=""></option>
                                @foreach ($types as $type) 
                                <option value="{{$type->id}}">{{$type->type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-1"></div>

                        <div class="col-3">
                            <label for="">Language</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="language" id="spanish" value="es" checked>
                                <label class="form-check-label" for="spanish">Spanish</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="language" id="english" value="en">
                                <label class="form-check-label" for="english">English</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <input type="submit" value="Save" class="btn btn-outline-primary float-right">
                </div>
            </div>
        </form>
    </div>

</div>
    

{{-- books list --}}
<div class="card mt-5">
    <div class="card-header">
        Books
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
                   
                    <td>{{$book->format}} / {{$book->language->code}}</td>   
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection