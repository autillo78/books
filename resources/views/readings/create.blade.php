@extends('layouts.app')

@section('body')
    
<a href="{{url()->previous()}}" class="btn btn-outline-secondary float-right">Back</a>
<br>

@include('layouts.errorMessage')

<div class="card mt-3">

    <form action="{{route('readings.store')}}" method="POST">
    @csrf

        <div class="card-header bg-card-header">
            <b>New Reading</b>
            <input type="submit" value="Save" class="btn-sm btn-primary float-right">
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-2">
                    <label for="lastPage">Last Page</label>
                    <input type="number" name="lastPage" id="lastPage"
                        class="form-control @error('lastPage') is-invalid @enderror"
                        value="{{old('lastPage')}}" required>
                </div>
                <div class="col-6">
                    <label for="bookId">Book</label>
                    <select name="bookId" id="bookId"
                        class="form-control" required>
                        <option value=""></option>
                        @foreach ($books as $book)
                            <option value="{{$book->id}}" @if ($book->id === old('bookId')) selected @endif>
                                {{$book->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date"
                        class="form-control" @error('date') is-invalid @enderror
                        value="{{old('date',date('Y-m-d'))}}">
                </div>
            </div>
        </div>

    </form>

</div>

@endsection