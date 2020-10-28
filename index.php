<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Better Than Peepop's</title>
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="calculator.js"></script>
</head>
<body>

    <h1 class="header">Kaafy's Way Better Calculator</h1>

    <div class="calculator">

        <div class="calculator calculator__container">

            <div class="calculator calculator__display" id="display"></div>

            <div class="buttons">

                <button class="buttons buttons__numeric" id="zero">0</button>
                <button class="buttons buttons__numeric" id="one">1</button>
                <button class="buttons buttons__numeric" id="two">2</button>
                <button class="buttons buttons__numeric" id="three">3</button>
                <button class="buttons buttons__numeric" id="four">4</button>
                <button class="buttons buttons__numeric" id="five">5</button>
                <button class="buttons buttons__numeric" id="six">6</button>
                <button class="buttons buttons__numeric" id="seven">7</button>
                <button class="buttons buttons__numeric" id="eight">8</button>
                <button class="buttons buttons__numeric" id="nine">9</button>

                <button class="buttons buttons__numeric buttons__numeric__operator" id="addition">+</button>
                <button class="buttons buttons__numeric buttons__numeric__operator" id="subtract">-</button>
                <button class="buttons buttons__numeric buttons__numeric__operator" id="multiply">*</button>
                <button class="buttons buttons__numeric buttons__numeric__operator" id="divide">/</button>

                <button class="buttons buttons__calculate" id="calculate">Calculate</button>
                <button class="buttons buttons__calculate buttons__calculate__clear" id="clear">Clear</button>

            </div>

        </div>

    </div>

</body>
</html>
