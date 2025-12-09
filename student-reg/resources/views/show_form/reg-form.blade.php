<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="form-container">
        <form method="post" action="/show">
            <h2>Registration Form</h2>

            <label for="Fname">First Name:</label>
            <input type="text" id="Fname" name="Fname" value="{{ old('Fname') }}" required>
            @error('Fname') <span class="error">{{ $message }}</span> @enderror


            <label for="Lname">Last Name:</label>
            <input type="text" id="Lname" name="Lname" value="{{ old('Lname') }}" required>
            @error('Lname') <span class="error">{{ $message }}</span> @enderror


            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" maxlength="10" required>
            @error('phone') <span class="error">{{ $message }}</span> @enderror

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required>
            @error('dob') <span class="error">{{ $message }}</span> @enderror

            <label>Gender:</label>
            <div class="gender-box">
                <input type="radio" id="male" name="gender" value="male" {{ old('gender')=='male' ? 'checked' : '' }} required>
                Male
                <input type="radio" id="female" name="gender" value="female" {{ old('gender')=='female' ? 'checked' : '' }} required>
                Female
            </div>
            @error('gender') <span class="error">{{ $message }}</span> @enderror

            <label for="YOP">Year of Passing:</label>
            <select name="YOP" id="YOP">
                <option value="disabled">Select Year</option>
                <option value="2020" {{ old('YOP')=='2020'?'selected':'' }}>2020</option>
                <option value="2021" {{ old('YOP')=='2021'?'selected':'' }}>2021</option>
                <option value="2022" {{ old('YOP')=='2022'?'selected':'' }}>2022</option>
                <option value="2023" {{ old('YOP')=='2023'?'selected':'' }}>2023</option>
                <option value="2024" {{ old('YOP')=='2024'?'selected':'' }}>2024</option>
            </select>
            @error('YOP') <span class="error">{{ $message }}</span> @enderror

            <label for="skills">Skills:</label>
            <div class="skills-box">
                <input type="checkbox" name="skills[]" value="HTML" {{ is_array(old('skills')) && in_array('HTML', old('skills')) ? 'checked' : '' }}> HTML
                <input type="checkbox" name="skills[]" value="CSS" {{ is_array(old('skills')) && in_array('CSS', old('skills')) ? 'checked' : '' }}> CSS
                <input type="checkbox" name="skills[]" value="JavaScript" {{ is_array(old('skills')) && in_array('JavaScript', old('skills')) ? 'checked' : '' }}> JavaScript
            </div>
            @error('skills') <span class="error">{{ $message }}</span> @enderror


            <label for="address">Address:</label>
            <textarea id="address" name="address" required>{{ old('address') }}</textarea>
            @error('address') <span class="error">{{ $message }}</span> @enderror

            <input type="submit" value="Submit">

            @csrf
        </form>

</body>

</html>