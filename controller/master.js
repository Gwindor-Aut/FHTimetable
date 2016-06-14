startup = function(){
var http = require('http');
var server = http.createServer(callback)
var port = 1337
var ip = "127.0.0.1";

var now = new Date().toString().replace(/ GMT.[a-zäöü ()0-9A-Z]*/, '');

var up = require('./helper/urlparser')
var statcon = require('./static.js')
var imgcon = require('./image.js')
	
server.listen(port,ip)

function callback(req, res){
	var reqtime = new Date().toString().replace(/ GMT.[a-zäöü ()0-9A-Z]*/, '');
	
    console.log("[INFO] ["+reqtime+"] Requested URL: " + req.url);
		filename = "404.html"
		urlparser = new up.UrlParser(req.url);
		console.log("[INFO] ["+reqtime+"] Parser: "+urlparser.controller);
		if (urlparser.controller=="StaticController"){
			handlerController= new statcon.StaticController();
		} else if(urlparser.controller=="ImageController"){
            handlerController= new imgcon.ImageController();
        }
		handlerController.handle(res, req);	
}

console.log("[STARTUP] ["+now+"] - Server listening at: http://"+ip+":"+port);
};

module.exports.startup = startup;
module.exports.author = 'Rudischer | Schaberreiter | Schweighofer';
module.exports.vers = '0.1';

