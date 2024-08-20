@extends('layouts.main')
@section('title') Urls @endsection
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Urls List</h4>
                  <a href="{{route('url.create')}}" class="btn btn-primary">Create</a>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Original Url</th>
                          <th>Short Url</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($urls as $url)
                            <tr>
                                <td>{{ $url->id }}</td>
                                <td>{{ $url->original_url }}</td>
                                <td>{{ $url->short_url }}</td>
                                <td>
                                    @if($url->is_disabled)
                                        <label class="badge badge-danger">Disabled</label>
                                    @else
                                        <label class="badge badge-success">Enabled</label>
                                    @endif
                                </td>
                                <td style="display: flex">
                                    <a href="{{ route('url.edit', $url->id) }}" class="btn btn-info" style="margin-right: 4px;">Edit</a>
                                    <form action="{{ route('url.destroy', $url->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="margin-right: 4px;">Delete</button>
                                    </form>
                                    @if(!$url->is_disabled)
                                        <form action="{{ route('url.disable', $url->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Disable</button>
                                        </form>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('page-script')
    <script type="text/javascript">
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('login') }}',
                    data: $('#loginForm').serialize(),
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
