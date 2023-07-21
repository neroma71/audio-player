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
let titre  = document.getElementById("#titre");
let boucle = false;
let random = false;



song.onloadedmetadata = function(){
    progress.max = song.duration;
    progress.value = song.currentTime;
}

for (let songs of selectsong) {
    songs.addEventListener("click", ()=>{
        songFromServer();
        playicon.innerHTML = '<svg id="pause"xmlns="http://www.w3.org/2000/svg" height="2.5em" viewBox="0 0 320 512"><path d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z"/></svg>';
        id=songs.id;
        setInterval(timesong,1000);
        
    })
  }
  
playicon.addEventListener("click",()=>{

    if(bool){
        playicon.innerHTML = '<svg id="pause"xmlns="http://www.w3.org/2000/svg" height="2.5em" viewBox="0 0 320 512"><path d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z"/></svg>';
        song.play();
        bool =false;
    }else{
        playicon.innerHTML = '<svg id="play" xmlns="http://www.w3.org/2000/svg" height="2.5em" viewBox="0 0 384 512"><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/></svg>';
        song.pause();
        bool = true;
    }
})


previous.addEventListener('click',()=>{
    previoussong();
})

next.addEventListener('click', function() {
    nextsong();
});

progress.addEventListener("input", ()=>{
    song.currentTime = progress.value;
})

song.addEventListener("timeupdate", ()=>{
    progress.value = song.currentTime;
    if(song.currentTime == song.duration){
        if(id == listSong.length-1){
            playing.classList.remove('selected');
            id=0;
            playing.classList.add('selected');
        }else{
            playing.classList.remove('selected');
            id++;
            playing.classList.add('selected');
        }
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
    let source = '<source src="/songs/' + listSong[id] + '"type="audio/mp3"></source>';
    song.innerHTML = source;
    song.load();
    song.play();
}

function nextsong(){
    if(!boucle){
        playing.classList.remove('selected');
        if(id+1== listSong.length){
            id=0;
        }else{
            id++;
        }
        let source = '<source src="/songs/' + listSong[id] + '"type="audio/mp3"></source>';
        playing = document.getElementById(id);
        playing.classList.add('selected');
        song.innerHTML = source;
        song.load();
        song.play();
    }else{
        song.load();
        song.play();
    }
   
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
    let source = '<source src="/songs/' + listSong[id] + '"type="audio/mp3"></source>';
    playing = document.getElementById(id);
    playing.classList.add('selected');
    song.innerHTML = source;
    song.load();
    song.play();
}

function affichertitre(){
    titre.innerHTML ="<p>oui</p>";
    console.log(listSong[id]);
}

async function songFromServer() {
    try {
        const response = await fetch('/process/listsongs.php');
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