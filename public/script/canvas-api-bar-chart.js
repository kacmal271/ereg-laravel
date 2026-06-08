//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This Program - Goals
 * # visualizes data -> displays Bar Chart
 * # data DB-queried or Hard-Coded
 *
 * Table of Contents
 * # PAGE LOADING
 * # START PROGRAM
 * # ENTRY POINT
 * # DATA VISUALIZATION - EXTENDED METHOD
 * # ADD GRID
 */

const EXCEPTION_MSG_BAD_DATA = "Invalid chart Data";
const EXCEPTION_MSG_NO_DATA = "Required: chart Data";

//*****************************************************************************
// PAGE LOADING
document.addEventListener('DOMContentLoaded', function() {

	// START PROGRAM
	main();
	
});
	
//*****************************************************************************
// ENTRY POINT
function main()
{
	// Access CanvasAPI
	var myCanvas = document.getElementsByClassName('canvasBarChart');
	
	// Verify
	verifyHTMLIntegrity(myCanvas);
	
	// Work on Canvas Object
	var myContext = myCanvas[0].getContext('2d');
	
	// debug only - comment other extended methods
	// myContext.addGrid();
	
	// get data
	var jsonString = document.getElementById('jsonString');
	
	// parse json
	var jsonObject = JSON.parse(jsonString.value);
	
	// Check: parsed json object
	// console.log(jsonObject);
	
	// graph grades subjects	
	myContext.drawBarChart(
		jsonObject.x,
		jsonObject.xLabel,
		jsonObject.y,
		jsonObject.yLabel,
		jsonObject.data,
		jsonObject.title
	);
	
}

//*****************************************************************************
function verifyHTMLIntegrity(elems)
{
	for (var i = 0; i < elems.length; i++)
	{
		if (typeof elems.item(i) == `undefined`)
			// Interrupt JS execution
			throw new Error(`Missing HTML element`);
		
	}
	
}

//*****************************************************************************
// DATA VISUALIZATION - EXTENDED METHOD
CanvasRenderingContext2D.prototype.drawBarChart = function (
	xaxis,
	xaxislabel,
	yaxis,
	yaxislabel,
	data,
	title = "Bar Chart"
)
{
	// y-axis must be numbers
	if (isNaN(yaxis[0]))
		return EXCEPTION_MSG_BAD_DATA;
	
	// upscale canvas resolution - get good font resolution - reduce pixelization
	scalar = 100; 															// UP THIS to 400 is bar chart blurry
	this.canvas.width = scalar * xaxis.length; 	// MANDATORY width
	this.canvas.height = scalar * yaxis.length; // MANDATORY height
	
	// define local config
	var fontSuffix = `px Arial`;
  var oldWidth = this.canvas.width;
  var oldHeight = this.canvas.height;     
	var unit = (oldWidth < oldHeight ? oldWidth : oldHeight) * 0.250; 
	var padding = unit * 4; // quarter^
	var xstep = oldWidth / xaxis.length;			      // x tick step wide
	var ystep = oldHeight / yaxis.length;								// y tick step short
	
	// padding: canvas padding
  this.canvas.width = oldWidth + padding * 2;			// padding on both sides
  this.canvas.height = oldHeight + padding * 2; 	// padding on both sides
	
	// verify if can draw
	this.strokeStyle = `rgba(0, 0, 0, 1)`;
	this.font = unit.toString() + fontSuffix; // modify text
	if (xaxis.length != data.length)
	{
		console.log(`error: CanvasRenderingContext2D.drawBarChart()`);
		console.log(`error: cannot drawBarChart`);
		console.log(`error: array lengths dont match`);
		this.textAlign = `left`;
		this.fillText(EXCEPTION_MSG_NO_DATA, padding, padding);
		// early return
		return;
		
	}
	
	//
	// XY axes
	//
	
	// modify lines
	this.lineCap = `round`;
	// X axis
	this.moveTo(padding, padding + oldHeight);
	this.lineTo(padding + oldWidth + xstep / 2.0,
							padding + oldHeight); // X arrow NOT extended - ok
	this.lineWidth = unit * 0.0625;
	this.stroke();										// draw
	// Y axis
	this.moveTo(padding, padding + oldHeight);
	this.lineTo(padding, padding - ystep / 2.0); 		// Y arrow NOT extended - ok
	this.lineWidth = unit * 0.0625;
	this.stroke();										// draw
	
	//
	// ticks
	//
	
	// xticks
	for (var i = 0; i < xaxis.length; i++)
	{
		var tickWidth = unit / 2.0;
		var yoffset = tickWidth / 2.0; // how far it extends along X axis
		var x = padding + oldWidth * i/xaxis.length + xstep;
		var y = padding + oldHeight + yoffset;
		this.moveTo(x, y);
		this.lineTo(x, y - tickWidth);
		this.stroke();
		
	}
	// yticks
	for (var i = 0; i < yaxis.length; i++)
	{
		var tickWidth = unit / 2.0;
		var xoffset = tickWidth / 2.0; // how far it extends along X axis
		var x = padding - xoffset;
		var y = padding + oldHeight * (1 - i/yaxis.length) - xstep;
		this.moveTo(x, y);
		this.lineTo(x + tickWidth, y);
		this.stroke();
		
	}
	
	//
	// text
	//
	
	// x-axis text
	this.textBaseline = `middle`;
	this.lineWidth = unit * 0.05;
	this.textAlign = `left`;
	this.rotate (90 * Math.PI / 180.0);  		// (A) rotate Starting Point by 90 deg
	this.font = (unit / 2.0).toString() + fontSuffix; // modify text
	for (var i = 0; i < xaxis.length; i++)
	{
		var xlabel = (xaxis[i]).toString();
		var yoffset = unit; // y offset from x-axis
		var x = padding + oldWidth * i/xaxis.length + xstep;
		var y = padding + oldHeight + yoffset;
		// this.fillText(xlabel, x, y);
		this.fillText(xlabel, y, -x);  				// (A) rotate Starting Point by 90 deg
		
	}
	// y-axis text
	this.textAlign = `right`;
	this.rotate (-90 * Math.PI / 180.0);    // (A) inverse rotation
	this.font = (unit / 2.0).toString() + fontSuffix; // modify text
	for (var i = 0; i < yaxis.length; i++)
	{
		var ylabel = (yaxis[i]).toString();
		var xoffset = unit; // x offset from y-axis
		var x = padding - xoffset;
		var y = padding + oldHeight * (1 - i/yaxis.length) - xstep;
		this.fillText(ylabel, x, y);
		
	}
	
	//
	// axes labels
	//
	
	// x-axis label
	this.textAlign = `left`; // x-position modifier
	this.textBaseline = `middle`; // y-position modifier
	this.font = (unit / 2.0).toString() + fontSuffix; // modify text
	this.fillText(xaxislabel,
								padding + oldWidth + xstep, // x-axis label x-position
								padding + oldHeight)				// y-axis label y-position
	// y-axis text
	this.textAlign = `right`;
	this.fillText(yaxislabel,
								padding, 								// x-axis label x-position
								padding - ystep)				// y-axis label y-position
	
	//
	// title
	//
	
	this.textAlign = `center`;
	this.textBaseline = `middle`;
	this.font = (unit / 1.75).toString() + fontSuffix; // modify text
	this.textBaseline = `top`; // y-position modifier
	this.fillText(title,
								padding + oldWidth / 2.0,  	// x-axis label x-position
								padding / 2.0 / 2.0) 				// y-axis label y-position // half of top padding
	
	//
	// bars
	//
	
	// bar lines
	var lineHead;
	var lineTail;
	for (var i = 0; i < data.length; i++)
	{
		// #1 line
		lineHead = {
			x: padding + xstep*(i+1) - xstep*0.22,
			y: padding + oldHeight
		};
		
		lineTail = {
			x: lineHead.x,
			y: lineHead.y - ystep * data[i]
		};
		
		this.moveTo(lineHead.x, lineHead.y);
		this.lineTo(lineTail.x, lineTail.y);
		
		// #2 line
		lineHead = lineTail;
		lineTail.x = lineTail.x + xstep * 0.5;
		this.lineTo(lineTail.x, lineTail.y);
		
		// #3 line
		lineHead = lineTail;
		lineTail.y = padding + oldHeight;
		this.lineTo(lineTail.x, lineTail.y);
		
		// confirm lines
		this.stroke();
		
	}
	// bar labels
	this.font = (unit * 0.5).toString() + fontSuffix; // modify text
	this.textBaseline = `middle`;
	this.textAlign = `left`;
	this.rotate (-90 * Math.PI / 180.0);              // (B) rotate all subsequent elements
	for (var i = 0; i < data.length; i++)
  {
    let x = padding + xstep*(i+1);
    let y = padding + oldHeight - ystep * data[i] - unit;
		this.fillText(data[i], -y, x);                  // (B) rotated axes

  }
  this.rotate (90 * Math.PI / 180.0);               // (B) inverse rotation
	
};

