@extends('layouts.main')
@section('title') Urls @endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{ @$url?'Update':'Create'}} Url</h4>
                    <form class="forms-sample" id="createForm">
                        @csrf
                        @if(@$url)
                            <input type="hidden" name="id" value="{{$url->id}}">
                        @endif
                      <div class="form-group">
                        <label for="url">Original Url</label>
                        <input type="text" class="form-control"  value="{{@$url->original_url?$url->original_url:''}}" name='original_url' id="url" placeholder="Original Url">
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection

@section('page-script')
    <script type="text/javascript">
            $('#createForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('url.store') }}',
                    data: $('#createForm').serialize(),
                    success: function (response) {
                        window.location.href='{{ route('url.index') }}';
                    },
                    error: function (xhr) {
                        alert(xhr.responseJSON.error);
                    }
                });
            });
    </script>
@endsection
