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
// $("#winings").text(totalWinings);

document.getElementById("new_game").onclick = function() { startGame()};
$("#roll_dice").click(function() { rolla(showWinings)});

function rollOne() {
	let current_roll = [];
	for (let i = total_dices - 1; i >= 0; i--) {
		current_roll.push(Math.ceil(Math.random()*6));
	}

	// $('.dice').removeClass();
	for (let l = 1; l <= current_roll.length ; l++) {
		// $('#dice'+ i).addClass('dice dice' + current_roll[i-1] + " animated rotateIn");

		let timesRun = 0;
		let interval = setInterval(function change() {
			timesRun += 1;
			$('#dice'+ l).removeClass();
			let random = Math.floor(Math.random()*6);
			$('#dice'+ l).addClass('dice ' + dices[random]); 

			if(timesRun === 8){
				clearInterval(interval);
				$('#dice'+ l).removeClass();
				$('#dice'+ l).addClass('dice dice' + current_roll[l-1]);
			}
		}, 500); 
	}

	win:
	for (let j = 0; j < current_roll.length-1; j++) {
		for (let k = j+1; k < current_roll.length; k++) {
			if (current_roll[j] == current_roll[k]){
				totalWinings += 0.1 * current_roll[j];
				// $("#winings").text(Math.round(totalWinings * 10) / 10);
				break win;
			}
		}
	}
	return current_roll;
}

function showWinings() {
	$("#winings").text(Math.round(totalWinings * 10) / 10);
}

function startGame() {
	// $('.dice').removeClass();
	$('#roll_dice').show();
	totalWinings = 0;
	$("#winings").text(Math.round(totalWinings * 10) / 10);
	allRolls = [];
	roll = 0;
	console.log("New game has started");
	console.log(allRolls);
}

function rolla(callback) {
	roll++;
	if (roll < total_rolls) {

		console.log("Roll number " + roll);
		let newRoll = rollOne();
		allRolls.push(newRoll);
		console.log(allRolls);

	} else if (roll == total_rolls) {

		console.log("Roll number " + roll);
		let newRoll = rollOne();
		allRolls.push(newRoll);
		console.log(allRolls);
		console.log("You've won " + Math.round(totalWinings * 10) / 10);
		totalWinings = Math.round(totalWinings * 10) / 10;
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
		console.log("Game is over");
		$('#roll_dice').hide();

	} else {
		console.log("Game is really over");
	}
	callback();
}



