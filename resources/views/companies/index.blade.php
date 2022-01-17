@extends('companies.layout')
       <div class="dash">
          <a class="dropdown-item" href="{{ route('persons.index') }}"> {{ __('persons') }}</a> 
        
       </div>
@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Post</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Logo</th>
            <th>Website_URL</th>
            <th width="300px">Action</th>
        </tr>
        @foreach ($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td>{{ $company->Name}}</td>
            <td>{{  $company->Email}}</td>
            <td><img src="{{$company->logo_Url}}" width="50px" height="50px" alt="" title="" /></td>
            <td>{{  $company->Website_URL}}</td>
            <td>
                    <a class="btn btn-info" href="{{ route('companies.show',$company->id) }}">Show</a>    
                    <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>  
                    <form action="{{ route('companies.destroy',$company->id) }}" class="companyform" method="POST">   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
            </td>
        </tr>
        @endforeach
    </table>  
    {!! $companies->links() !!}      
@endsection