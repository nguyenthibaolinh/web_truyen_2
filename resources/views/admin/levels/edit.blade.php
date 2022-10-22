@extends('layout.master')
@section('main')
    @push('css')
    <style>
        .card {
            max-width: 400px;
            margin: auto;
        }
    </style>
    @endpush
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                        <h3 style="padding: 24px 24px 0;">{{ $title ?? '' }}</h3>
                    <hr>
                </div>
                <div class="content">
                    <form action="{{ route("admin.$table.update", $level->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name" class="control-label">Tên</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $level->name }}">
                            @if ($errors->any())
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="describe" class="control-label">Mô tả</label>
                            <textarea class="form-control" rows="4" name="descriptions" id="describe">
                            {{ $level->descriptions }}
                            </textarea>
                            @if ($errors->any())
                                <span class="text-danger">{{ $errors->first('descriptions') }}</span>
                            @endif
                        </div>
                        <div class="footer text-center">
                            <button class="btn btn-primary">Sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
