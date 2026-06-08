
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * GameMaster::class - Goals
 * # export itself to serve as module
 * # coop with multiplication-table-game.js
 * 
 * Table of Contents
 * # MULTIPLICATION TABLE RULES
 */

//-----------------------------------------------------------------------------

/**
 * note
 *   export GameMaster
 *   always export module files
 */

export class GameMaster
{
  #division;
  #multiplication;

  #questionsCount;

  #x;
  #y;
  #operator; // `m` or `d`
  #answer;
  #no;
  #correct;

  #time;

  #isAnswered;
  #isTimeout;

  #myWorker;

  ///////////////////////////////////////////////////////////////////////////////
  // accessor

  //*****************************************************************************
  getAnswer()
  {
    return this.#answer;
  }

  //*****************************************************************************
  getCorrect()
  {
    return this.#correct;
  }

  //*****************************************************************************
  getIsAnswered()
  {
    return this.#isAnswered;
  }

  //*****************************************************************************
  getIsTimeout()
  {
    return this.#isTimeout;
  }

  //*****************************************************************************
  getNo()
  {
    return this.#no;
  }

  //*****************************************************************************
  getOperator()
  {
    return this.#operator;
  }

  //*****************************************************************************
  getQuestionsCount()
  {
    return this.#questionsCount;
  }

  //*****************************************************************************
  getTime()
  {
    return this.#time;
  }

  //*****************************************************************************
  getTimeString(leadingZero = true)
  {
    var time = this.#time;

    if (leadingZero)
    {
      if (time < 10)
      {
        return `0${time.toString()}`;
      }
    }

    return time.toString();
  }

  //*****************************************************************************
  getX()
  {
    return this.#x;
  }

  //*****************************************************************************
  getY()
  {
    return this.#y;
  }

  //*****************************************************************************
  // setter
  decrementTime()
  {
    this.#time--;
  }

  //*****************************************************************************
  // setter
  incrementCorrect()
  {
    this.#correct++;
  }

  //*****************************************************************************
  // setter
  _setTimeout()
  {
    this.#isTimeout = true;
  }

  ///////////////////////////////////////////////////////////////////////////////
  // member function

  //*****************************************************************************
  constructor(questionsCount = 10)
  {

    this.#division = 'd';
    this.#multiplication = 'm';

    this.#questionsCount = questionsCount;

    this.#x = 0;
    this.#y = 0;
    this.#operator = '';
    this.#answer = 0;
    this.#no = 0;
    this.#correct = 0;

    this.#time = 6 * this.#questionsCount;

    this.#isAnswered = false;
    this.#isTimeout = false;

    this.next();

  }

  //*****************************************************************************
  checkUserAnswer(userAnswer)
  {
    if (userAnswer.toString() == this.#answer.toString())
    {
      this.#correct++;
      return true;

    }

    return false;
  }

  //*****************************************************************************
  countTime()
  {

    this.decrementTime();

    if (this.getTime() <= 0)
    {
      this._setTimeout();
      return;

    }

  }

  //*****************************************************************************
  isFinished()
  {
    if (this.#isAnswered)
    {
      return true;

    }

    if (this.#isTimeout)
    {
      return true;

    }

    return false;

  }

  //*****************************************************************************
  next()
  {
    this.#operator = Math.random();

    if (this.#operator < 0.5)
    {
      this.#operator = this.#division;

      this.#x = GameMaster.getRandom(1, 101); // : 1-100
      this.#y = GameMaster.getRandom(1, 11); // : 1-10

              // MULTIPLICATION TABLE RULES
              // x / y = integer
      while ( ! GameMaster.isDivisor(this.#x, this.#y)
              // x / y > 10
              || this.#x / this.#y > 10)
      {
        //
        this.#x = GameMaster.getRandom(1, 11); // : 1-10
      }

      this.#answer = this.#x / this.#y;

    }
    else
    {
      this.#operator = this.#multiplication;

      this.#x = GameMaster.getRandom(1, 11); // : 1-10
      this.#y = GameMaster.getRandom(1, 11); // : 1-10

              // MULTIPLICATION TABLE RULES
              // x * y > 100
      while ( this.#x * this.#y > 100 )
      {
        this.#y = GameMaster.getRandom(1, 11); // : 1-10
      }

      this.#answer = this.#x * this.#y;

    }

    this.#no++;

    if (this.#no > this.#questionsCount)
    {
      this.#isAnswered = true;

    }

  }

  ///////////////////////////////////////////////////////////////////////////////
  // static

  //*****************************************************************************
  static getRandom(min, end)
  {
    // works
    return Math.floor(Math.random() * (end - min)) + min;

  }

  //*****************************************************************************
  static isDivisor(/* int */ D, /* int */ d)
  {
    // works (for integers)
    return D / d == Math.floor(D / d);

  }

}