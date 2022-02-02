<!DOCTYPE html>
<html>

<head>
  <title>Laravel 8 -Edit Student</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 600px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
	@if (session('error'))
	<div class="alert alert-error">
		{{ session('error') }}
	</div>
	@endif
				
	<h2>Edit Student</h2>
    <form method="post" id="add_create" name="add_create" action="{{ route('student.update', $student->id) }}">
	 @csrf
	 @method('PUT')
	 
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
			@error('name')
			<div class="invalid-feedback">
				{{ $message }}
			</div>
			@enderror
      </div>
	  <div class="form-group">
        <label>Gender</label>
        <select name="gender" class="form-control" required>
			
			<option value="Male" {{ $student->gender == 'Male' ? 'selected':'' }}>Male</option>
            <option value="Female" {{ $student->gender == 'Female' ? 'selected':'' }}>Female</option>
		</select>
      </div>

      <div class="form-group">
        <label>Age</label>
        <input type="text" name="age" class="form-control" value="{{ old('age', $student->age) }}" required>
		
		@error('age')
		<div class="invalid-feedback">
			{{ $message }}
		</div>
		@enderror
      </div>
	  <br/>

      <div class="form-group">
        <button type="submit" class="btn btn-md btn-primary">Update Data</button>
		<a href="{{ route('student.index') }}" class="btn btn-md btn-secondary">back</a>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  
</body>

</html>