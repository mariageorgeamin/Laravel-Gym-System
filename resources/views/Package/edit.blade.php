@extends('admin')
@section('PageHeader')
<h1>
    Packages
    <small>Optional description</small>
</h1>
@endsection
@section('content')
<form action="{{route('Package.update', $package->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Package Name</label>
            <input name="name" type="text" class="form-control" id="name"  value={{$package->name}}>
        </div>
        <div class="form-group">
            <label for="number_of_sessions">No. Of sessions</label>
            <input type="number" name="number_of_sessions" value="{{$package->number_of_sessions}}" class="form-control"></input>
        </div>
        <div class="form-group">
            <label for="package_price">Price $ </label>
            <input type="number" name="price" value="{{$package->price}}" id="package_price"></input>

        </div>

         <div class="form-group">
            <label for="gym_id">Gym</label>
            <select class="form-control" name="gym_id">
                @foreach($gyms as $gym)
                @if ($gym->id == $package->gym_id)
                    <option value="{{$gym->id}}" selected>{{$gym->name}}</option>
                    @else
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection