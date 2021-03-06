<?php

$CMDfile = $InstLoc.'/Applications/HRAI/CoreCommands/CMDcalculator.php'; 
$inputMATCH = array('calculator', 'the sum of', 'quotient of', 'plus', 'add', 'subtract', 'minus', 'take away', 
  'divided by', 'multiplied by', 'times');
$CMDcounter++;

if (isset($input) && $input !== '') {
  foreach ($inputMATCH as $inputM1) {
    if (preg_match('/'.$inputM1.'/', $input)) {
      $CMDinit[$CMDcounter] = 1;
      $input = preg_replace('/'.$inputM1.'/',' ',$input); } } }

if (!isset($input)) {
  $input = ''; }

$input = str_replace('   ',' ',$input);
$input = str_replace('  ',' ',$input);
$input = rtrim($input);
$input = ltrim($input);
if ($CMDinit[$CMDcounter] == 1) {

// / This CMDcommand was copied from the HRC2 Calculator App on 11/30/2016.

// / HRAI Specific Code.
if ($LOADcalculator == '1') {
  $calculatorInput = $_POST['input']; 
if (isset($calculatorInput) && $calculatorInput == '') {
  echo ('There was no equation to calculate!'); } }

// / Copy/Pasta code from 11/30/2016 HRC2 Calculator App..... Word-for-word.
if (isset($_POST['calculatorInput']) && $_POST['calculatorInput'] !== '') {
  // / The following code defines a function originally written by Justin Cook...
  // / http://www.justin-cook.com/wp/2006/03/31/php-parse-a-string-between-two-strings/
    function get_string_between($string, $start, $end) {
      $string = ' ' . $string;
      $ini = strpos($string, $start);
      if ($ini == 0) return '';
      $ini += strlen($start);
      $len = strpos($string, $end, $ini) - $ini;
      return substr($string, $ini, $len); } 
  // / The following code sets the global variables for the session.
  $numbers = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
  $basicFunctions = str_split('+-xX*/');
  $advancedFunctions = str_split('%');
  $additionFunctions = str_split('+'); 
  $subtractionFunctions = str_split('-');
  $multicationFunctions = str_split('*');
  $divisionFunctions = str_split('/');
  $calculatorInput = str_replace(str_split('[]{};:$!#&@><'), '', $_POST['calculatorInput']);
  $calculatorInput = strtolower($calculatorInput);
  $calculatorInput = str_replace(str_split('xX'), '*', $calculatorInput);
  $calculatorInput = str_replace('multiplied by', '*', $calculatorInput);
  $calculatorInput = str_replace('plus', '+', $calculatorInput);
  $calculatorInput = str_replace('and', '+', $calculatorInput);
  $calculatorInput = str_replace('minus', '-', $calculatorInput);
  $calculatorInput = str_replace('take away', '-', $calculatorInput);
  $calculatorInput = str_replace('times', '*', $calculatorInput);
  $calculatorInput = str_replace('divided by', '/', $calculatorInput);
  $calculatorInput = str_replace(str_split('abcdefghijklmnopqrstuvwyz'), '', $calculatorInput);
  $calculatorInput = str_replace(' ', '', $calculatorInput);
  $calculatorArguments = str_replace(str_split('[]{};:$!#&@><'), '', $calculatorInput);
  // / The following code cleans the user input for the math interpreter.
  $counter = 0; 
  foreach ($numbers as $number) {
    $calculatorInput = str_replace($number.'(', $number.'*(', $calculatorInput);
    $calculatorInput = str_replace(')'.$number, ')*'.$number, $calculatorInput); }
  if ($calculatorInput == '') {
    echo ('There was no equation to calculate!'); }

  $priorityFunctions = get_string_between($calculatorInput, '(', ')');
  $priorityFunctions = str_replace(str_split('()'), '', $priorityFunctions);
  if ($priorityFunctions !== '') {
    $counter++;
    echo ('<i>'.$calculatorInput.'</i>');
    eval('$priorityTotal = ('.$priorityFunctions.');');
    echo ('<p><strong>'.$counter.'.</strong> <i>('.$priorityFunctions.')</i> = <strong>'.$priorityTotal.'</strong></p>');
    $calculatorInput = str_replace($priorityFunctions, $priorityTotal, $calculatorInput); }

if ($calculatorInput !== '') {
  $counter++;
  eval('$total = ('.$calculatorInput.');');
  echo ('<p><strong>'.$counter.'.</strong> <i>'.$calculatorInput.'</i> = <u><strong>'.$total.'</strong></u></p>'); } } }
?>
