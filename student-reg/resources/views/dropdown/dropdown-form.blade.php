<!DOCTYPE html>
<html>

<head>
    <title>Dependent Dropdown</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dropdown-container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        select {
            width: 200px;
            padding: 10px 15px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: border 0.3s, box-shadow 0.3s;
        }

        select:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #333;
        }
    </style>
</head>

<body>

    <select id="country">
        <option value="">Select Country</option>
        <option value="1">India</option>
        <option value="2">USA</option>
    </select>

    <select id="state">
        <option value="">Select State</option>
        <option value="1">Maharashtra</option>
        <option value="2">Karnataka</option>
        <option value="3">California</option>
        <option value="4">Texas</option>
    </select>

    <select id="city">
        <option value="">Select City</option>
        <option value="1">Mumbai</option>
        <option value="2">Pune</option>
        <option value="3">Bangalore</option>
        <option value="4">Mysore</option>
        <option value="5">Los Angeles</option>
        <option value="6">San Francisco</option>
        <option value="7">Houston</option>
        <option value="8">Dallas</option>
    </select>

    <script>
        const countrySelect = document.getElementById('country');
        const stateSelect = document.getElementById('state');
        const citySelect = document.getElementById('city');

        countrySelect.addEventListener('change', function() {
            const country_id = this.value;
            stateSelect.innerHTML = '<option>Select State</option>';
            citySelect.innerHTML = '<option>Select City</option>';

            if (country_id) {
                fetch('/get-states?country_id=' + country_id)
                    .then(response => response.text())
                    .then(data => {
                        stateSelect.innerHTML = '<option value="">Select State</option>' + data;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                stateSelect.innerHTML = '<option value="">Select State</option>';
            }
        });

        stateSelect.addEventListener('change', function() {
            const state_id = this.value;
            citySelect.innerHTML = '<option>Select City</option>';

            if (state_id) {
                fetch('/get-cities?state_id=' + state_id)
                    .then(response => response.text())
                    .then(data => {
                        citySelect.innerHTML = '<option value="">Select City</option>' + data;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                citySelect.innerHTML = '<option value="">Select City</option>';
            }
        });
    </script>

</body>

</html>