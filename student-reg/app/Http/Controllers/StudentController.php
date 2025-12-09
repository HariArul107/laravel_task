<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class StudentController extends Controller
{
    public function viewform()
    {
        return view('student-reg');
    }
    public function form()
    {
        return view('show_form.reg-form');
    }
    public function showform(Request $request)
    {
        $validated = $request->validate([
            'Fname'  => ['required', 'regex:/^[a-zA-Z\-\' ]*$/'],
            'Lname'  => ['required', 'regex:/^[a-zA-Z\-\' ]*$/'],
            'email'  => 'required|email',
            'phone'  => ['required', 'regex:/^[0-9]{10}$/'],
            'dob'    => 'required|date',
            'gender' => 'required',
            'YOP'    => 'required|not_in:disabled',
            'skills' => 'required|array|min:1',
            'address' => 'required',
        ]);
        return view('show_form.show-form', ['data' => $validated]);
    }

    public function submitform(Request $request)
    {
        // $data = $request->all();
        // return view('student-reg', ['data' => $data]); 
        return response()->json([
            'fname' => $request->input('Fname'),
            'lname' => $request->input('Lname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
            'yop' => $request->input('YOP'),
            'skills' => $request->input('skills'),
            'address' => $request->input('address'),
        ]);
    }


    // ASCII Table Methods

    public function asciiform()
    {
        return view('ascii_table.ascii');
    }

    public function asciiprocess(Request $request)
    {
        $name = $request->input('name');
        if (empty($name)) {
            return response()->json(['status' => 'error', 'error' => 'Input cannot be empty.']);
        }
        $totalasciivalue = [];
        $asciiValues = "<table border='1'><tr><th>Character</th><th>ASCII Value</th><th>HexaDecimal value </th></tr>";
        for ($i = 0; $i < strlen($name); $i++) {
            $totalasciivalue[$i] = ord($name[$i]);
            $asciiValues .= "<tr><td>" . $name[$i] . "</td><td>" . ord($name[$i]) . " </td><td>" . dechex(ord($name[$i])) . "</td></tr>";
        }
        $asciiValues .= "</table><p>";
        for ($j = 0; $j < count($totalasciivalue); $j++) {
            $asciiValues .= $totalasciivalue[$j] . " ";
        }
        $asciiValues .= "</p>";

        return response()->json(['status' => 'success', 'ascii' => $asciiValues]);
    }

    // Multiplication Table Method
    public function multiform()
    {
        $col = 1;
        $row = 1;
        $action = '';

        return view('multi_table.multi', [
            'col' => $col,
            'row' => $row,
            'action' => $action
        ]);
    }

    public function multiprocess(Request $request)
    {
        $col = $request->input('col', 1);
        $row = $request->input('row', 1);
        $action = $request->input('click');

        return view('multi_table.multi', [
            'col' => $col,
            'row' => $row,
            'action' => $action
        ]);
    }

    // Image Slider Method
    public function slider()
    {
        return view('image_slider.img-slider');
    }

    // Number to Word Method
    public function numberform()
    {
        return view('numtoword.Num-Word');
    }


    public function numberprocess(Request $request)
    {
        function helper($num, $ones, $tens)
        {
            $word = '';

            if ($num >= 100) {
                $word .= $ones[(int)($num / 100)] . ' hundred ';
                $num = $num % 100;
            }

            if ($num >= 20) {
                $word .= $tens[(int)($num / 10)] . ' ';
                $num = $num % 10;
            }

            if ($num > 0) {
                $word .= $ones[$num] . ' ';
            }

            return $word;
        }

        function numberToWords($num)
        {
            $ones = [
                '',
                'one',
                'two',
                'three',
                'four',
                'five',
                'six',
                'seven',
                'eight',
                'nine',
                'ten',
                'eleven',
                'twelve',
                'thirteen',
                'fourteen',
                'fifteen',
                'sixteen',
                'seventeen',
                'eighteen',
                'nineteen'
            ];

            $tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

            if ($num == 0) return "zero";

            $result = '';

            // billions
            if ($num >= 1000000000) {
                $result .= helper(intval($num / 1000000000), $ones, $tens) . "billion ";
                $num %= 1000000000;
            }

            // crore
            if ($num >= 10000000) {
                $result .= helper(intval($num / 10000000), $ones, $tens) . "crore ";
                $num %= 10000000;
            }

            // million
            if ($num >= 1000000) {
                $result .= helper(intval($num / 1000000), $ones, $tens) . "million ";
                $num %= 1000000;
            }

            // lakh
            if ($num >= 100000) {
                $result .= helper(intval($num / 100000), $ones, $tens) . "lakh ";
                $num %= 100000;
            }

            // thousand
            if ($num >= 1000) {
                $result .= helper(intval($num / 1000), $ones, $tens) . "thousand ";
                $num %= 1000;
            }

            // last part (below 1000)
            if ($num > 0) {
                $result .= helper($num, $ones, $tens);
            }

            $result = trim($result);

            // check last two digits
            $lastTwo = $num % 100;
            if ($lastTwo % 10 == 0 && $lastTwo != 0) {
                $result .= " only";
            }

            return $result;
        }
        $number = $request->input('number');
        $res = numberToWords($number);
        return response()->json(['status' => 'success', 'res' => $res]);
    }

    // Age Calculator Method
    public function ageform()
    {
        return view('agecalculator.age-calculator');
    }

    public function ageprocess(Request $request)
    {
        $dob = $request->input('dob');
        $birthDate = new \DateTime($dob);
        $currentDate = new \DateTime();
        $ageInterval = $birthDate->diff($currentDate);
        $year = $ageInterval->y;
        $month = $ageInterval->m;
        $day = $ageInterval->d;
        $age =  "<div class='result'><h1>{$dob}</h1> Your Age is: {$year} Years, {$month} Months, {$day} Days.</div>";
        return $age;
    }
    // Word Game Methods
    public function wordform()
    {
        return view('word_game.wordindex');
    }

    public function wordprocess(Request $request)

    {
        $word = $request->input('word');

        $word1 = $request->input('word1');
        $word2 = $request->input('word2');
        if (!empty($word1) && !empty($word2)) {
            $arr = [$word1, $word2];
            $symbol = ".";
            $joinedResult = implode($symbol, $arr);
            $joinlen = strlen($joinedResult);
        } else {
            $joinedResult = "No Join Made";
            $joinlen = 0;
        }

        $words = $request->input('words');
        if (!empty($words)) {
            $parts = explode('.', $words);
            $charCount = strlen(implode('', $parts));
        } else {
            $parts = [];
            $charCount = 0;
        }



        if ($request->has('index')) {
            $index = $request->input('index');
        } else {
            $index = -1;
        }

        $replace = $request->input('replace');
        $new = $request->input('new');

        if (!empty($replace) && !empty($new)) {
            $newword = str_replace($replace, $new, $word);
            $newlen = strlen($newword);
        } else {
            $newword = "No Replacement Made";
            $newlen = 0;
        }

        if ($index > 0 && $index <= strlen($word)) {
            $charAtIndex = $word[$index - 1];
            $charlen = 1;
        } else {
            $charAtIndex = "Index out of bounds";
            $charlen = 0;
        }

        $letter1 = "";
        $letter2 = "";
        $number = "";
        $special = "";
        $reversed = strrev($word);
        $reversedlen = strlen($reversed);
        $low = strtolower($word);
        $up = strtoupper($word);
        for ($i = 0; $i < strlen($word); $i++) {
            $ch = $word[$i];
            if ($ch >= 'A' && $ch <= 'Z') {   // use in - build function or check $ch >= 'A' && $ch <= 'Z') || ($ch >= 'a' && $ch <= 'z')
                $letter1 = $letter1 . $ch;
            } elseif ($ch >= 'a' && $ch <= 'z') {
                $letter2 = $letter2 . $ch;
            } else if (ctype_digit($ch)) { // '0' <= $ch && '9' >= $ch
                $number = $number . $ch;
            } else {
                $special = $special . $ch;
            }
        }
        $letterlen1 = strlen($letter1);
        $letterlen2 = strlen($letter2);
        $numberlen = strlen($number);
        $speciallen = strlen($special);

        $res = " <div class='table-responsive'>
                <table class='table table-bordered table-striped table-hover text-center'>
         <thead class='table-dark'>
            <tr>
                 <td>Categories</td>
            <td>Value</td>
                    <td>Length</td>
           </tr>
               <thead>
             <tbody>
           <tr>
              <td>CAPITAL LETTER</td>
            <td>{$letter1}</td>
            <td>{$letterlen1}</td>
          </tr>
           <tr>
             <td>SMALL LETTER</td>
                 <td>{$letter2}</td>
              <td>{$letterlen2}</td>
          </tr>
           <tr>
               <td>NUMBER</td>
             <td>{$number}</td>
              <td>{$numberlen}</td>
           </tr>
             <tr>
              <td>SPECIALCHARACTER</td>
               <td>{$special}</td>
            <td>{$speciallen}</td>
           </tr>
            <tr>
            <td>REVERSED</td>
            <td>{$reversed}</td>
            <td>{$reversedlen}</td>
           </tr>
            <tr>
            <td>REPLACE</td>
              <td>{$newword}</td>
            <td>{$newlen}</td>
           </tr>
          <tr>
              <td>AFTER JOIN</td>
            <td>{$joinedResult}</td>
            <td>{$joinlen}</td>
          </tr>

           <tr>
            <td>After Split</td>
            <td>" . (!empty($parts) ? implode('<br>', $parts) : '<span class="text-muted">No data</span>') . "</td>
            <td>" . count($parts) . "</td>
          </tr>
       
           <tr>
               <td>TOUPPER</td>
            <td>{$up}</td>
               <td>{$reversedlen}</td>
          </tr>
           <tr>
            <td>TOLOWER</td>
            <td>{$low}</td>
            <td>{$reversedlen}</td>
            </tr>
             <tr>
              <td>INDEX</td>
               <td>{$charAtIndex}</td>
            <td>{$charlen}</td>
           </tr>
        </tbody>
         </table> 
       </div>";

        return $res;
    }

    // Email with OTP Methods
    public function emailform()
    {
        return view('email_task.email-form');
    }

    public function sendotp(Request $request)
    {
        Session::put('from_email', $request->from_email);
        Session::put('to_email', $request->to_email);
        Session::put('message', $request->message);

        // Save file temporarily
        // if ($request->hasFile('uploadfile')) {
        //     $file = $request->file('uploadfile');
        //     $path = $file->storeAs('temp', $file->getClientOriginalName());
        //     Session::put('file_path', storage_path('app/' . $path));
        // }
        if ($request->hasFile('uploadfile') && $request->file('uploadfile')->isValid()) {
            $file = $request->file('uploadfile');

            $dir = storage_path('app/temp');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            // Preserve original file name
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move uploaded file to storage/app/temp
            $file->move($dir, $filename);

            // Store the absolute path in session
            Session::put('uploaded_file', $dir . DIRECTORY_SEPARATOR . $filename);
        }



        // Generate OTP
        $otp = rand(1000, 9999);
        Session::put('otp', $otp);

        // Send OTP email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;

            $mail->Username   = "creativecoderx6@gmail.com"; // dynamic username
            $mail->Password   = "uswgtmufkbisjjic";   // app password (dynamic)

            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom("creativecoderx6@gmail.com", "OTP Verification");
            $mail->addAddress($request->to_email);

            $mail->isHTML(true);
            $mail->Subject = "Your OTP Code";
            $mail->Body    = "<h3>Your OTP is: <b>$otp</b></h3>";

            $mail->send();
        } catch (Exception $e) {
            return "OTP Email Error: {$mail->ErrorInfo}";
        }

        return view('email_task.otp-form'); // Blade for OTP input

    }

    public function verifyOtp(Request $request)
    {
        if ($request->otp_input == Session::get('otp')) {

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;

                $mail->Username   = Session::get('from_email');
                $mail->Password   = "uswgtmufkbisjjic";

                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom(Session::get('from_email'), 'Verified User');
                $mail->addAddress(Session::get('to_email'));



                $fullPath = Session::get('uploaded_file');

                if (!$fullPath || !file_exists($fullPath)) {
                    return "Attachment file missing or empty!";
                }

                $mail->addAttachment($fullPath, basename($fullPath));

                $mail->isHTML(true);
                $mail->Subject = "Verified Email";
                $mail->Body    = "<h1>This is the heading</h1>
                                  <h3>Message: " . Session::get('message') . "</h3>
                                  <p>Attachment sent for verification.</p>";

                $mail->send();

                Session::flush(); // clear session

                return "<h2 style='text-align:center;color:#4a90e2;margin-top:50px;'>Email Sent Successfully after OTP verification!</h2>";
            } catch (Exception $e) {
                return "Final Email Error: {$mail->ErrorInfo}";
            }
        } else {
            return "Invalid OTP!";
        }
    }
}
