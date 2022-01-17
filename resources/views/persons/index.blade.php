@extends('persons.layout')
          <div class="dash">
            <a class="dropdown-item" href="{{ route('companies.index') }}"> {{ __('companies') }}</a>
          </div>
@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('persons.create') }}"> Create New person</a>
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
            <th>Phone</th>
            <th>Linkdin profile</th>
            <th>Company</th>
            <th width="300px">Action</th>        </tr>
        @foreach ($contactperson as $person)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $person->FirstName .$person->LastName}}</td>
            <td>{{  $person->Email}}</td>
            <td>{{  $person->Phone}}</td>
            <td>{{  $person->LinkdinProfileURL}}</td>
            <td>{{  $person->company->Name}}</td>

            <td>
                    <a class="btn btn-info" href="{{ route('persons.show',$person->id) }}">Show</a>    
                    <a class="btn btn-primary" href="{{ route('persons.edit',$person->id) }}">Edit</a>  
                    <form action="{{ route('persons.destroy',$person->id) }}" class="companyform" method="POST">   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
            </td>
        </tr>
        @endforeach
    </table>  
    {!! $contactperson->links() !!}      
@endsection