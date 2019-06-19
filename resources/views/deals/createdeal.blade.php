@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="btn-success" href="/back">Back</a></br></br></br>
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
            
                    <form method="post" action="{{ route('deals.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="title" placeholder="Enter Deal Title" >
                        <input type="text" name="link" placeholder="Enter Deal Url"></br></br>
                        <label><strong>Select discount</strong>&nbsp;</label>
                        <select name="discount">
                            <option>select</option>
                            <option value="10">10%</option>
                            <option value="20">20%</option>
                            <option value="30">30%</option>
                            <option value="40">40%</option>
                            <option value="50">50%</option>
                            <option value="60">60%</option>
                            <option value="70">70%</option>
                            <option value="80">80%</option>
                            <option value="90">90%</option>
                            <option value="100">100%</option>
                        </select></br>
                        <input type="file" name="image" >
                        
                        <input type="submit" name="add" value="Add Deal">
                    </form>
                    {{--  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
