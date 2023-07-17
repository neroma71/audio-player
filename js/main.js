let song = document.querySelector('#song');
let play = document.querySelector('#play');
let pause = document.querySelector('#pause');
let next = document.querySelector('#next');
let previous = document.querySelector('#previous');
let progress = document.querySelector('#progress');

song.onloadedmetadata = function(){
    progress.max = song.duration;
    progress.value = song.currentTime;
}

play.addEventListener("click",()=>{
    song.play();
})

pause.addEventListener("click",()=>{
    song.pause();
})


if(song.play()){
    setInterval(() => {
        progress.value = song.currentTime;
        // console.log(progress.value)
    }, 500);
}

progress.addEventListener("change", ()=>{
    
    //song.play();
    song.currentTime = progress.value;
    console.log(progress.value)
})