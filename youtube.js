  // Toggle the display of youtube video
  function youtube(sidq){
  	if (document.getElementById("out"+sidq).innerHTML === '') {
  
  		var posting = $.post("PHP/youtube.php", {sid: sidq});
  		posting.done(function(recs) {
  			document.getElementById("out"+sidq).innerHTML = '<center><iframe width="560" height="315" src="//www.youtube.com/embed/'+recs+'" frameborder="0" allowfullscreen></iframe></center>';
  		 });
  	}
  	else {
  		document.getElementById("out"+sidq).innerHTML = '';
  	}				 	
  }