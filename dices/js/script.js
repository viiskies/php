let total_rolls = 4;
let roll = 0;
let allRolls = [];
let totalWinings = 0;
// Get the button, and when the user clicks on it, execute myFunction

$("#winings").text(totalWinings);

document.getElementById("new_game").onclick = function() {startGame()};
document.getElementById("roll_dice").onclick = function() {rolla()};

/* myFunction toggles between adding and removing the show class, which is used to hide and show the dropdown content */
function rollDices() {
	let total_dices = 3;

	let current_roll = [];
	for (var i = total_dices - 1; i >= 0; i--) {
		current_roll.push(Math.ceil(Math.random()*6));
	}
	for (var j = 0; j < current_roll.length-1; j++) {
		for (var k = j+1; k < current_roll.length; k++) {
			if (current_roll[j] == current_roll[k]){
				totalWinings += 0.1 * current_roll[j];
				$("#winings").text(Math.round(totalWinings * 10) / 10);
				break;
			}
		}
	}
	// $("#dicegame ul").html('');
	$('.dice').removeClass();
	for (var i = 1; i <= current_roll.length ; i++) {
		$('#dice'+ i).addClass('dice dice' + current_roll[i-1]);

	}
	return current_roll;
}


function startGame() {
	$("#dicegame ul").html('');
	totalWinings = 0;
	$("#winings").text(Math.round(totalWinings * 10) / 10);
	allRolls = [];
	roll = 0;
	console.log("New game has started");
	console.log(allRolls);
}

function rolla() {
	roll++;
	if (roll <= 4) {
		console.log("Roll number " + roll);
		let newRoll = rollDices();
		allRolls.push(newRoll);
		console.log(allRolls);
	} else {
		// Math.round10(totalWinings, -1*/
		console.log("You've won " + Math.round(totalWinings * 10) / 10);
		console.log("Game is over");
	}

}


$("#ajax_post").click(function(){
	$.post("cars.php",
	{
		wins: totalWinings
	},
	function(data, status) {
		console.log(status);


	});		
});