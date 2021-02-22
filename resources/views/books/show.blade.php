@extends('layouts.app')

@section('body')

    <a href="{{url()->previous()}}" class="btn btn-outline-secondary float-right">Back</a>
    <br>

    <div class="card mt-3">

        <div class="card-header bg-card-header">
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

                    <tr onclick="window.location='{{route('books.edit', $data->getBooks()->id)}}'" class="pointer">
                        <td>{{$data->getBooks()->title}}</td>
                        <td>{{$data->getBooks()->pages}}</td>
                        <td>{{$data->getBooks()->type->type}}</td>
                        <td>
                        @foreach ($data->getBooks()->authors as $author)
                            {{$author->name}}@if (!$loop->last), @endif
                        @endforeach
                        </td>
                        <td>{{$data->getBooks()->format->type}} / {{$data->getBooks()->language->code}}</td>
                        <td>{{$data->getBooks()->created_at->format('d-m-Y')}}</td>
                        @if (!$data->getBooks()->bookEnds->isEmpty())
                            {{-- for now only once --}}
                            <td>{{$data->getBooks()->bookEnds}}</td>
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

        <div class="card-header bg-card-header">
            <b>Notes</b>
            <a href="{{route('bookNote.create', $data->getBooks()->id)}}" class="btn-sm btn-primary  float-right">Add</a>
        </div>

        <div class="card-body">

            @if (!$data->getBooks()->notes->isEmpty())
            <table class="table table-hover">
                <thead>
                    <th>Page</th>
                    <th>Note</th>
                    <th>Lang</th>
                    <th>Date</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($data->getBooks()->notes as $note)
                    <tr onclick="window.location='{{route('bookNote.edit', [$data->getBooks()->id, $note->id])}}'" class="pointer">
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

        <div class="card-header bg-card-header">
            <b>Readings</b>
        </div>

        <div class="card-body">

            @if (!$data->getBooks()->readings->isEmpty())
            <table class="table">
                <thead>
                    <th>Date</th>
                    <th>Starting Page</th>
                </thead>
                <tbody>
                    @foreach ($data->getBooks()->readings as $reading)
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