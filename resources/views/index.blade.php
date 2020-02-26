@extends('layouts.main')
@section('content')
  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Let's get your vehicle back on the trail!</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- List Tickets -->
  <section class="bg-light">
    <div class="container">
      <div class="row">
          <table class="table table-striped">
            <thead>
              <th>Ticket #</th>
              <th>Client Name</th>
              <th>Status</th>
              <th>Last Update</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach($requests AS $request)
              <tr>
                <td>{{ $request->id }}</td>
                <td>{{ $request->client_name }}</td>
                <td>{{ $request->status }}</td>
                <td>{{ $request->updated_at->format('m/d/Y h:i a') }}</td>
                <td>
                  <div class="container">
                    <div class="row">
                      <a href="{{ route('edit',[$request->id]) }}" class="btn btn-primary pull-left">EDIT</a>&nbsp;&nbsp;
                      <form method="post" action="/service/{{$request->id}}/delete">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-danger" name="submit" value="Delete">
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        {{ $requests->links() }}
      </div>
    </div>
  </section>

@endsection