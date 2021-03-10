function Calculator() {
    this.currentInput = [];
    this.currentOperand;

    this.init = function () {
        $('#zero').on('click', this.zeroHandler.bind(this));
        $('#one').on('click', this.oneHandler.bind(this));
        $('#two').on('click', this.twoHandler.bind(this));
        $('#three').on('click', this.threeHandler.bind(this));
        $('#four').on('click', this.fourHandler.bind(this));
        $('#five').on('click', this.fiveHandler.bind(this));
        $('#six').on('click', this.sixHandler.bind(this));
        $('#seven').on('click', this.sevenHandler.bind(this));
        $('#eight').on('click', this.eightHandler.bind(this));
        $('#nine').on('click', this.nineHandler.bind(this));

        $('#addition').on('click', this.addHandler.bind(this));
        $('#subtract').on('click', this.subtractHandler.bind(this));
        $('#multiply').on('click', this.multiplyHandler.bind(this));
        $('#divide').on('click', this.divideHandler.bind(this));

        $('#calculate').on('click', this.calculate.bind(this));
        $('#clear').on('click', this.clearHandler.bind(this));
    };

    this.zeroHandler = function () {
        this.addInput(0)
    }
    this.oneHandler = function () {
        this.addInput(1)
    }
    this.twoHandler = function () {
        this.addInput(2)
    }
    this.threeHandler = function () {
        this.addInput(3)
    }
    this.fourHandler = function () {
        this.addInput(4)
    }
    this.fiveHandler = function () {
        this.addInput(5);
    };
    this.sixHandler = function () {
        this.addInput(6);
    };
    this.sevenHandler = function () {
        this.addInput(7);
    };
    this.eightHandler = function () {
        this.addInput(8);
    };
    this.nineHandler = function () {
        this.addInput(9);
    };

    this.addHandler = function () {
        this.addOperand('+');
    };
    this.subtractHandler = function () {
        this.addOperand('-');
    };
    this.multiplyHandler = function () {
        this.addOperand('*');
    };
    this.divideHandler = function () {
        this.addOperand('/');
    };

    /*
    Pushes the value entered by user (button clicked) into the currentInput array

    ToDo: Add error handling for non-numeric input/operand keys
    but smart to add error handling anyway)
    */
    this.addInput = function (value) {
        this.currentInput.push(value)
        $('#display').text(this.getCurrentValue());
    };

    /*
    Returns the contents of the currentValue array as a string
    */
    this.getCurrentValue = function () {
        let stringValue = '';
        this.currentInput.forEach(function (val) {
            stringValue = stringValue + val;
        });
        return parseInt(stringValue);
    };

    /*
    Returns the contents of a stored value array as a string - not currently in use
     */
    this.getStoredValue = function (valueList) {
        let stringValue = '';
        valueList.forEach(function (val) {
            stringValue = stringValue + val;
        });
        return parseInt(stringValue);
    };

    /*
    Adds the operand based on input from user and stores the currentInput value in the lastValue
    variable. Then clears currentInput so that is is empty to receive the next value to be computed.
     */
    this.addOperand = function (operand) {
        this.currentOperand = operand;
        $('#display').text(this.currentOperand);
        this.lastValue = this.getCurrentValue();
        this.currentInput = [];
    };

    /*
    Calculates the final value using storedValue, the selected operand, and the currentValue

    ToDo: Add ability to calculate more than 2 values at a time
     */
    this.calculate = function () {
        let val1 = this.lastValue;
        let val2 = this.getCurrentValue(this.currentInput);
        let calcResult;

        if (this.currentOperand === '+') {
            calcResult = val1 + val2;
        }

        if (this.currentOperand === '-') {
            calcResult = val1 - val2;
        }

        if (this.currentOperand === '*') {
            calcResult = val1 * val2;
        }

        if (this.currentOperand === '/') {
            calcResult = val1 / val2;
        }

        this.currentInput = [calcResult];
        if (calcResult % 1 !== 0) {
            calcResult = calcResult.toFixed(3);
        }
        $('#display').text(calcResult);
        $.ajax({
            type: 'POST',
            url: '/Calculations/Ajax/add',
            data: {
                'inputValue': calcResult
            }
        }).done(function (data, test) {
            console.log('we are done');
        });

        return calcResult;
    }

    /*
    Clears the display and the current/stored values
    */
    this.clearHandler = function () {
        this.currentInput = [];
        this.lastValue = [];
        $('#display').text('');
    }
}

jQuery(document).ready(function () {
    let calculator = new Calculator();
    calculator.init();
});
