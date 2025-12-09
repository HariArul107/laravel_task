<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- <form method="post" action="/submit-form"> -->
    <div class="form-container">
        <form id="studentForm">
            <h2>Registration Form</h2>

            <label for="Fname">First Name:</label>
            <input type="text" id="Fname" name="Fname" required>
            <span class="error" id="fnameErr"></span>


            <label for="Lname">Last Name:</label>
            <input type="text" id="Lname" name="Lname" required>
            <span class="error" id="lnameErr"></span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <span class="error" id="emailErr"></span>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" maxlength="10" required>
            <span class="error" id="phoneErr"></span>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            <span class="error" id="dobErr"></span>

            <label>Gender:</label>
            <div class="gender-box">
                <input type="radio" id="male" name="gender" value="male" required>
                Male
                <input type="radio" id="female" name="gender" value="female" required>
                Female
            </div>
            <span class="error" id="genderErr"></span>

            <label for="YOP">Year of Passing:</label>
            <select name="YOP" id="YOP">
                <option value="disabled">Select Year</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
            </select>
            <span class="error" id="yopErr"></span>

            <label for="skills">Skills:</label>
            <div class="skills-box">
                <input type="checkbox" id="html" name="skills[]" value="HTML"> <!-- if skills is empty gives warning -->
                HTML
                <input type="checkbox" id="css" name="skills[]" value="CSS">
                CSS
                <input type="checkbox" id="js" name="skills[]" value="JavaScript">
                JavaScript
            </div>
            <span class="error" id="skillsErr"></span>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
            <span class="error" id="addressErr"></span>

            <input type="submit" value="Submit">

            @csrf
        </form>
    </div>
    <div id="res"></div>
    <!-- @if(!empty($data)) -->
    <!-- <div class="result"> -->
    <!-- <h2>Submitted Data:</h2>
        <p><strong>First Name:</strong> {{ $data['Fname'] }}</p>
        <p><strong>Last Name:</strong> {{ $data['Lname'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Phone Number:</strong> {{ $data['phone'] }}</p>
        <p><strong>Date of Birth:</strong> {{ $data['dob'] }}</p>
        <p><strong>Gender:</strong> {{ $data['gender'] }}</p>
        <p><strong>Year of Passing:</strong> {{ $data['YOP'] }}</p>
        <p><strong>Skills:</strong> {{ is_array($data['skills']) ? implode(', ', $data['skills']) : 'None' }}</p>
        <p><strong>Address:</strong> {{ $data['address'] }}</p>  -->
    <!-- </div> -->
    <!-- @endif -->


    <script>
        document.getElementById('studentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // stop page reload
            let hasError = false;
            // 
            var errarr = ["fnameErr", "lnameErr", "emailErr", "phoneErr", "dobErr", "genderErr", "yopErr", "skillsErr", "addressErr"];
            for (var i = 0; i < errarr.length; i++) {
                document.getElementById(errarr[i]).textContent = "";
            }
            // Validate fields
            const fname = document.getElementById("Fname").value.trim();
            if (!/^[a-zA-Z-' ]+$/.test(fname)) {
                document.getElementById("fnameErr").textContent = "Invalid characters";
                hasError = true;
            }

            const lname = document.getElementById("Lname").value.trim();
            if (!/^[a-zA-Z-' ]+$/.test(lname)) {
                document.getElementById("lnameErr").textContent = "Invalid characters";
                hasError = true;
            }
            //
            const email = document.getElementById("email").value.trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById("emailErr").textContent = "Invalid email";
                hasError = true;
            }

            const phone = document.getElementById("phone").value.trim();
            if (!/^[0-9]{10}$/.test(phone)) {
                document.getElementById("phoneErr").textContent = "Invalid phone";
                hasError = true;
            }

            const dob = document.getElementById("dob").value;
            if (dob === "") {
                document.getElementById("dobErr").textContent = "Required";
                hasError = true;
            }

            const gender = document.querySelector("input[name='gender']:checked");
            if (!gender) {
                document.getElementById("genderErr").textContent = "Required";
                hasError = true;
            }

            const yop = document.getElementById("YOP").value;
            if (yop === "disabled") {
                document.getElementById("yopErr").textContent = "Select year";
                hasError = true;
            }

            const skills = document.querySelectorAll("input[name='skills[]']:checked");
            if (skills.length === 0) {
                document.getElementById("skillsErr").textContent = "Select at least one";
                hasError = true;
            }

            const address = document.getElementById("address").value.trim();
            if (address === "") {
                document.getElementById("addressErr").textContent = "Required";
                hasError = true;
            }
            if (hasError) return;


            let form = document.getElementById('studentForm');
            let formData = new FormData(form);

            fetch("/submit-form", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {

                    let skills = data.skills ? data.skills.join(", ") : "None";

                    document.getElementById('res').innerHTML = `
                    <div id="result">
            <h2>Submitted Data:</h2>
            <p><strong>First Name:</strong> ${data.fname}</p>
            <p><strong>Last Name:</strong> ${data.lname}</p>
            <p><strong>Email:</strong> ${data.email}</p>
            <p><strong>Phone:</strong> ${data.phone}</p>
            <p><strong>Date of Birth:</strong> ${data.dob}</p>
            <p><strong>Gender:</strong> ${data.gender}</p>
            <p><strong>Year of Passing:</strong> ${data.yop}</p>
            <p><strong>Skills:</strong> ${skills}</p>
            <p><strong>Address:</strong> ${data.address}</p>
        </div>`;
                })
                .catch(error => console.error("Error:", error));
        });
    </script>

</body>

</html>