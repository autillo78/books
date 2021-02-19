@extends('layouts.app')

@section('body')

    <a href="{{url()->previous()}}" class="btn btn-outline-secondary float-right">Back</a>
    <br>

    <div class="card mt-3">

        <div class="card-header">
            <b>Book Details</b>
            
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
                        <th scope="col">Added</th>
                        <th scope="col">Completed</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <tr onclick="window.location='{{route('books.edit', $book->id)}}'" class="pointer">
                        <td>{{$book->title}}</td>
                        <td>{{$book->pages}}</td>
                        <td>{{$book->type->type}}</td>
                        <td>
                        @foreach ($book->authors as $author)
                            {{$author->name}}@if (!$loop->last), @endif
                        @endforeach
                        </td>
                        <td>{{$book->format->type}} / {{$book->language->code}}</td>
                        <td>{{$book->created_at->format('d-m-Y')}}</td>
                        @if (!$book->bookEnds->isEmpty())
                            {{-- for now only once --}}
                            <td>{{$book->bookEnds}}</td>
                        @else
                            <td>in proccess</td>
                        @endif
                        <td>
                            <i class="far fa-edit" title="click on the row to edit" data-toggle="tooltip" data-placement="top"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


    {{-- notes  --}}
    <div class="card mt-5">

        <div class="card-header">
            <b>Notes</b>
            <a href="{{route('bookNote.create', $book->id)}}" class="btn-sm btn-primary  float-right">Add</a>
        </div>

        <div class="card-body">

            @if (!$book->notes->isEmpty())
            <table class="table table-hover">
                <thead>
                    <th>Page</th>
                    <th>Note</th>
                    <th>Lang</th>
                    <th>Date</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($book->notes as $note)
                    <tr onclick="window.location='{{route('bookNote.edit', [$book->id, $note->id])}}'" class="pointer">
                        <td>{{$note->pages}}</td>
                        <td>{{$note->text}}</td>
                        <td>{{$note->language->code}}</td>
                        <td>{{$note->created_at->format('d-m-Y')}}</td>
                        <td>
                            <i class="far fa-edit" title="click on the row to edit" data-toggle="tooltip" data-placement="top"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
                No notes yet
            @endif
            
        </div>

    </div>



    {{-- readings  --}}
    <div class="card mt-5">

        <div class="card-header">
            <b>Readings</b>
            <a href="#" class="btn-sm btn-primary  float-right">Add</a>
        </div>

        <div class="card-body">

            @if (!$book->readings->isEmpty())
            <table class="table">
                <thead>
                    <th>Date</th>
                    <th>Starting Page</th>
                </thead>
                <tbody>
                    @foreach ($book->readings as $reading)
                    <tr>
                        <td>{{$reading->date}}</td>
                        <td>{{$reading->starting_page}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
                No readings yet
            @endif
            
        </div>

    </div>

@endsection