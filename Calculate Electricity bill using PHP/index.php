<!DOCTYPE html>
<html>
<head>
<title>ELECTRICITY BILL CALCULATOR</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}
#page-wrap {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h1 {
    color: #0C2D57;
    text-align: center;
    margin-bottom: 30px;
}
form {
    text-align: center;
}
input[type="number"] {
    padding: 10px;
    width: 80%;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
input[type="submit"] {
    padding: 10px 20px;
    background-color: #0C2D57;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #0C2D57;
}
#result {
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
}
/* Popup styles */
#calculation-popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    z-index: 999;
}
.popup-content {
    background-color: #fff;
    max-width: 400px;
    margin: 100px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}
.popup-content h2 {
    text-align: center;
    margin-bottom: 20px;
}
.popup-content p {
    margin-bottom: 10px;
}
.popup-content button {
    display: block;
    margin: 0 auto;
    padding: 10px 20px;
    background-color: #0C2D57;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.popup-content button:hover {
    background-color: #0C2D57;
}
</style>
<script>
function showCalculation() {
    var popup = document.getElementById("calculation-popup");
    popup.style.display = "block";
}
function closePopup() {
    var popup = document.getElementById("calculation-popup");
    popup.style.display = "none";
}
</script>
</head>
<body>
<div id="page-wrap">
    <h1>ELECTRICITY BILL CALCULATOR</h1>
    <form action="" method="post" id="quiz-form">
        <input type="number" name="units" id="units" placeholder="Please enter no. of Units" required />
        <br>
        <input type="submit" name="unit-submit" id="unit-submit" value="Submit" />
    </form>
    <div id="result">
        <?php
        $result_str = $result = '';
        if (isset($_POST['unit-submit'])) {
            $units = $_POST['units'];
            if (!empty($units)) {
                $result = calculate_bill($units);
                $result_str = 'Total amount of ' . $units . '-units is Rs.' . $result;
            }
        }

        function calculate_bill($units) {
            $unit_cost_first = 3.50;
            $unit_cost_second = 4.00;
            $unit_cost_third = 5.20;
            $unit_cost_fourth = 6.50;

            if ($units <= 50) {
                $bill = $units * $unit_cost_first;
            } elseif ($units > 50 && $units <= 150) {
                $temp = 50 * $unit_cost_first;
                $remaining_units = $units - 50;
                $bill = $temp + ($remaining_units * $unit_cost_second);
            } elseif ($units > 150 && $units <= 250) {
                $temp = (50 * 3.5) + (100 * $unit_cost_second);
                $remaining_units = $units - 150;
                $bill = $temp + ($remaining_units * $unit_cost_third);
            } else {
                $temp = (50 * 3.5) + (100 * $unit_cost_second) + (100 * $unit_cost_third);
                $remaining_units = $units - 250;
                $bill = $temp + ($remaining_units * $unit_cost_fourth);
            }
            return number_format((float)$bill, 2, '.', '');
        }

        echo $result_str;
        ?>
    </div>
    <p style="text-align:center;">Click <a href="#" onclick="showCalculation()">here</a> to see how the bill is calculated.</p>
</div>
<!-- Calculation Popup -->
<div id="calculation-popup">
    <div class="popup-content">
        <h3>Calculation Method</h3>
        <p>For the first 50 units, the cost is Rs. 3.50 per unit.</p>
        <p>For the next 100 units, the cost is Rs. 4.00 per unit.</p>
        <p>For the next 100 units, the cost is Rs. 5.20 per unit.</p>
        <p>For units above 250, the cost is Rs. 6.50 per unit.</p>
        <button onclick="closePopup()">Close</button>
    </div>
</div>
</body>
</html>
