// Canvas and context
const canvas = document.querySelector('canvas');
const context = canvas.getContext('2d');
canvas.width = 944;
canvas.height = 944;

// Grid dimensions
const gridSize = 16;
const cellSize = canvas.width / gridSize;

// Grid centers
const gridCenters = Array.from({ length: gridSize }, (_, i) =>
  Array.from({ length: gridSize }, (_, j) => [
    (i + 1) * cellSize - cellSize /2,
    (j + 1) * cellSize - cellSize /2 ,
  ])
);

// Apple
const appleRadius = 16;
let applePos = applePosition();

// Snake
let snake = [
  {
    x: gridCenters[1][0][0],
    y: gridCenters[1][0][1],
    dir: 'R',
  },
];
let score = 0;
let dx = 1;
let dy = 0;

// Keyboard input
let Up = false;
let Down = false;
let Left = false;
let Right = false;

function drawSnake() {
  context.beginPath();
  for (let i = 0; i < snake.length; i++) {
    /*context.rect(
      cellSize / 2 + (snake[i].x - cellSize / 2) / cellSize,
      cellSize / 2 + (snake[i].y - cellSize / 2) / cellSize,
      cellSize / cellSize,
      cellSize / cellSize
    );*/
    context.rect(
        snake[i].x,
        snake[i].y,
        cellSize,
        cellSize
    );
    
    if (i === 0) {
      snake[i].x = gridCenters[1 + i][0][0] + 1;
    } 
    else if (i === snake.length - 1) {
      if (snake[0].dir === 'L' || snake[0].dir === 'U') {
        snake[i].y = snake[i - 1].y - 1;
      } else {
        snake[i].y = snake[i - 1].y + 1;
      }
    } 
    else {
      snake[i].x = gridCenters[1 + i][0][0];
      snake[i].y = gridCenters[1 + i][0][1];
      switch (snake[0].dir) {
        case 'D':
          snake[i].y = snake[i - 1].y + 1;
          break;
        case 'U':
          snake[i].y = snake[i - 1].y - 1;
          break;
        case 'R':
          snake[i].x = snake[i - 1].x + 1;
          break;
        default:
          snake[i].x = snake[i - 1].x - 1;
          break;
      }
    }
    //context.arc(snake[i].x, snake[i].y, appleRadius + 4, 0, Math.PI * 2);
    
    //context.lineWidth = 2;
    context.stroke();
    context.fillStyle = '#1f7512';
    context.fill();
    
  }
  context.closePath();
}
function handleKeyDown(event) {
  const { key } = event;
  if (key === 'Down' || key === 'ArrowDown') {
    Down = true;
  } else if (key === 'Up' || key === 'ArrowUp') {
    Up = true;
  } else if (key === 'Right' || key === 'ArrowRight') {
    Right = true;
    Left = false;
  } else if (key === 'Left' || key === 'ArrowLeft') {
    Left = true;
    Right = false;
  }
}

function getRandomInt(min, max, prefix = '') {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function applePosition() {
  const x = getRandomInt(1, gridSize) * cellSize - cellSize / 2;
  const y = getRandomInt(1, gridSize) * cellSize - cellSize / 2;
  return [x, y];
}

function drawApple() {
  context.beginPath();
  context.arc(applePos[0], applePos[1], appleRadius, 0, Math.PI * 2);
  context.fillStyle = '#fff';
  context.fill();
  context.closePath();
}

function drawBG() {
  context.lineWidth = 4;
  context.strokeStyle = '#fff';
  for (let i = 0; i < gridSize; i++) {
    context.moveTo(i * cellSize, 0);
    context.lineTo(i * cellSize, canvas.height);
    context.stroke();
    context.moveTo(0, i * cellSize);
    context.lineTo(canvas.width, i * cellSize);
    context.stroke();
  }
}



function cleanCanvas() {
  context.clearRect(0, 0, canvas.width, canvas.height);
}
function snakeMovement() {
    
        snake[0].x += dx * cellSize;
        snake[0].y += dy;
    
}
function draw() {
  //cleanCanvas();
  drawApple();
  drawBG();
  drawSnake();
  snakeMovement();
  window.requestAnimationFrame(draw);
}



// Event listeners
document.addEventListener('keydown', handleKeyDown);
draw();