@extends('admin.layouts.default')

@section('content')

    @include('layout.alerts')
    <div class="mt-3 justify-content-center row">
        <div class="col-md-6">
            <form action="{{ route('update-env', ['id' => $clientEnv->id]) }}" class="d-flex flex-column " method="post">
                <div class="form-group pb-3">
                    <label>Key Name<span style="color: red"> *</span></label>
                    <input id="key" name="key" type="text" class="form-control" required
                        value="{{ isset($clientEnv) ? $clientEnv->key : old('key', '') }}">
                </div>

                <div class="form-group pb-3">
                    <label>Value Name<span style="color: red"> *</span></label>
                    <input id="value" name="value" type="text" class="form-control" required
                        value="{{ isset($clientEnv) ? $clientEnv->value : old('value', '') }}">
                </div>

                <div class="d-flex form-group justify-content-between">
                    <a id="cancel-btn" class="btn btn-danger" href="{{ route('index-env') }}">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>




@endsection
