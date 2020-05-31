// JavaScript Document
/*var x = document.getElementById('container-audio1');
		function waveshow1(){
			  if (x.style.opacity === '1') {
				x.style.opacity = '0';
			  } else {
				x.style.opacity = '1';
			  }
		};
		
var x = document.getElementById('container-audio2');
		function waveshow2(){
			  if (x.style.opacity === '1') {
				x.style.opacity = '0';
			  } else {
				x.style.opacity = '1';
			  }
		};
		
var x = document.getElementById('container-audio3');
		function waveshow3(){
			  if (x.style.opacity === '1') {
				x.style.opacity = '0';
			  } else {
				x.style.opacity = '1';
			  }
		};
		
var x = document.getElementById('container-audio4');
		function waveshow4(){
			  if (x.style.opacity === '1') {
				x.style.opacity = '0';
			  } else {
				x.style.opacity = '1';
			  }
		};
		
var x = document.getElementById('container-audio5');
		function waveshow5(){
			  if (x.style.opacity === '1') {
				x.style.opacity = '0';
			  } else {
				x.style.opacity = '1';
			  }
		};
		
var x = document.getElementById('container-audio6');
		function waveshow6(){
			  if (x.style.opacity === '1') {
				x.style.opacity = '0';
			  } else {
				x.style.opacity = '1';
			  }
		};*/
		
var x = document.getElementById('container-audio');
		function waveshow(){
			  if (window.$_currentlyPlaying === 'true') {
				x.style.opacity = '0';
			  } else {
				x.style.opacity = '1';
			  }
		};
var x = document.getElementById('container-audio');		
var myAudio1 = document.getElementById("myAudio1");
		function togglePlay1() {
			document.addEventListener("play", function(evt)
	{
    if(window.$_currentlyPlaying && window.$_currentlyPlaying != evt.target)
    {
        window.$_currentlyPlaying.pause();
    } 
    window.$_currentlyPlaying = evt.target;
}, true);
			
		  return myAudio1.paused ? myAudio1.play() : myAudio1.pause();
		  
		};
		
var myAudio2 = document.getElementById("myAudio2");
		function togglePlay2() {
			document.addEventListener("play", function(evt)
	{
    if(window.$_currentlyPlaying && window.$_currentlyPlaying != evt.target)
    {
        window.$_currentlyPlaying.pause();
    } 
    window.$_currentlyPlaying = evt.target;
}, true);
		  return myAudio2.paused ? myAudio2.play() : myAudio2.pause();
		};
		
var myAudio3 = document.getElementById("myAudio3");
		function togglePlay3() {
			document.addEventListener("play", function(evt)
	{
    if(window.$_currentlyPlaying && window.$_currentlyPlaying != evt.target)
    {
        window.$_currentlyPlaying.pause();
    } 
    window.$_currentlyPlaying = evt.target;
}, true);
		  return myAudio3.paused ? myAudio3.play() : myAudio3.pause();
		};
		
var myAudio4 = document.getElementById("myAudio4");
		function togglePlay4() {
			document.addEventListener("play", function(evt)
	{
    if(window.$_currentlyPlaying && window.$_currentlyPlaying != evt.target)
    {
        window.$_currentlyPlaying.pause();
    } 
    window.$_currentlyPlaying = evt.target;
}, true);
		  return myAudio4.paused ? myAudio4.play() : myAudio4.pause();
		};
		
var myAudio5 = document.getElementById("myAudio5");
		function togglePlay5() {
			document.addEventListener("play", function(evt)
	{
    if(window.$_currentlyPlaying && window.$_currentlyPlaying != evt.target)
    {
        window.$_currentlyPlaying.pause();
    } 
    window.$_currentlyPlaying = evt.target;
}, true);
		  return myAudio5.paused ? myAudio5.play() : myAudio5.pause();
		};
		
var myAudio6 = document.getElementById("myAudio6");
		function togglePlay6() {
			document.addEventListener("play", function(evt)
	{
    if(window.$_currentlyPlaying && window.$_currentlyPlaying != evt.target)
    {
        window.$_currentlyPlaying.pause();
    } 
    window.$_currentlyPlaying = evt.target;
}, true);
		  return myAudio6.paused ? myAudio6.play() : myAudio6.pause();
		};