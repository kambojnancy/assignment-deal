@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="btn-success" type="button" href="{{ route('deals.create') }}">Make New Deal</a></br></br></br>
             @if ($message = Session::get('success'))
                 <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
             @endif  
             @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
            <table class="table">
                <thead>
                  <tr>
                    <th>Sr. No</th>
                    <th>User Name</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>Discount</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                    @foreach ($deals as $deal)
                  <tr>
                    
                    
                    <td>{{  ++$i  }}</td>
                    <td>{{ $deal->title }}</td>
                    <td>{{ $deal->user->name}}</td>
                    <td>{{ $deal->link}}</td>
                    <td><img src="{{ asset($deal->image) }}" height="100" width="100"></td>
                    <td>{{ $deal->discount}}</td>
                    {{-- <td></td>  --}}
                     <td>
                      <form action="{{ route('deals.destroy',$deal->id) }}" method="POST">
                          <a href="{{ route('deals.show',$deal->id) }}" class="btn-primary">Show</a>
                         
                           @csrf
                    @method('DELETE')
                     <button class="btn-danger" type="submit" >Delete</button> 
                      </form>
                    </td>
                  </tr>      
                  @endforeach
                </tbody>
              </table>
            
        </div>
    </div>
</div>
{!! $deals->links() !!}
@endsection
