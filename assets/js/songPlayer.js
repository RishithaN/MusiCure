var activeSong;

function playPause(id){
        
        activeSong = document.getElementById(id);
        var playBtn = document.getElementById('playPauseIcon');
        
        if (activeSong.paused){
            playBtn.innerHTML = "pause_circle_filled";
            activeSong.play();
        }else{
            playBtn.innerHTML = "play_circle_filled";
            activeSong.pause();
        }
}


function updateTime(){
    var currentSeconds = (Math.floor(activeSong.currentTime % 60) < 10 ? '0' : '') + Math.floor(activeSong.currentTime % 60);
    var currentMinutes = Math.floor(activeSong.currentTime / 60);
    var playBtn = document.getElementById('playPauseIcon');
    
    document.getElementById('songTime').innerHTML = currentMinutes + ":" + currentSeconds;
    document.getElementById('songDuration').innerHTML =   Math.floor(activeSong.duration / 60) + ":" + (Math.floor(activeSong.duration % 60) < 10 ? '0' : '') + Math.floor(activeSong.duration % 60);

    
    var percentageOfSong = (activeSong.currentTime/activeSong.duration);
    var percentageOfSlider = document.getElementById('songSlider').offsetWidth * percentageOfSong;
    
    
    document.getElementById('trackProgress').style.width = Math.round(percentageOfSlider) + "px";

    if((document.getElementById('songTime').innerHTML).localeCompare(document.getElementById('songDuration').innerHTML) == 0){
        playBtn.innerHTML = "play_circle_filled";
    }
}


function changeVolume(number, direction){
    
    if(activeSong.volume >= 0 && direction == "down"){
        activeSong.volume = activeSong.volume - (number / 100);
    }
    
    if(activeSong.volume <= 1 && direction == "up"){
        activeSong.volume = activeSong.volume + (number / 100);
    }
    
    
    var percentageOfVolume = activeSong.volume / 1;
    var percentageOfVolumeSlider = document.getElementById('volumeMeter').offsetWidth * percentageOfVolume;
    
    document.getElementById('volumeStatus').style.width = Math.round(percentageOfVolumeSlider) + "px";
}


function setVolume(percentage){
    activeSong.volume =  percentage;
    
    var percentageOfVolume = activeSong.volume / 1;
    var percentageOfVolumeSlider = document.getElementById('volumeMeter').offsetWidth * percentageOfVolume;
    
    document.getElementById('volumeStatus').style.width = Math.round(percentageOfVolumeSlider) + "px";
}


function setNewVolume(obj,e){
    var volumeSliderWidth = obj.offsetWidth;
    var evtobj = window.event? event: e;
    clickLocation = evtobj.layerX - obj.offsetLeft;
    
    var percentage = (clickLocation/volumeSliderWidth);
    setVolume(percentage);
}


function setLocation(percentage){
    activeSong.currentTime = activeSong.duration * percentage;
}


function setSongPosition(obj,e){
    
    var songSliderWidth = obj.offsetWidth;
    var evtobj=window.event? event : e;
    clickLocation =  evtobj.layerX - obj.offsetLeft;
    
    var percentage = (clickLocation/songSliderWidth);
    
    setLocation(percentage);
}

