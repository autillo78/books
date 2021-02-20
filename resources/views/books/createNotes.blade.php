@extends('layouts.app')

@section('body')

<a href="{{url()->previous()}}" class="btn btn-outline-secondary float-right">back</a>
<br>

<div class="card mt-3">

    <form action="{{route('bookNote.store', $data->getBookId())}}" method="POST">
        @csrf

        <div class="card-header">
            <b>Add Note</b>
            <input type="submit" value="Save" class="btn-sm btn-primary float-right">
        </div>

        <div class="card-body">
            
            @include('layouts.errorMessage')
            
            <div class="form-row pt-3 pl-3 pr-3">
                <div class="col-2">
                    <label for="pages">Pages</label>
                    <input type="number" name="pages" id="pages"
                            class="form-control @error('pages') is-invalid @enderror"
                            value="{{old('pages')}}">
                </div>
                <div class="col-1"></div>
                <div class="col-3">
                    <label for="">Language</label><br>
                    @foreach ($data->getLanguages() as $lang)
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

            <div class="form-row p-3">
                <div class="col-12">
                    <label for="text">Note</label>
                    <textarea name="text" id="text" rows="5" class="form-control @error('text') is-invalid @enderror">{{old('text')}}</textarea>
                </div>
            </div>

        </div>
    </form>

</div>

    
@endsection