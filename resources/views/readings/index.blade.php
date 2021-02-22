@extends('layouts.app')

@section('body')

    <div class="card mt-3">

        <div class="card-header bg-card-header">
            <b>Readings</b>
            <a href="{{route('readings.create')}}" class="btn-sm btn-primary float-right">New</a>
        </div>

        <div class="card-body">
            @foreach ($books as $book)
            <div class="card mb-3">
                <div class="card-header">
                    <b>{{ucfirst($book->title)}}</b>
                    <small> &nbsp; (pages: {{$book->pages}})</small>
                </div>
                <div class="card-body">
                    @isset($book->readings[0])
                    <div class="row">
                        <div class="col-4">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Pages Read</th>
                                        <th>Last Page</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $lastLoopPage = 0 @endphp
                                @foreach ($book->readings as $reading)
                                    <tr>
                                        <td><small>{{$reading->date->format('d-M-Y')}}</small></td>
                                        <td class="text-center">{{$reading->last_page - $lastLoopPage}}</td>
                                        <td class="text-center">{{$reading->last_page}}</td>
                                    </tr>
                                    @php $lastLoopPage = $reading->last_page @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-3">Pages to end:</div>
                                <div class="col-2">{{$book->pages - $lastLoopPage}}<br></div>
                            </div>
                            <div class="row">
                                <div class="col-3">Total days of reading:</div>
                                <div class="col-2">{{count($book->readings)}}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Avg. pages/reading:</div>
                                <div class="col-2">{{$lastLoopPage / count($book->readings)}}</div>
                            </div>
                        </div>
                    </div>
                    @else
                    Not read yet
                    @endif

                </div>
            </div>
            @endforeach
        </div>
    </div>






</div>
</div>
    
@endsection