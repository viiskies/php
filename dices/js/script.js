let total_rolls = 4;
let roll = 0;
let allRolls = [];
let totalWinings = 0;
let total_dices = 3;
let dices = ['dice1', 'dice2', 'dice3', 'dice4', 'dice5', 'dice6'];


// $('.dice').removeClass();
$('#roll_dice').hide();
$('#dice1').addClass('dice1');
$('#dice2').addClass('dice2');
$('#dice3').addClass('dice3');


$("#new_game").click(function() { startGame()});
$("#roll_dice").click(function() { rolla()});


// shows animation, calculates winings, returns lucky combination
function rollOne() {

	// roll three random lucky dices
	let current_roll = [];
	for (let i = total_dices - 1; i >= 0; i--) {
		current_roll.push(Math.ceil(Math.random()*6));
	}

	// rolling animation
	for (let l = 1; l <= current_roll.length ; l++) {

		let timesRun = 0;
		let interval = setInterval(function change() {
			timesRun += 1;

			$('#dice'+ l).removeClass();
			let random = Math.floor(Math.random()*6);
			// show a random dice
			$('#dice'+ l).addClass('dice ' + dices[random]); 

			if(timesRun === 20) {
				clearInterval(interval);
				$('#dice'+ l).removeClass();
				$('#dice'+ l).addClass('dice dice' + current_roll[l-1]);
				showWinings();
				if (roll == 4) {
					let gameresult = "Game is over! <br>You've won " + Math.round(totalWinings * 10) / 10 + " moneys";
					$("#gameresult").html(gameresult);
					$("#gameresult").addClass("p-3 bg-white");
				}
			}
		}, 100); 
	}

	win:
	for (let j = 0; j < current_roll.length-1; j++) {
		for (let k = j+1; k < current_roll.length; k++) {
			if (current_roll[j] == current_roll[k]){
				totalWinings += 0.1 * current_roll[j];
				break win;
			}
		}
	}

	return current_roll;
}

function showWinings() {
	$("#winings").text("€" + Math.round(totalWinings * 10) / 10);
}

function startGame() {
	
	// reset visuals
	$('#dice1').removeClass();
	$('#dice2').removeClass();
	$('#dice3').removeClass();	
	$('#dice1').addClass('dice dice1');
	$('#dice2').addClass('dice dice2');
	$('#dice3').addClass('dice dice3');
	$("#gameresult").text("");

	// show roll button
	$('#roll_dice').show();

	totalWinings = 0;
	$("#winings").text(Math.round(totalWinings * 10) / 10);

	// reset roll history
	allRolls = [];

	// reset roll number 
	roll = 0;

	console.log("New game has started");
	console.log(allRolls);
}

// on a roll button press
function rolla() {
	roll++;
	if (roll < total_rolls) {

		// show a roll number
		$("#rollNumber").text(roll);

		// generate a roll
		let newRoll = rollOne();

		// push a roll into a history of rolls
		allRolls.push(newRoll);

		console.log(allRolls);

// when it's a last roll 
} else if (roll == total_rolls) {

		// show a roll number
		$("#rollNumber").text(roll);

		// generate a roll
		let newRoll = rollOne();

		// push a roll into a history of rolls
		allRolls.push(newRoll);

		// console.log(allRolls);
		// console.log("You've won " + Math.round(totalWinings * 10) / 10);

		totalWinings = Math.round(totalWinings * 10) / 10;

		// post all games to a database
		$.post("game.php",
		{
			roll1: allRolls[0].join(),
			roll2: allRolls[1].join(),
			roll3: allRolls[2].join(),
			roll4: allRolls[3].join(),
			winings: totalWinings
		},
		function(data, status) {
			console.log(status);
		});
		
		// hide a roll button
		$('#roll_dice').hide();

	} else {
		// console.log("Game is really over");
	}
}