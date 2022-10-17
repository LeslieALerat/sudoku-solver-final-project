// Move to next cell after inputting a number

function toNextCell() {
    var allCells = document.getElementById("sudokuGrid").getElementsByTagName("INPUT");
    //console.log(allCells.length);
    var nextCell;
    var step = 1;
    for (var i=0;i < allCells.length; i++) {
        if (document.getElementById("sudokuGrid").getElementsByTagName("INPUT")[i] === document.activeElement){
            do {
                //console.log(i);
                if (i+step >= 80){
                    step = (-i);
                    //console.log(step);
                    nextCell = document.getElementById("sudokuGrid").getElementsByTagName("INPUT")[i+step];
                    //console.log(nextCell);
                }else {
                    nextCell = document.getElementById("sudokuGrid").getElementsByTagName("INPUT")[i+step];
                    step++;
                }
            } while (nextCell.value > 0);
            
        }
        //if nextCell already has a value, then nextCell++
    }
    //console.log(nextCell);
    nextCell.focus();
}

//function that stops input of repeated numbers in rows, columns and boxes

function noRepeats() {
    //initialize active cell and location
    var activeCell = document.activeElement;
    //get active cells location and store as array. [0] is row, [1] is column, [2] is box
    var acLocation = activeCell.parentElement.getAttribute("class").split(" ");
    
    //look at all cells and assign an array with 3 values to it representing its location. store each array for the entire grid
    var sudokuGrid = Array();
    for (var cell=0;cell<81;cell++){
        sudokuGrid[cell] = document.getElementsByTagName("input")[cell].parentElement.getAttribute("class").split(" ");
        //console.log(sudokuGrid[cell]);
        //test whether the active cell and the currently checked cell have the same row, box, or column
        for (var i = 0; i < 3; i++){
            if (sudokuGrid[cell][i] == acLocation[i]){
                //console.log("Sudoku grid " + cell + ", " + i + ": " + sudokuGrid[cell][i]);
                //console.log("acLocation " + i + ": " + acLocation[i]);
                //console.log("document.getElementsByTagName('input')[cell] = " + document.getElementsByTagName("input")[cell].value);
                //console.log("activeCell.value = " + activeCell.value);
                //Check if same cell
                if (!((acLocation[0] == sudokuGrid[cell][0]) && (acLocation[1] == sudokuGrid[cell][1]) && (acLocation[2] == sudokuGrid[cell][2]))){
                    //check if the values are the same, and if they are the same, remove the value from the active cell
                    if ((document.getElementsByTagName("input")[cell].value == activeCell.value)|| (activeCell.value == 0)){
                        //console.log("They are the same");
                        activeCell.value = "";
                    }else {
                        //console.log("No Match")
                    }
                }
                
                //console.log("-------------------");
            }
        }
        
    }
    //console.log("----------------------------------------");
    //console.log("-----------------------------------END--------------------------------------");
    }
function Cell(rw, cl, val) {
	this.row = rw;
	this.col = cl;
	this.box;
	this.value = val;
	this.candidates = [1,2,3,4,5,6,7,8,9];
	this.getBox = function(num) {
		var boxRow, boxCol, box;
		boxRow = Math.floor(num/27);
		boxCol = Math.floor((num%9)/3);
		box = (boxRow * 3)+boxCol;
		return box;
	}
	//used in getCandidates
	this.hasSight = function(cell) {
		return (cell.row===this.row||cell.col===this.col||cell.box===this.box);
	}
	//used in getCandidates
	this.eliminateCandidates = function(gridCell) {
		//console.log(this.candidates);
		//console.log("eliminate cand was executed");
		if (gridCell.value != ""){
			for (var candidate = 0; candidate < this.candidates.length; candidate++){
				if (this.candidates[candidate] == gridCell.value){
					console.log(this.row + ", " + this.col + " cant be " + gridCell.value);
					this.candidates.splice(candidate, 1);
					console.log(this.candidates);
					//candidate = 0;
				}
			}
		}
	}
	//check all visible cells and set the candidates
	this.getCandidates = function(grid) {
		//filter the grid for all cells in the same box, row or col
		if (this.value == "") {
			var sightGrid = new Array();
			var j = 0;
			for (var i = 0; i < grid.length; i++){
				//console.log("sight grid was called");
				if (this.hasSight(grid[i])){
					sightGrid[j] = grid[i];
					j++;
				}
			}
			console.log(this.row + ", " + this.col + " sight grid:");
			console.log(sightGrid);
			//look at each members value and compare it to each value in this.candidates
			for (var cell = 0; cell < sightGrid.length; cell++){
				//console.log("Looking at sightGrid[" + cell + "]");
				this.eliminateCandidates(sightGrid[cell]);
			}
			//console.log(this.candidates);
		}
	}
	//check if there's one candidate, if so, set the value
	this.checkCandidates = function() {
		if ((this.candidates.length == 1) && (this.value == "")) {
			this.value = this.candidates[0];
			console.log("-----------------ASSIGNMENT---------------------");
			console.log(this.candidates);
			console.log(this.row + ", " + this.col + " value has been assigned to " + this.candidates[0]);
			console.log("--------------------------------------");
			console.log("");
			console.log("");
		}
	}
}
//create a constructor for the sudoku grid
function buildSudokuGrid(listofInputs){
	var sudokuGrid = new Array();
	for (var i = 0; i < listofInputs.length; i++){
		sudokuGrid[i] = new Cell(Math.floor(i/9), i%9, listofInputs[i].value);
		//console.log(Math.floor(i/9) + " " +  i%9 + " " +  listofInputs[i].value)
		sudokuGrid[i].box = sudokuGrid[i].getBox(i);
	}
	return sudokuGrid;
}
//for each member of the sudoku grid, check the candidates
function checkNakedSingles(grid){
	console.log(grid);
		for (var i = 0; i < grid.length; i++){
			if (grid[i].value != ""){
				grid[i].candidates = [];
			}else{
				grid[i].getCandidates(grid);
			}
		}
	return grid;
}
//draw the sudoku grid
function drawGrid(grid){
	document.writeln("<table class='sudokuGrid'>");
	document.writeln("<tr>");
	for (var cell = 0; cell<grid.length; cell++){
		if (cell%9 == 0){
			document.writeln("</tr>");
			document.writeln("<tr>");
		}
		if (grid[cell].value > 0){
			document.writeln("<td>" + grid[cell].value + "</td>");
		} else{
			document.writeln("<td>" + "?" + "</td>");
		}
	}
	document.writeln("</tr>");
}
function hasValue(cell){
	if cell.val != "" return true;
}

function solveGrid(grid) {
	if !grid.every(hasValue) {
		for (var cell of grid){
			if cell.val == "" {
				cell.checkCandidates();
				if (cell.candidates.length == 0){
					return false;
				} else {
					for (var candidate of cell) {
						cell.val = candidate;
						if (solveGrid(grid) == true) {break;}
					}
				}
				return true;
			}
		}
	}
	}
	
}


