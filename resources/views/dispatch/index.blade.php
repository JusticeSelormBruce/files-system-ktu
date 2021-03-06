@extends('layouts.admin')
@section('render')

    <div class="container-fluid pt-5">
        <div class=" pt-1">
            @if(session()->has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="row">
                        <div class="mx-auto w-50">
                            {{session()->get('msg')}}
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="ml-auto mx-5"><a href="/decision-board" class="btn btn-primary btn-sm">Dispatch</a></div>
            </div>
            <div>
                @include('dispatch.list')
            </div>
        </div>
    </div>
@endsection
