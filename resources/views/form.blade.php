<!DOCTYPE html>
<html>
    <head>
        <title>FCA Verification</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    <h2>FCA Verification</h2>
                </div>
                <div class="card-body">
                    <form name="employee" id="employee" method="post" action="{{url('verify/fca')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">FCA Number</label>
                            <input type="text" id="fcaNumber" name="fcaNumber"
                                   class="@error('fcaNumber') is-invalid @enderror form-control"  value="{{ old('fcaNumber') }}">
                            @error('fcaNumber')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" value="Validate">Submit</button>
                    </form>
                </div>
            </div>

            @if(Session::has('success'))
                <div class="card">
                    <div class="card-body alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif

        </div>
    </body>
</html>
