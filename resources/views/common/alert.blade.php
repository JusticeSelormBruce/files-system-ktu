
<div class="row">
<div class="mx-auto mx-5">
@if(session()->has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="row">
                <div class="mx-auto  h3 text-danger">
                    {{session()->get('msg')}}
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif</div>
</div>
 

