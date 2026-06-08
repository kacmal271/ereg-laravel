//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This File - Goals
 * # implement multiplication table game logic
 * # implement game DOM operations
 * 
 * Table of Contents
 * # CACHE BUSTING
 */

import * as GM from './GameMaster.js';

//
// vvv logic vvv
//

var gm = null;

// run at 60 Hz
var framerate = 60;

var flashTimeout = 1;

//
// ^^^ logic ^^^
//

//
// vvv markup vvv
//

var divStart;
var divStartButton;

var divPlaceholder;

var divGameplay;
var divGameplayX;
var divGameplayOperator;
var divGameplayOperatorDivision = '÷';
var divGameplayOperatorMultiplication =  '×';
var divGameplayY;
var divGameplayButton;
var divGameplayUserAnswer;
var divGameplayProgressCount;
var divGameplayProgressMax;
var divGameplayTimer;

var divResult;
var divResultScoreUser;
var divResultScoreMax;

//
// ^^^ markup ^^^
//

//*****************************************************************************
function main()
{
  initialize();
}

//*****************************************************************************
document.addEventListener('DOMContentLoaded', function()
{
  main();
});

//*****************************************************************************
function confirmAnswer()
{
  var userAnswer = divGameplayUserAnswer.value;

  var oldColorClass;
  var newColorClass;

  if (gm.checkUserAnswer(userAnswer))
  {
    // good

    oldColorClass = 'border-error';
    newColorClass = 'border-green';

  }
  else
  {
    // bad

    oldColorClass = 'border-green';
    newColorClass = 'border-error';

  }

  // remove old border color
  divGameplayUserAnswer.classList.remove(oldColorClass);

  divGameplayUserAnswer.classList.remove('border-white');
  divGameplayUserAnswer.classList.add(newColorClass);

  var flashTimeoutId = window.setTimeout(function()
  {
    divGameplayUserAnswer.classList.remove(newColorClass);
    divGameplayUserAnswer.classList.add('border-white');

    window.clearTimeout(flashTimeoutId);

  }, flashTimeout * 1000);

  // empty user value
  divGameplayUserAnswer.value = "";

  // repare next question
  gm.next();

}

//*****************************************************************************
function displayGameplay()
{
  divStart.classList.add("hidden");

  divPlaceholder.classList.add("hidden");

  divGameplay.classList.remove("hidden");

  divResult.classList.add("hidden");

}

//*****************************************************************************
function displayPlaceholder()
{
  divStart.classList.remove("hidden");

  divPlaceholder.classList.remove("hidden");

  divGameplay.classList.add("hidden");

  divResult.classList.add("hidden");

}

//*****************************************************************************
function displayResult()
{
  divStart.classList.remove("hidden");

  divPlaceholder.classList.add("hidden");

  divGameplay.classList.add("hidden");

  divResult.classList.remove("hidden");

}

//*****************************************************************************
function initialize()
{

  // start-button
  divStart = document.getElementById('div-start');
  divStartButton = document.getElementById('div-start-button');
  
  // pre-game-placeholder
  divPlaceholder = document.getElementById('div-placeholder');
  
  // inputs
  divGameplay = document.getElementById('div-gameplay');
  divGameplayX = document.getElementById('div-gameplay-x');
  divGameplayOperator = document.getElementById('div-gameplay-operator');
  divGameplayY = document.getElementById('div-gameplay-y');
  divGameplayButton = document.getElementById('div-gameplay-button');
  divGameplayUserAnswer = document.getElementById('div-gameplay-user-answer');
  divGameplayProgressCount = document.getElementById('div-gameplay-progress-count');
  divGameplayProgressMax = document.getElementById('div-gameplay-progress-max');
  divGameplayTimer = document.getElementById('div-gameplay-timer');
  
  // result
  divResult = document.getElementById('div-result');
  divResultScoreUser = document.getElementById('div-result-score-user');
  divResultScoreMax = document.getElementById('div-result-score-max');

  // event listeners
  divStartButton.addEventListener('click', startGame);
  divGameplayButton.addEventListener('click', confirmAnswer);

  displayPlaceholder();
}

//*****************************************************************************
function startGame()
{
  displayGameplay();

  gm = new GM.GameMaster();

  updateGameplay();

  // display total count of questions
  divGameplayProgressMax.innerHTML = gm.getQuestionsCount().toString();

  // display starting time
  divGameplayTimer.innerHTML = gm.getTimeString();

  // frames loop
  var frameInterval = window.setInterval(function()
  {
    if ( ! gm.isFinished())
    {
      divGameplayX.innerHTML = gm.getX().toString();
      divGameplayY.innerHTML = gm.getY().toString();

      divGameplayOperator.innerHTML = gm.getOperator().toString() == 'd'
        ? divGameplayOperatorDivision
        : divGameplayOperatorMultiplication;

      divGameplayProgressCount.innerHTML = gm.getNo().toString();

    }
    else
    {
      divResultScoreUser.innerHTML = gm.getCorrect().toString();

      divResultScoreMax.innerHTML = gm.getQuestionsCount().toString();

      window.clearInterval(frameInterval);

      gm = null;

      displayResult();

    }
    
     // every frame
  }, 1000 / framerate);

  // seconds loop
  var secondInterval = window.setInterval(function()
  {
    if (gm == null)
    {
      window.clearInterval(secondInterval);
      return;
    }

    // count down
    gm.countTime();

    // update timer
    divGameplayTimer.innerHTML = gm.getTimeString();
    
     // "by the second"
  }, 1000);
}

//*****************************************************************************
function updateGameplay()
{
  divGameplayX.innerHTML = gm.getX().toString();
  divGameplayY.innerHTML = gm.getY().toString();

  divGameplayOperator.innerHTML = gm.getOperator().toString() == 'd'
    ? divGameplayOperatorDivision
    : divGameplayOperatorMultiplication;

  divGameplayProgressCount.innerHTML = gm.getNo().toString();

}