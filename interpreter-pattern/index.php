<?php

// Operation interface
interface Operation
{
    public function perform(int $left, int $right): int;
}

// Addition operation
class Addition implements Operation
{
    public function perform(int $left, int $right): int
    {
        return $left + $right;
    }
}

// Multiplication operation
class Multiplication implements Operation
{
    public function perform(int $left, int $right): int
    {
        return $left * $right;
    }
}

// Substraction operation
class Substraction implements Operation
{
    public function perform(int $left, int $right): int
    {
        return $left - $right;
    }
}

// Division operation
class Division implements Operation
{
    public function perform(int $left, int $right): int
    {
        return $left / $right;
    }
}

// Calculator class
class Calculator
{
    private $operations = [];

    public function addOperation(string $operator, Operation $operation): void
    {
        $this->operations[$operator] = $operation;
    }

    public function calculate(string $operator, int $left, int $right): int
    {
        if (!isset($this->operations[$operator])) {
            throw new \RuntimeException("Please select operator $operator");
        }

        return $this->operations[$operator]->perform($left, $right);
    }
}

// Example usage:
$calculator = new Calculator();

// Adding supported operations
$calculator->addOperation('+', new Addition());
$calculator->addOperation('*', new Multiplication());
$calculator->addOperation('-', new Substraction());
$calculator->addOperation('/', new Division());

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operator = isset($_POST['operator']) ? $_POST['operator'] : '';
    $leftOperand = isset($_POST['leftOperand']) ? (int)$_POST['leftOperand'] : 0;
    $rightOperand = isset($_POST['rightOperand']) ? (int)$_POST['rightOperand'] : 0;

    try {
        // Calculate the result using the selected operator and operands
        $result = $calculator->calculate($operator, $leftOperand, $rightOperand);
    } catch (\Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Calculator Design Example</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <!-- <h1>Calculator Design Example</h1> -->
    <div class="row offset-md-4 col-md-4 bg-light border-radius mt-5 p-2">
        <h1 class="d-block m-auto text-color"><b>Interpreter Design Pattern</b></h1>
    </div>
    <form method="post" style="background-color: white; color:black;">
        <label>Left Operand:</label>
        <input type="number" name="leftOperand" id="leftOperand" required>
        <br>
        <label>Operator:</label>
        <div class="number-buttons">
            <button type="button" onclick="selectOperator('+')">+</button>
            <button type="button" onclick="selectOperator('*')">*</button>
            <button type="button" onclick="selectOperator('-')">-</button>
            <button type="button" onclick="selectOperator('/')">/</button>
        </div>
        <input type="hidden" name="operator" id="operator" value="" required>
        <br>
        <label>Right Operand:</label>
        <input type="number" name="rightOperand" id="rightOperand" required>
        <br>
        <input type="submit" value="Calculate">
    </form>

    <?php if (isset($result)) : ?>
        <center>
            <div class="response result">Result: <?= $result ?></div>
        </center>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <center>
            <div class="response error">Error: <?= $error ?></div>
        </center>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function selectOperator(operator) {
            document.getElementById('operator').value = operator;
        }

        $(document).on('click', 'button[type="button"]', function() {
            $('.number-buttons').find('.active').removeClass('active');
            $(this).addClass('active');
        });

        $(document).on('focus', 'input[name="leftOperand"], input[name="rightOperand"]', function() {
            $('.response').css('display', 'none');
        });
    </script>
</body>

</html>