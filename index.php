<?php

$a = $_GET['a'] ?? 0;
$b = $_GET['b'] ?? 0;
$c = $_GET['c'] ?? 0;
$answers = [
    "step1" => 0,
    "step2" => 0,
    "step3" => 0,
    "step4" => 0,
    "step5" => 0
];

if ($a !== '' && $b !== '' && $c !== '') {
    $command = escapeshellcmd("python calculate.py $a $b $c");
    $output = shell_exec($command);

    $response = json_decode($output, true);
    if ($response) {
        $answers = $response;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment #2</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        main {
            background: #FDE9D8;
            color: black;
            font-family: monospace;
            padding: 2rem;
            border: 3px solid black;
        }
        h1 {
            color: green;
        }
        p {
            font-size: 1.5rem;
        }
        
        input {
            padding: 0.5rem;
            margin: 0.5rem;
        }
        
        button {
            padding: 0.5rem 1rem;
            background: crimson;
            color: white;
            border: none;
            cursor: pointer;
            margin: 5px;
        }
        #steps {
            background-color: #EAEAEA;
            padding: 2px 10px 20px 20px
        }
        #steps p {
            font-size: 1rem;
        }
        form {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            margin-bottom: 10px;
        }
        #date {
            font-size: 1rem;
        }
        #error {
            color: red;
        }
    </style>
</head>
<body>
    <main>
        <h1>Assignment #2</h1>
        <p>Montes Bedolla </p>
        <form method="get">
            <input type="number" name="a" placeholder="Number A" value="<?= htmlspecialchars($a) ?>">
            <input type="number" name="b" placeholder="Number B" value="<?= htmlspecialchars($b) ?>">
            <input type="number" name="c" placeholder="Number C" value="<?= htmlspecialchars($c) ?>">
            <button type="submit">Get Result</button>
        </form>
        <?php if (!empty($answers["error"])): ?>
            <p id="error">Error: <?= htmlspecialchars($answers["error"]) ?></p>

        <?php elseif (!empty($answers["date"])): ?>
        <div id="steps">
            <p>Step 1: c=<?= htmlspecialchars($c) ?>, c³=<?= htmlspecialchars($answers["step1"]) ?></p>
            <p>Step 2: √(c³) = <?= htmlspecialchars($answers["step2"]) ?></p>
            <p>Step 3: <?= htmlspecialchars($answers["step2"]) ?> / <?= htmlspecialchars($a) ?> = <?= htmlspecialchars($answers["step3"]) ?></p>
            <p>Step 4: <?= htmlspecialchars($answers["step3"]) ?> * 10 = <?= htmlspecialchars($answers["step4"]) ?></p>
            <p>Step 5: <?= htmlspecialchars($answers["step4"]) ?> + <?= htmlspecialchars($b) ?> = <?= htmlspecialchars($answers["step5"]) ?></p>
        </div>
        <p>Final Result: <?= htmlspecialchars($answers["step5"]) ?></p>

        <p id="date">Calculation completed at <?= htmlspecialchars($answers["date"]) ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
