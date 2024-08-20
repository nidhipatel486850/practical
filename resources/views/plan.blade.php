@extends('layouts.main')
@section('title') Urls @endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Plan Upgrade</h4>
                    <form class="forms-sample" id="createForm">
                        @csrf
                      <div class="form-group">
                        <label for="url">Plan</label>
                        <select class="form-control">
                            <option value="10"> 10 URLs</option>
                            <option value="1000"> 1000 URLs </option>
                            <option value="unlimited"> Unlimited </option>
                        </select>
                      </div>
                      <button type="button" class="btn btn-primary me-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection

