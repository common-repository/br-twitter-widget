﻿function twitterCallback2(twitters) {
  var statusHTML = [];
  var contador = 0;
  var class = '';
  
  for (var i=0; i<twitters.length; i++){
	contador++;
	class = 'update ';
	
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://www.twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
	
	if (contador == 1)
	{
		class = class + 'primeiro';
	}
	
    statusHTML.push('<li class="' + class + '"><span>'+status+'</span> <small><a href="http://twitter.com/'+username+'/statuses/'+twitters[i].id+'">'+relative_time(twitters[i].created_at)+'</a></small></li>');
  }
  document.getElementById('twitter_update_list').innerHTML = statusHTML.join('');
}

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'poucos minutos atr&aacute;s';
  } else if(delta < 120) {
    return 'aproximadamente 1 minuto atr&aacute;s';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutos atr&aacute;s';
  } else if(delta < (120*60)) {
    return 'aproximadamente 1 dia atr&aacute;s';
  } else if(delta < (24*60*60)) {
    return 'about ' + (parseInt(delta / 3600)).toString() + ' horas atr&aacute;s';
  } else if(delta < (48*60*60)) {
    return '1 dia atr&aacute;s';
  } else {
    return (parseInt(delta / 86400)).toString() + ' dias atr&aacute;s';
  }
}