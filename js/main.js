let song = document.querySelector('#song');
let play = document.querySelector('#play');
let pause = document.querySelector('#pause');
let next = document.querySelector('#next');
let previous = document.querySelector('#previous');
let progress = document.querySelector('#progress');
let listSong = [];
let index = 0;

song.onloadedmetadata = function(){
    progress.max = song.duration;
    progress.value = song.currentTime;
}


play.addEventListener("click",()=>{
    let source = '<source src="/songs/' + listSong[index] + '"type="audio/mp3"></source>';
    song.innerHTML = source;
    song.play();
})

pause.addEventListener("click",()=>{
    song.pause();
})


progress.addEventListener("input", ()=>{
    
    //song.play();
    song.currentTime = progress.value;
    console.log(progress.value)
})

song.addEventListener("timeupdate", ()=>{
    //song.play();
    progress.value = song.currentTime;
    if(song.currentTime == song.duration){
        if(index+1 == listSong.length){
            index=0;
        }else{
            index++;
        }
        nextsong();
    }
})

function nextsong(){
    if(index+1== listSong.length){
        index=0;
    }else{
        index++;
    }
    song.firstChild.remove();
    let source = '<source src="/songs/' + listSong[index] + '"type="audio/mp3"></source>';
    console.log(source);
    song.innerHTML = source;
    song.load();
    song.play();
}
previous.addEventListener('click',()=>{
    songFromServer();
})

next.addEventListener('click', function() {
    nextsong();
});


async function songFromServer(){
    fetch('/process/listsongs.php')
    .then(function(response) {
        return response.text();
    })
    .then(function(data) {
        listSong = data.split(' ');
        console.log(listSong[0]);
  });
  }