<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-black">
    <h1 class="text-center text-light mt-5">Word Functions</h1>
    <form id="Form">
        @csrf
        <div class="row gap-3 mt-5 ms-5">
            <div class="col-6 text-center">
                <label for="word" class="form-label text-light">Enter a word:</label>
                <input type="text" id="word" class="form-control" name="word" required>
            </div>
            <div class="col-3 text-center d-flex justify-content-start mt-4">
                <button type="submit" class="btn btn-light mb-3">Submit</button>
            </div>
            <div class="col-4 text-center">
                <label for="idx" class="form-label text-light"> Find Index </label>
                <input type="number" id="idx" class="form-control" name="index">
            </div>
            <div class="col-4 text-center d-flex justify-content-start mt-4">
                <button class="btn btn-light mb-3">Find </button>
            </div>
            <div class="col-4 text-center">
                <label class="form-label text-light">Replace word</label>
                <input type="text" class="form-control" name="replace">
            </div>
            <div class="col-4 text-center">
                <label class="form-label text-light">New word</label>
                <input type="text" class="form-control" name="new">
            </div>
            <div class="col-2 text-center d-flex justify-content-start mt-4">
                <button class="btn btn-light mb-3">Replace </button>
            </div>

            <div class="col-4 text-center">
                <label class="form-label text-light">word 1</label>
                <input type="text" class="form-control" name="word1">
            </div>

            <div class="col-4 text-center">
                <label class="form-label text-light">word 2</label>
                <input type="text" class="form-control" name="word2">
            </div>

            <div class="col-2 text-center d-flex justify-content-start mt-4">
                <button class="btn btn-light mb-3"> join </button>
            </div>

            <div class="col-4 text-center">
                <label class="form-label text-light">Enter words with dots</label>
                <input type="text" class="form-control" name="words">
            </div>

            <div class="col-2 text-center d-flex justify-content-start mt-4">
                <button class="btn btn-light mb-3"> split </button>
            </div>

        </div>

        <div id="result" class="m-5 text-light"></div>
    </form>
    <script>
        document.getElementById("Form").addEventListener("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            fetch("/wordprocess", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    document.getElementById("result").innerHTML = data;
                })
                .catch(err => console.error("Error:", err));
        });
    </script>
</body>

</html>