//*****************************************************************************
// ADD GRID
// Goal: development only
// Goal: display width height as XY axes
// Goal: measuring distances

// Declaration
// CanvasRenderingContext2D.addGrid(delta, color, font)

// Formal Parameters
// delta = distance of grid lines
// color = CSS color
// font	= CSS font

// === global-extended-methods.js ===

// !!! DEFINE IN GLOBAL SCOPE !!!

CanvasRenderingContext2D.prototype.addGrid = function (delta, color, fontParams) {
  // define the default values for the optional arguments
  if (! arguments[0]) { delta = 25; }
  if (! arguments[1]) { color = 'blue'; }
  if (! arguments[2]) { fontParams = '8px sans-serif'; }
  // extend the canvas width and height by delta
  var oldWidth = this.canvas.width;
  var oldHeight = this.canvas.height;      
  this.canvas.width = oldWidth + delta;
  this.canvas.height = oldHeight + delta;        
  // draw the vertical and horizontal lines
  this.lineWidth = 0.1;
  this.strokeStyle = color;
  this.beginPath();
  for (var i = 0; i * delta < oldWidth; i ++) {
    this.moveTo (i * delta, 0);
    this.lineTo (i * delta, oldHeight);
  }
  for (var j = 0; j * delta < oldHeight; j ++) {
    this.moveTo (0, j * delta);
    this.lineTo (oldWidth, j * delta);
  }      
  this.closePath();
  this.stroke();
  // draw a thicker line, which is the border of the original canvas
  this.lineWidth = 0.5;
  this.beginPath();
  this.moveTo(0,0);
  this.lineTo(oldWidth,0);
  this.lineTo(oldWidth,oldHeight);
  this.lineTo(0,oldHeight);
  this.lineTo(0,0);
  this.closePath();
  this.stroke();
  // set the text parameters and write the number values to the vertical and horizontal lines
  this.font = fontParams
  this.lineWidth = 0.3;
  // 1. writing the numbers to the x axis
  var textY = oldHeight + Math.floor(delta/2); // y-coordinate for the number strings
  for (var i = 0; i * delta <= oldWidth; i ++) {
    this.strokeText (i * delta, i * delta, textY);        
  }
  // 2. writing the numbers to the y axis
  var textX = oldWidth + 5; // x-coordinate for the number strings
  for (var j = 0; j * delta <= oldHeight; j ++) {
    this.strokeText (j * delta, textX, j * delta);
  }
};