// VARIABLES
var output;
var pacman;
var loopTimer;
var timerTimer;
var numLoops = 0;
var timeAlive = 0;
var bestTime = 0;
var walls = new Array();
var ghosts = new Array();
var ghostDirection = new Array(4);
var direction = 'right';
var upArrowDown = false;
var downArrowDown = false;
var leftArrowDown = false;
var rightArrowDown = false;
const GHOST_SPEED = 5;
const PACMAN_SPEED = 10;

// LISTENERS
$(document).keydown(function(e){
    switch(e.which){
        case 37:
            leftArrowDown = true;
            break;
        case 38:
            upArrowDown = true;
            break;
        case 39:
            rightArrowDown = true;
            break;
        case 40:
            downArrowDown = true;
    } 
});

$(document).keyup(function(e){
    switch(e.which){
        case 37:
            leftArrowDown = false;
            break;
        case 38:
            upArrowDown = false;
            break;
        case 39:
            rightArrowDown = false;
            break;
        case 40:
            downArrowDown = false;
    } 
});

$(".strtBtn").click(function(){
    $("#gameWindow").empty();
    resetGame();
});


// FUNCTIONS
function startGame(){
    output = document.getElementById('output');
    pacman = document.createElement('img');
    bestTime = sessionStorage.getItem("bestTimeStore");
    timeAlive = 0;
    $("#alive").html(timeAlive);
    
    $(pacman).css("left", '280px');
    $(pacman).css("top", '200px');
    $(pacman).css("width", '40px');
    $(pacman).css("height", '40px');
    $(pacman).attr('src', 'img/pacman.gif');
    $(pacman).attr('id', 'pacman');
    $("#gameWindow").append(pacman);
    
    createGhost(200, 40, 'red');
    createGhost(240, 40, 'blue');
    createGhost(280, 40, 'green');
    createGhost(320, 40, 'pink');
    createGhost(340, 40,'white');

    loopTimer = setInterval(loop, 50);
    timerTimer = setInterval(timer, 1000);
    
    //create walls
    // inside walls
    createWall(80, 80, 40, 120);
    createWall(160, 80, 280, 40);
    createWall(480, 80, 40, 120);
    createWall(80, 160, 80, 40);
    createWall(440, 160, 80, 40);
    createWall(200, 160, 200, 40);
    createWall(80, 240, 80, 40);
    createWall(80, 240, 40, 80);
    createWall(200, 240, 200, 40);
    createWall(440, 240, 80, 40);
    createWall(480, 240, 40, 80);
    // top walls
    createWall(-20, 0, 140, 40);
    createWall(160, 0, 280, 40)
    createWall(480, 0, 140, 40);
    //left side walls
    createWall(0, 0, 40, 200);
    createWall(0, 240, 40, 160);
    //right side walls
    createWall(560, 0, 40, 200);
    createWall(560, 240, 40, 160);
    // bottom wall
    createWall(-20, 360, 140, 40);
    createWall(160, 320, 280, 80);
    createWall(480, 360, 280, 40);
}

function resetGame(){
    sessionStorage.setItem("bestTimeStore", bestTime);
    clearInterval(loopTimer);
    clearInterval(timerTimer);
    $("#gameWindow").empty();
    $("#dead").hide();
    
    numLoops = 0;
    timeAlive = 0;
    walls = new Array();
    ghosts = new Array();
    ghostDirection = new Array(4);

    direction = 'right';
    upArrowDown = false;
    downArrowDown = false;
    leftArrowDown = false;
    rightArrowDown = false;

    startGame(); 
}

function loop(){
    numLoops++;
    tryToChangeDirection();
    
    var originalLeft = $(pacman).css("left");
    var originalTop = $(pacman).css("top");
    
    if(direction == 'up') moveUpDown(-PACMAN_SPEED);
    if(direction == 'down') moveUpDown(PACMAN_SPEED);
    if(direction == 'left') moveLeftRight(-PACMAN_SPEED);
    if(direction == 'right') moveLeftRight(PACMAN_SPEED);
    
    if(hitWall(pacman)){
        $(pacman).css("left", originalLeft);
        $(pacman).css("top", originalTop);
    }
   
    for(var i = 0; i < ghosts.length; i++){
        moveGhost(ghosts[i]);
        
        if(hittest(pacman, ghosts[i].element)){
            clearInterval(loopTimer);
            clearInterval(timerTimer);
            $("#dead").show();
        }
    }
}

function timer(){
    timeAlive++

    $("#alive").html(timeAlive);
    
    if(timeAlive > bestTime){
        bestTime = timeAlive;
        $("#best").html(bestTime);
    }
}

