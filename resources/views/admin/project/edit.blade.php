@extends('layouts.dashboard')

@section('title')
Portfolio | Project Edit
@endsection

@section('content')
<h1>Modifica Projects: {{$project->name}}</h1>
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="{{route ('admin.project.update', $project)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method ('PUT')
    <div class="form-group mb-3">
        <label for="name" class="form-label @error('name') is-invalid @enderror">Name</label>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="name" id="name" class="form-control" value="{{old ('name') ?? $project->name }}">
    </div>
    <div class="form-group mb-3">
        <label for="description" class="form-label @error('description') is-invalid @enderror">Description</label>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <textarea name="description" id="description" class="form-control" rows="5">{{old ('description') ?? $project->description }}</textarea>
    </div>
    <div class="form-group mb-3">
        <label for="client" class="form-label @error('client') is-invalid @enderror">Client</label>

        <input type="text" name="client" id="client" class="form-control" value="{{old ('client') ?? $project->client }}">
    </div>
    <div class="form-group mb-3">
        <label for="img" class="form-label @error('image') is-invalid @enderror">image</label>

        <input type="file" name="image" id="img" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="project-types" class="form-label">Types</label>
        @error('type_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <select class="form-select form-select-lg @error('type_id') is-invalid @enderror" name="type_id" id="project-types">
            <option value="">-- Choose a type --</option>
            @foreach($types as $type)
                <option value="{{$type->id}}" {{old('type_id', $project->type_id) == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        @foreach($technologies as $technology)
        <div class="form-check @error('technologies') is invalid @enderror">
        @if($errors->any())
            <input 
                class="form-check-input" 
                type="checkbox" 
                name="technologies[]" 
                value="{{$technology->id}}"
                id="technology-checkbox-{{$technology->id}}"
                {{in_array($technology->id, old('technologies',[])) ? 'checked' : ''}}>
            
        @else
            <input 
                class="form-check-input" 
                type="checkbox" 
                name="technologies[]" 
                value="{{$technology->id}}"
                id="technology-checkbox-{{$technology->id}}"
                {{($project->technologies->contains($technology)) ? 'checked' : ''}}>
            
        @endif
            <label class="form-check-label" for="technology-checkbox-{{$technology->id}}">
            {{$technology->name}}
            </label>
        </div>
        @endforeach
        @error('technologies')
            div{{$message}}
        @enderror
    </div>

    <button class="btn btn-primary">Edit Project</button>
</form>

@endsection