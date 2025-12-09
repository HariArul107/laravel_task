<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Slider</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #111;
            height: 100vh;
        }

        .header {
            margin: 20px 0px;
            color: white;
            font-family: Arial, sans-serif;
            font-size: 24px;
        }

        .slider {
            width: 1200px;
            height: 800px;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .slides {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .slide {
            width: 100%;
            height: 100%;
            position: absolute;
            opacity: 0;
            transition: 0.5s ease;
        }

        .slide.active {
            opacity: 1;
        }

        /* Buttons */
        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 40px;
            cursor: pointer;
            padding: 10px;
            user-select: none;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }

        /* Dots */
        .dots {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #bbb;
            margin: 5px;
            cursor: pointer;
        }

        .dot.active {
            background: #fff;
        }

        .controls {
            margin-top: 15px;
            text-align: center;
            color: white;
            font-family: Arial, sans-serif;
        }

        .controls input {
            padding: 5px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
        }

        .controls button {
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            background: #28a745;
            color: white;
        }

        .controls button:hover {
            background: #218838;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Image Slider</h1>
    </div>
    <div class="slider">
        <div class="slides">
            <img src="{{ asset('images/img1.jpg') }}" alt="image1" class="slide active">
            <img src="{{ asset('images/img2.jpg') }}" alt="image2" class="slide">
            <img src="{{ asset('images/img3.jpg') }}" alt="image2" class="slide">
        </div>

        <span class="prev" onclick="prevSlide()">&#10094;</span>
        <span class="next" onclick="nextSlide()">&#10095;</span>

        <div class="dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>

    <div class="controls">
        <label>Auto Slide Time (seconds): </label>
        <input type="number" id="timeInput" value="3" min="1" style="width: 50px;">
        <button type="button" onclick="setAutoSlide()">Set</button>
    </div>

    <script>
        let slides = document.querySelectorAll('.slide');
        let dots = document.querySelectorAll('.dot');
        let index = 0;
        let slideInterval;

        function showSlide(i) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            slides[i].classList.add('active');
            dots[i].classList.add('active');
        }

        function nextSlide() {
            index = (index + 1);
            if (index >= slides.length) {
                index = 0;
            }
            showSlide(index);
        }

        function prevSlide() {
            index = index - 1
            if (index < 0) {
                index = slides.length - 1;
            }
            showSlide(index);
        }
        for (let i = 0; i < dots.length; i++) {
            dots[i].onclick = () => {
                index = i;
                showSlide(i);
            };
        }

        function startAutoSlide(time) {
            slideInterval = setInterval(nextSlide, time);
        }

        function setAutoSlide() {
            let userTime = document.getElementById("timeInput").value;
            let interval = userTime * 1000;
            clearInterval(slideInterval);
            index = 0;
            startAutoSlide(interval);
        }
        startAutoSlide(3000);
    </script>
</body>

</html>