function moveUpDown(amt){
    var pacmanY = parseInt($(pacman).css("top")) + amt;
    pacmanY = mapWrap('Y', pacmanY);
    $(pacman).css("top", pacmanY + "px");
}

function moveLeftRight(amt){
    var pacmanX = parseInt($(pacman).css("left")) + amt;
    pacmanX = mapWrap('X', pacmanX);
    $(pacman).css("left", pacmanX + "px");
}

function mapWrap(dir, coord){
    if(dir == 'Y'){
        if(coord < -30) coord = 390;
        if(coord > 390) coord = -30;
    }else if (dir == 'X'){
        if(coord < -30) coord = 590;
        if(coord > 590) coord = -30;
    }
    
    return coord;
}

function createWall(left, top, width, height){
    var wall = document.createElement('div');
    wall.className = 'wall';
    $(wall).css("left", left + 'px');
    $(wall).css("top", top + 'px');
    $(wall).css("height", height + 'px');
    $(wall).css("width", width + 'px');
    $("#gameWindow").append(wall);
    
    walls.push(wall);
}

function hitWall(element){
    var hit = false;
    
    for(var i = 0; i < walls.length && !hit; i++){
        if(hittest(walls[i], element)) hit = true;
    }
    
    return hit;
}

function tryToChangeDirection(){
    var originalLeft = $(pacman).css("left");
    var originalTop = $(pacman).css("top");
    
    if(leftArrowDown){ 
        pacman.style.left = parseInt(pacman.style.left) - PACMAN_SPEED + 'px';
        if(!hitWall(pacman)){
            direction = 'left'; 
            pacman.className = "flip-horizontal";
        }
    } 
    
    if(upArrowDown){
        pacman.style.top = parseInt(pacman.style.top) - PACMAN_SPEED + 'px';
        if(!hitWall(pacman)){
            direction = 'up';
            pacman.className = "rotate270";
        }
    }
    
    if(rightArrowDown){ 
        pacman.style.left = parseInt(pacman.style.left) + PACMAN_SPEED + 'px';
        if(!hitWall(pacman)){
            direction = 'right';
            pacman.className = '';
        }
    }
    
    if(downArrowDown){
        pacman.style.top = parseInt(pacman.style.top) + PACMAN_SPEED + 'px';
        if(!hitWall(pacman)){
            direction = 'down';
            pacman.className = "rotate90";
        }
    }
    
    $(pacman).css("left", originalLeft);
    $(pacman).css("top", originalTop);
}

function moveGhost(ghost){
    var X = parseInt($(ghost.element).css("left"));
    var Y = parseInt($(ghost.element).css("top"));
    
    var newDirection;
    var oppositeDirection;
    
    if(ghost.direction == 'left') oppositeDirection = 'right';
    else if(ghost.direction == 'right') oppositeDirection = 'left';
    else if(ghost.direction == 'down') oppositeDirection = 'up';
    else if(ghost.direction == 'up') oppositeDirection = 'down';
    
    do{
        $(ghost.element).css("left", X + 'px');
        $(ghost.element).css("top", Y + 'px');
        
        do{
            var r = Math.floor(Math.random()*4) //0=right, 1=left, 2=down, 3=up
            if(r == 0) newDirection = 'right';
            else if(r == 1) newDirection = 'left';
            else if(r == 2) newDirection = 'down';
            else if(r == 3) newDirection = 'up';
        }while(newDirection == oppositeDirection);
        
        if(newDirection == 'right'){
            if(X > 590) X = -30;
            $(ghost.element).css("left", X + GHOST_SPEED + 'px');
        }else if(newDirection == 'left'){
            if(X < -30) X = 590;
            $(ghost.element).css("left", X - GHOST_SPEED + 'px');
        }else if(newDirection == 'down'){
            if(Y > 390) Y = -30;
            $(ghost.element).css("top", Y + GHOST_SPEED + 'px');
        }else if (newDirection == 'up'){
            if(Y < -30) Y = 390;
            $(ghost.element).css("top",  Y - GHOST_SPEED + 'px');
        }
        
    }while(hitWall(ghost.element));
    
    ghost.direction = newDirection;
}

function createGhost(x, y, color){
    var ghost = {element: document.createElement('IMG'), direction: ''};
    $(ghost.element).css("left", x + 'px');
    $(ghost.element).css("top", y + 'px');
    $(ghost.element).css("width", '40px');
    $(ghost.element).css("height", '40px');
    $(ghost.element).addClass('ghost');
    $(ghost.element).attr('src', 'img/ghost_' + color + '.png');
    $("#gameWindow").append(ghost.element);
    ghosts.push(ghost);
}
