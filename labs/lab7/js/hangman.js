// VARIABLES
var selectedWord = "";
var selectedHint = "";
var guessedWords= "";
var board = [];
var remainingGuesses = 6;
var words = [{word: "snake", hint: "It's a reptile"}, 
             {word: "monkey", hint: "It's a mammal"},
             {word: "beetle", hint: "It's an insect"}];
             
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
// LISTENERS
window.onload = startGame();

$(".letter").click(function(){
    checkLetter($(this).attr("id"));
    disableButton($(this));
});

$(".replayBtn").click(function(){
   location.reload(); 
});

$("#hintBtn").click(function(){
    $("#hint").append("<br/>" + selectedHint);
    disableButton($(this));
    remainingGuesses--;
    updateMan();
    
    if(remainingGuesses <= 0){
        endGame(false);
    }
});

// FUNCTIONS
function startGame(){
    pickWord();
    initBoard();
    updateBoard();
    createLetters();
    displayPrevGuessedWords();
}

function initBoard(){
    for (var letter in selectedWord){
        board.push( "_" );
    }
}

function pickWord(){
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}

function updateBoard(){
    $("#word").empty();
    
    for (var letter of board) {
        document.getElementById("word").innerHTML += letter + " ";
    }
    
    $("#word").append("<br />");
}
       
function createLetters(){
    $("#hint").append("<button class='btn btn-info' id='hintBtn'> Hint </button>");
    for(var letter of alphabet){
        $("#letters").append("<button class='letter btn btn-success' id='" + letter + "'>" + letter + "</button>");
    }
}        

function checkLetter(letter){
    var positions = new Array();
    
    for(var i = 0; i < selectedWord.length; i++) {
        console.log(selectedWord);
        if(letter == selectedWord[i]) {
            positions.push(i);
        }
    }
    
    if(positions.length > 0){
        updateWord(positions, letter);
        
        if(!board.includes("_")){
            endGame(true);
        }
            
    }else{
        remainingGuesses -= 1; 
        updateMan();
    }
        
    if(remainingGuesses <= 0){
        endGame(false);
    }
}

function updateWord(positions, letter){
    for(var pos of positions){
        board[pos] = letter;
    }
    
    updateBoard();
}

function updateMan(){
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}

function endGame(win){
    $("#letters").hide();
    
    if(win){
        $("#won").show();
        
        if(sessionStorage.getItem("prevGuessed") != null){
           guessedWords = sessionStorage.getItem("prevGuessed") + ", "; 
        }
        
        guessedWords += selectedWord;
        sessionStorage.setItem("prevGuessed", guessedWords);
    }else{
        $("#lost").show();
    }
}

function disableButton(btn){
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger");
}

function displayPrevGuessedWords(){
    if(sessionStorage.getItem("prevGuessed") != null){
        $("#prevGuessed").append("Previously Guessed Words: " + sessionStorage.getItem("prevGuessed"));
    }
}