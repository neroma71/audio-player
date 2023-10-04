let song = document.querySelector('#song');
let play = document.querySelector('#play');
let pause = document.querySelector('#pause');
let next = document.querySelector('#next');
let previous = document.querySelector('#previous');
let progress = document.querySelector('#progress');
let time = document.querySelector('#time');
let listSong = [];
let id = 0;
let selectsong = document.querySelectorAll('.blocksong');
let playicon = document.querySelector('#playicon');
let bool = false;
let playing = document.getElementById(id);
let titre  = document.querySelector("#titre");
let songduration = document.querySelector("#songDuration");
let boucle = false;
let random = false;



song.onloadedmetadata = function(){
    progress.max = song.duration;
    progress.value = song.currentTime;
}

for (let songs of selectsong) {
    songs.addEventListener("click", ()=>{
        songFromServer();
        playicon.innerHTML = '<svg id="pause"  class="middlebutton" xmlns="http://www.w3.org/2000/svg" fill="white" height="2em" viewBox="0 0 320 512"><path d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z"/></svg>';
        id=songs.id;
        asyncCall();
        setInterval(timesong,1000);
        timemax();
    })
  }
  
playicon.addEventListener("click",()=>{

    if(bool){
        playicon.innerHTML = '<svg id="pause" class="middlebutton" xmlns="http://www.w3.org/2000/svg" fill="white" height="2em" viewBox="0 0 320 512"><path d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z"/></svg>';
        song.play();
        bool =false;
    }else{
        playicon.innerHTML = '<svg id="play"  class="middlebutton" xmlns="http://www.w3.org/2000/svg" fill="white" height="2em" viewBox="0 0 384 512"><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/></svg>';
        song.pause();
        bool = true;
    }
})


previous.addEventListener('click',()=>{
    asyncCall();
    previoussong();
})

next.addEventListener('click', function() {
    asyncCall();
    nextsong();
});

progress.addEventListener("input", ()=>{
    song.currentTime = progress.value;
})

song.addEventListener("timeupdate", ()=>{
    progress.value = song.currentTime;
    timemax();
    if(song.currentTime == song.duration){
        asyncCall();

        nextsong();
    }
})

function timesong(){
    let seconds = song.currentTime;
    let min = 0;
    seconds = Math.floor(seconds);
    if(seconds>=60){
        min = seconds/60;
        min = Math.floor(min);
        seconds = seconds - min*60;
    }
    if(seconds<10){
        time.textContent = Math.floor(min) + ":0" + Math.floor(seconds);

    }else {
        time.textContent = Math.floor(min) + ":" + Math.floor(seconds);
    }
}

function playsong(){
    let source = '<source src="./songs/' + listSong[id] + '"type="audio/mp3"></source>';
    song.innerHTML = source;
    song.load();
    song.play();
}

function nextsong(){
        playing.classList.remove('selected');
        if(id+1== listSong.length){
            id=0;
        }else{
            id++;
        }
        let source = '<source src="./songs/' + listSong[id] + '"type="audio/mp3"></source>';
        playing = document.getElementById(id);
        playing.classList.add('selected');
        song.innerHTML = source;
        song.load();
        song.play();
}
function previoussong(){
    playing.classList.remove('selected');
    if(id-1 == -1){
        id=listSong.length-1;
        console.log(id)
    }else{
        id--;
    }
    song.firstChild.remove();
    let source = '<source src="./songs/' + listSong[id] + '"type="audio/mp3"></source>';
    playing = document.getElementById(id);
    playing.classList.add('selected');
    song.innerHTML = source;
    song.load();
    song.play();
}



async function songFromServer() {
    try {
        const response = await fetch('./process/listsongs.php');
        const data = await response.text();

        listSong = data.split(' ');
        listSong = listSong.filter(function(e) { return e; });
        playsong();
        playing.classList.remove('selected');
        playing = document.getElementById(id);
        playing.classList.add('selected');
        
    } catch (error) {
        console.error('Problème de soucis :', error);
    }
}

function resolveAfter2Seconds() {
    return new Promise(resolve => {
      setTimeout(() => {
        affichertitre();
        timemax();
      }, 500);
    });
  }
  
  async function asyncCall() {
    console.log('calling');
    const result = await resolveAfter2Seconds();
    console.log(result);
    // Expected output: "resolved"
  }

  function affichertitre(){
    let music = listSong[id].replace('.mp3', '');
    music = music.replaceAll('_', ' ')
    titre.textContent = "Playing : " + music;
    
}

  function timemax(){
    let seconds = song.duration;
    let min = 0;
    seconds = Math.floor(seconds);
    if(seconds>=60){
        min = seconds/60;
        min = Math.floor(min);
        seconds = seconds - min*60;
    }
    if(seconds<10){
        songduration.textContent = Math.floor(min) + ":0" + Math.floor(seconds);

    }else {
        songduration.textContent = Math.floor(min) + ":" + Math.floor(seconds);
    }
}