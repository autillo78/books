@extends('layouts.app')

@section('body')

    <a href="{{url()->previous()}}" class="btn btn-outline-secondary float-right">Back</a>
    <br>

    <div class="card mt-3">

        <div class="card-header">
            Book Details
            <a href="{{route('books.edit', $book->id)}}" class="btn btn-outline-primary  float-right">Update</a>
        </div>
        <div class="card-body">
        
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Type</th>
                        <th scope="col">Author</th>
                        <th scope="col">Format / Lang</th>
                        <th scope="col">Added</th>
                        <th scope="col">End</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{$book->title}}</td>
                        <td>{{$book->pages}}</td>
                        <td>{{$book->type->type}}</td>
                        <td>
                        @foreach ($book->authors as $author)
                            {{$author->name}}@if (!$loop->last), @endif
                        @endforeach
                        </td>
                        <td>{{$book->format}} / {{$book->language->code}}</td>
                        <td>{{$book->created_at->format('d-m-Y')}}</td>
                        @if (!$book->bookEnds->isEmpty())
                            {{-- for now only once --}}
                            <td>{{$book->bookEnds}}</td>
                        @else
                            <td>in proccess</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


    {{-- notes  --}}
    <div class="card mt-5">

        <div class="card-header">
            Notes
            <a href="#" class="btn btn-outline-primary  float-right">Add</a>
        </div>

        <div class="card-body">

            @if (!$book->bookNotes->isEmpty())
            <table class="table">
                <thead>
                    <th>Pages</th>
                    <th>Note</th>
                    <th>Lang</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    @foreach ($book->bookNotes as $note)
                    <tr>
                        <td>{{$note->pages}}</td>
                        <td>{{$note->note}}</td>
                        <td>{{$note->language->code}}</td>
                        <td>{{$note->created_at->format('d-m-Y H:i')}}</td>
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
            Readings
            <a href="#" class="btn btn-outline-primary  float-right">Add</a>
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
                No notes yet
            @endif
            
        </div>

    </div>

@endsection